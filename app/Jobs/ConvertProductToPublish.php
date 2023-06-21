<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ConvertProductToPublish implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $productSku;
    private $translate;
    private $pull_image;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($productSku, $translate, $pull_image)
    {
        $this->productSku = $productSku;
        $this->translate = $translate;
        $this->pull_image = $pull_image;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product = Product::where('sku', $this->productSku)
            ->first();
        if (empty($product)) {
            return;
        }

        $originalData = $product->original_data;

        $mainImage = $originalData[6] ?? '';
        $otherImages = explode("|", $originalData[7]) ?? [];

        $newMainImage = null;
        if (!empty($mainImage) && $this->pull_image) {
//            $url = 'https://img.5jihua.com/' . Str::replaceFirst("/", '', $mainImage);
            $url = $mainImage;
            if (!empty($url)) {
                $product->clearMediaCollection('product_main_image');
                $newMainImage = $product->addMediaFromUrl($url)
                    ->toMediaCollection('product_main_image');
            }
        }

        if (!empty($otherImages) && $this->pull_image) {
            foreach ($otherImages as $image) {
//                $url = 'https://img.5jihua.com/' . Str::replaceFirst("/", '', $image);
                $url = $image;
                if (!empty($url)) {
                    $product->clearMediaCollection('product_other_image');
                    $product->addMediaFromUrl($url)
                        ->toMediaCollection('product_other_image');
                }
            }
        }

        if (preg_match('/[\p{Han}]+/u', $originalData[3]) && $this->translate) {
            try {
                $name = \GoogleTranslate::justTranslate($originalData[3]);
                $product->name = is_array($name)
                    ? $name['translated_text']
                    : $name;
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
            }
        }

        $newStr = str_replace([",", "、"], ",", $originalData[4]);
        $features = explode(",", $newStr);
        $translateFeatures = [];
        foreach ($features as $f) {
            try {
                $feature = \GoogleTranslate::justTranslate($f);
                $translateFeatures[] = is_array($feature)
                    ? $feature['translated_text']
                    : $feature;
            } catch (\Exception $e) {
                $translateFeatures[] = $f;
            }
        }

        $product->features = implode(", ", $translateFeatures);

        if (!empty($newMainImage)) {
            $product->image = str_replace(config('app.url'), '', $newMainImage->getFullUrl());
        }
        $product->status = 2;
        $product->save();
    }
}

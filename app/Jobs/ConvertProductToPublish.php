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
use JoggApp\GoogleTranslate\GoogleTranslate;

class ConvertProductToPublish implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $productSku;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($productSku)
    {
        $this->productSku = $productSku;
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
        $translate = app(GoogleTranslate::class);

        $mainImage = $originalData[6] ?? '';
        $otherImages = explode("|", $originalData[7]) ?? [];

        $newMainImage = null;
        if (! empty($mainImage)) {
            $url = 'https://img.5jihua.com/' . Str::replaceFirst("/", '', $mainImage);
            $product->clearMediaCollection('product_main_image');
            $newMainImage = $product->addMediaFromUrl($url)
                ->toMediaCollection('product_main_image');
        }

        if (! empty($otherImages)) {
            foreach ($otherImages as $image) {
                $url = 'https://img.5jihua.com/' . Str::replaceFirst("/", '', $image);
                $product->clearMediaCollection('product_other_image');
                $product->addMediaFromUrl($url)
                    ->toMediaCollection('product_other_image');
            }
        }

        if (! app()->environment(['local', 'staging'])) {
            $newStr = str_replace([",", "、"], ",", $originalData[4]);
            $features = explode(",", $newStr);
            $translateFeatures = [];
            foreach ($features as $f) {
                $feature = $translate->justTranslate($f);
                $translateFeatures[] = is_array($feature)
                    ? $feature['translated_text']
                    : $feature;
            }

            $product->features = implode(", ", $translateFeatures);
        }
        if (! empty($newMainImage)) {
            $product->image = str_replace(config('app.url'), '', $newMainImage->getFullUrl());
        }
        $product->status = 2;
        $product->save();
    }
}

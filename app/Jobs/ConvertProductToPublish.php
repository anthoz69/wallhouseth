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

        if (! app()->environment(['local', 'staging'])) {

            $translate = app(GoogleTranslate::class);

            $features = explode(",", $originalData[4]);
            $data = array_merge([
                $originalData[3], // product name
            ], $features);
            $translateResponse = $translate->translate($data);
            $translateResponse = collect($translateResponse);

            $features = array_map(function ($value) use ($translateResponse) {
                return $translateResponse
                    ->firstWhere(
                        'source_text',
                        $value
                    )['translated_text'] ?? $value;
            }, $features);

        }

        $mainImage = $originalData[6] ?? '';
        $otherImages = explode("|", $originalData[7]) ?? [];

        if (! empty($mainImage)) {
            $url = 'https://img.5jihua.com/' . Str::replaceFirst("/", '', $mainImage);
            $product->addMediaFromUrl($url)
                ->toMediaCollection('product_main_image');
        }

        foreach ($otherImages as $image) {
            $url = 'https://img.5jihua.com/' . Str::replaceFirst("/", '', $image);
            $product->addMediaFromUrl($url)
                ->toMediaCollection('product_other_image');
        }

        if (! app()->environment(['local', 'staging'])) {
            $product->name = $translateResponse->firstWhere('source_text',
                $originalData[3])['translated_text'] ?? $originalData[3];

            $product->features = implode(", ", $features);
        }
        $product->image = str_replace(config('app.url'), '', $product->getFirstMediaUrl('product_main_image'));
        $product->status = 2;
        $product->save();
    }
}

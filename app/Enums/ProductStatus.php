<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

final class ProductStatus extends Enum
{
    #[Description('รอแปลภาษา')]
    const WaitForTranslate = 0;
    #[Description('รอดึงรูปภาพ')]
    const WaitForStoreImage = 1;
    #[Description('แสดง')]
    const Publish = 2;
    #[Description('ซ่อน')]
    const UnPublish = 3;

    public function toArray(): mixed
    {
        return $this;
    }
}

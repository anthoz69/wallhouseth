<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class ProductStatus extends Enum
{
    const WaitForTranslate = 0;
    const WaitForStoreImage = 1;
    const Publish = 2;
    const UnPublish = 3;
}

<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatus extends Enum
{
    const WaitPayment = 0;
    const WaitConfirm = 1;
    const Prepare = 2;
    const Success = 3;
}

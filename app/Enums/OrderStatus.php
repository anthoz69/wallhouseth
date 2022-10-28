<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    #[Description('รอชำระเงิน')]
    const WaitPayment = 0;
    #[Description('รอตรวจสอบ')]
    const WaitConfirm = 1;
    #[Description('เตรียมส่ง')]
    const Prepare = 2;
    #[Description('ส่งแล้ว')]
    const Success = 3;
}

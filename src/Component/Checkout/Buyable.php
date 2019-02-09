<?php

namespace App\Component\Checkout;

use App\Component\Money\Money;
use App\Component\Tax\Taxable;

interface Buyable extends Taxable
{
    public function getGtin(): int;
    public function getName(): string;
    public function getPrice(): Money;
}

<?php

namespace App\Component\Tax;

interface Taxable
{
    public function getTaxRate(): float;
    public function isTaxIncluded(): bool;
}

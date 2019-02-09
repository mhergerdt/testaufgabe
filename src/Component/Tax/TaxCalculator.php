<?php

namespace App\Component\Tax;

use App\Component\Money\Money;

class TaxCalculator
{
    public function calculateTax(Money $price, Taxable $taxable): Money
    {
        if ($taxable->isTaxIncluded()) {
            return $price->subtract($price->divide(1 + $taxable->getTaxRate()));
        }

        return $price->multiply($taxable->getTaxRate());
    }

    public function calculateNet(Money $price, Taxable $taxable): Money
    {
        if ($taxable->isTaxIncluded()) {
            return $price->subtract($this->calculateTax($price, $taxable));
        }

        return $price;
    }

    public function calculateGross(Money $price, Taxable $taxable): Money
    {
        if ($taxable->isTaxIncluded()) {
            return $price;
        }

        return $price->add($this->calculateTax($price, $taxable));
    }
}

<?php

namespace App\Component\Checkout;

use App\Component\Money\Money;

class Receipt
{
    /**
     * @var Buyable[]
     */
    private $buyables;
    /**
     * @var Money
     */
    private $netPrice;
    /**
     * @var Money
     */
    private $grossPrice;

    public function __construct($buyables, Money $netPrice, Money $grossPrice)
    {
        $this->buyables = $buyables;
        $this->netPrice = $netPrice;
        $this->grossPrice = $grossPrice;
    }

    /**
     * @return Buyable[]
     */
    public function getBuyables(): array
    {
        return $this->buyables;
    }

    public function getNetPrice(): Money
    {
        return $this->netPrice;
    }

    public function getGrossPrice(): Money
    {
        return $this->grossPrice;
    }
}

<?php

namespace App\Component\Product;

use App\Component\Checkout\Buyable;
use App\Component\Money\Money;

class Product implements Buyable
{
    /**
     * @var int
     */
    private $gtin;
    /**
     * @var string
     */
    private $name;
    /**
     * @var Money
     */
    private $price;
    /**
     * @var float
     */
    private $taxRate;
    /**
     * @var bool
     */
    private $taxIncluded;

    public function __construct(int $gtin, string $name, Money $price, float $taxRate, bool $taxIncluded = true)
    {
        $this->gtin = $gtin;
        $this->name = $name;
        $this->price = $price;
        $this->taxRate = $taxRate;
        $this->taxIncluded = $taxIncluded;
    }

    public function getGtin(): int
    {
        return $this->gtin;
    }

    public function setGtin(int $gtin): Product
    {
        $this->gtin = $gtin;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }

    public function setPrice(Money $price): Product
    {
        $this->price = $price;

        return $this;
    }

    public function getTaxRate(): float
    {
        return $this->taxRate;
    }

    public function setTaxRate(float $taxRate): Product
    {
        $this->taxRate = $taxRate;

        return $this;
    }

    public function isTaxIncluded(): bool
    {
        return $this->taxIncluded;
    }

    public function setTaxIncluded(bool $taxIncluded): Product
    {
        $this->taxIncluded = $taxIncluded;

        return $this;
    }
}

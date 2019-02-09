<?php

namespace App\Component\Checkout;

use App\Component\Money\Currency;
use App\Component\Money\MoneyFactory;
use App\Component\Tax\TaxCalculator;

class CashRegister
{
    /**
     * @var TaxCalculator
     */
    private $taxCalculator;
    /**
     * @var Currency
     */
    private $currency;
    /**
     * @var MoneyFactory
     */
    private $moneyFactory;

    public function __construct(TaxCalculator $taxCalculator, MoneyFactory $moneyFactory, Currency $currency)
    {
        $this->taxCalculator = $taxCalculator;
        $this->currency = $currency;
        $this->moneyFactory = $moneyFactory;
    }

    /**
     * @param Buyable[] $buyables
     *
     * @return Receipt
     */
    public function createReceipt($buyables): Receipt
    {
        $netPrice = $this->moneyFactory->create(0, $this->currency);
        $grossPrice = $this->moneyFactory->create(0, $this->currency);

        foreach ($buyables as $buyable) {
            $netPrice = $netPrice->add($this->taxCalculator->calculateNet($buyable->getPrice(), $buyable));
            $grossPrice = $grossPrice->add($this->taxCalculator->calculateGross($buyable->getPrice(), $buyable));
        }

        return new Receipt($buyables, $netPrice, $grossPrice);
    }
}

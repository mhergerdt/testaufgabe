<?php

namespace App\Component\Checkout;

use App\Component\Money\CurrencyFactory;
use App\Component\Money\MoneyFactory;
use App\Component\Tax\TaxCalculator;

class CashRegisterFactory
{
    /**
     * @var TaxCalculator
     */
    private $taxCalculator;
    /**
     * @var MoneyFactory
     */
    private $moneyFactory;
    /**
     * @var CurrencyFactory
     */
    private $currencyFactory;

    public function __construct(
        TaxCalculator $taxCalculator,
        MoneyFactory $moneyFactory,
        CurrencyFactory $currencyFactory
    ) {
        $this->taxCalculator = $taxCalculator;
        $this->moneyFactory = $moneyFactory;
        $this->currencyFactory = $currencyFactory;
    }

    public function create(string $currencyCode): CashRegister
    {
        return new CashRegister(
            $this->taxCalculator,
            $this->moneyFactory,
            $this->currencyFactory->create($currencyCode)
        );
    }
}

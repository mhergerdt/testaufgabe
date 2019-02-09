<?php

namespace App\Component\Money\MoneyPhp;

use App\Component\Money\Currency;
use Money\Currency as MoneyPhpCurrency;

class MoneyPhpCurrencyAdapter implements Currency
{
    /**
     * @var MoneyPhpCurrency
     */
    private $moneyPhpCurrency;

    /**
     * @param MoneyPhpCurrency $moneyPhpCurrency
     */
    public function __construct(MoneyPhpCurrency $moneyPhpCurrency)
    {
        $this->moneyPhpCurrency = $moneyPhpCurrency;
    }

    public function getCode(): string
    {
        return $this->moneyPhpCurrency->getCode();
    }

    public function equals(Currency $other): bool
    {
        return $this->moneyPhpCurrency->equals(self::getMoneyPhpCurrency($other));
    }

    public function __toString(): string
    {
        return $this->moneyPhpCurrency->getCode();
    }

    private static function getMoneyPhpCurrency(Currency $currency): MoneyPhpCurrency
    {
        return new MoneyPhpCurrency($currency->getCode());
    }
}

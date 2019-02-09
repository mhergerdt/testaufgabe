<?php

namespace App\Component\Money;

use App\Component\Money\MoneyPhp\MoneyPhpMoneyAdapter;
use Money\Currency as MoneyPhpCurrency;
use Money\Money as MoneyPhpMoney;

class MoneyFactory
{
    public function create(int $amount, Currency $currency): Money
    {
        return self::createWithCurrencyCode($amount, $currency->getCode());
    }

    public static function createWithCurrencyCode(int $amount, string $currencyCode): MoneyPhpMoneyAdapter
    {
        return new MoneyPhpMoneyAdapter(new MoneyPhpMoney($amount, new MoneyPhpCurrency($currencyCode)));
    }
}

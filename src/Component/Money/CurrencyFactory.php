<?php

namespace App\Component\Money;

use App\Component\Money\MoneyPhp\MoneyPhpCurrencyAdapter;
use Money\Currency as MoneyPhpCurrency;

class CurrencyFactory
{
    public function create(string $code): Currency
    {
        return new MoneyPhpCurrencyAdapter(new MoneyPhpCurrency($code));
    }
}

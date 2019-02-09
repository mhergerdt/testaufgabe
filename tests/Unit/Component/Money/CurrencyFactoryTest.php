<?php

namespace App\Tests\Unit\Component\Money;

use App\Component\Money\CurrencyFactory;
use App\Component\Money\MoneyPhp\MoneyPhpCurrencyAdapter;
use Money\Currency as MoneyPhpCurrency;
use PHPUnit\Framework\TestCase;

class CurrencyFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $currencyFactory = new CurrencyFactory();
        $actualCurrency = $currencyFactory->create('EUR');

        $expectedCurrency = new MoneyPhpCurrencyAdapter(new MoneyPhpCurrency('EUR'));

        static::assertEquals($expectedCurrency, $actualCurrency);
    }
}

<?php

namespace App\Tests\Unit\Component\Money\MoneyPhp;

use App\Component\Money\MoneyPhp\MoneyPhpCurrencyAdapter;
use Money\Currency;
use PHPUnit\Framework\TestCase;

class MoneyPhpCurrencyAdapterTest extends TestCase
{
    public function testGetCode(): void
    {
        $expectedCode = 'EUR';

        $currency = new MoneyPhpCurrencyAdapter(new Currency($expectedCode));
        $actualCode = $currency->getCode();

        static::assertSame($expectedCode, $actualCode);
    }

    public function testEquals(): void
    {
        $code = 'EUR';

        $currency = new MoneyPhpCurrencyAdapter(new Currency($code));
        $otherCurrency = new MoneyPhpCurrencyAdapter(new Currency($code));

        static::assertTrue($currency->equals($otherCurrency));
    }
}

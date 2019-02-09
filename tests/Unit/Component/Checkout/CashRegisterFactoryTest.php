<?php

namespace App\Tests\Unit\Component\Checkout;

use App\Component\Checkout\CashRegister;
use App\Component\Checkout\CashRegisterFactory;
use App\Component\Money\Currency;
use App\Component\Money\CurrencyFactory;
use App\Component\Money\MoneyFactory;
use App\Component\Tax\TaxCalculator;
use PHPUnit\Framework\TestCase;

class CashRegisterFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $taxCalculatorMock = $this->createMock(TaxCalculator::class);
        $moneyFactoryMock = $this->createMock(MoneyFactory::class);
        $currencyMock = $this->getMockForAbstractClass(Currency::class);

        $currencyFactoryMock = $this->createMock(CurrencyFactory::class);
        $currencyFactoryMock
            ->method('create')
            ->with('EUR')
            ->willReturn(clone $currencyMock);

        $cashRegisterFactory = new CashRegisterFactory($taxCalculatorMock, $moneyFactoryMock, $currencyFactoryMock);
        $actualCashRegister = $cashRegisterFactory->create('EUR');

        $expectedCashRegister = new CashRegister($taxCalculatorMock, $moneyFactoryMock, $currencyMock);

        static::assertEquals($expectedCashRegister, $actualCashRegister);
    }
}

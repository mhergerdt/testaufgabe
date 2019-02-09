<?php

namespace App\Tests\Unit\Component\Money\MoneyPhp;

use App\Component\Money\MoneyPhp\MoneyPhpCurrencyAdapter;
use App\Component\Money\MoneyPhp\MoneyPhpMoneyAdapter;
use Money\Currency as MoneyPhpCurrency;
use Money\Money as MoneyPhpMoney;
use PHPUnit\Framework\TestCase;

class MoneyPhpMoneyAdapterTest extends TestCase
{
    public function testIsSameCurrency(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->isSameCurrency($anotherMoney));
    }

    public function testEquals(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->equals($anotherMoney));
    }

    public function testCompare(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        static::assertSame(0, $money->compare($anotherMoney));
    }

    public function testGreaterThan(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->greaterThan($anotherMoney));
    }

    public function testGreaterThanOrEqual(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->greaterThanOrEqual($anotherMoney));
    }

    public function testLessThan(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(10, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->lessThan($anotherMoney));
    }

    public function testLessThanOrEqual(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->lessThanOrEqual($anotherMoney));
    }

    public function testGetAmount(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));

        static::assertSame('30', $money->getAmount());
    }

    public function testGetCurrency(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));

        static::assertEquals(
            new MoneyPhpCurrencyAdapter(new MoneyPhpCurrency('EUR')),
            $money->getCurrency()
        );
    }

    public function testAdd(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(50, new MoneyPhpCurrency('EUR')));

        static::assertEquals($expectedMoney, $money->add($anotherMoney));
    }

    public function testSubtract(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(10, new MoneyPhpCurrency('EUR')));

        static::assertEquals($expectedMoney, $money->subtract($anotherMoney));
    }

    public function testMultiply(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));

        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(60, new MoneyPhpCurrency('EUR')));

        static::assertEquals($expectedMoney, $money->multiply(2));
    }

    public function testDivide(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(40, new MoneyPhpCurrency('EUR')));

        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        static::assertEquals($expectedMoney, $money->divide(2));
    }

    public function testMod(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));
        $anotherMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(20, new MoneyPhpCurrency('EUR')));

        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(10, new MoneyPhpCurrency('EUR')));

        static::assertEquals($expectedMoney, $money->mod($anotherMoney));
    }

    public function testAbsolute(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(-30, new MoneyPhpCurrency('EUR')));

        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));

        static::assertEquals($expectedMoney, $money->absolute());
    }

    public function testNegative(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(30, new MoneyPhpCurrency('EUR')));

        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(-30, new MoneyPhpCurrency('EUR')));

        static::assertEquals($expectedMoney, $money->negative());
    }

    public function testIsZero(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(0, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->isZero());
    }

    public function testIsPositive(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(1, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->isPositive());
    }

    public function testIsNegative(): void
    {
        $money = new MoneyPhpMoneyAdapter(new MoneyPhpMoney(-10, new MoneyPhpCurrency('EUR')));

        static::assertTrue($money->isNegative());
    }
}

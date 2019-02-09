<?php

namespace App\Tests\Unit\Component\Money;

use App\Component\Money\Currency;
use App\Component\Money\MoneyFactory;
use App\Component\Money\MoneyPhp\MoneyPhpMoneyAdapter;
use Money\Currency as MoneyPhpCurrency;
use Money\Money as MoneyPhpMoney;
use PHPUnit\Framework\TestCase;

class MoneyFactoryTest extends TestCase
{
    /**
     * @dataProvider provideTestCreate
     *
     * @param int $amount
     */
    public function testCreate(int $amount): void
    {
        $currencyMock = $this->getMockForAbstractClass(Currency::class);
        $currencyMock
            ->method('getCode')
            ->willReturn('EUR');

        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney($amount, new MoneyPhpCurrency('EUR')));

        $moneyFactory = new MoneyFactory();

        self::assertEquals($expectedMoney, $moneyFactory->create($amount, $currencyMock));
    }

    public function provideTestCreate(): array
    {
        return [
            'amount_1' => ['amount' => 1],
            'amount_2' => ['amount' => 2],
            'amount_3' => ['amount' => 3]
        ];
    }

    /**
     * @dataProvider provideTestCreateWithCurrencyCode
     *
     * @param int $amount
     */
    public function testCreateWithCurrencyCode(int $amount): void
    {
        $expectedMoney = new MoneyPhpMoneyAdapter(new MoneyPhpMoney($amount, new MoneyPhpCurrency('EUR')));

        $moneyFactory = new MoneyFactory();

        self::assertEquals($expectedMoney, $moneyFactory::createWithCurrencyCode($amount, 'EUR'));
    }

    public function provideTestCreateWithCurrencyCode(): array
    {
        return [
            'amount_1' => ['amount' => 1],
            'amount_2' => ['amount' => 2],
            'amount_3' => ['amount' => 3]
        ];
    }
}

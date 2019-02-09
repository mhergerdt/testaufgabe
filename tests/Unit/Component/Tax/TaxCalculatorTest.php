<?php

namespace App\Tests\Unit\Component\Tax;

use App\Component\Money\Money;
use App\Component\Money\MoneyFactory;
use App\Component\Tax\Taxable;
use App\Component\Tax\TaxCalculator;
use PHPUnit\Framework\TestCase;

class TaxCalculatorTest extends TestCase
{
    /**
     * @dataProvider provideTestCalculateTax
     */
    public function testCalculateTax(float $taxRate, Money $price, bool $isTaxIncluded, Money $expectedTax): void
    {
        $taxableMock = $this->getMockForAbstractClass(Taxable::class);
        $taxableMock
            ->method('getTaxRate')
            ->willReturn($taxRate);
        $taxableMock
            ->method('isTaxIncluded')
            ->willReturn($isTaxIncluded);

        $taxCalculator = new TaxCalculator();
        $actualTax = $taxCalculator->calculateTax($price, $taxableMock);

        static::assertEquals($expectedTax, $actualTax);
    }

    public function provideTestCalculateTax(): array
    {
        return [
            'tax_included' => [
                'taxRate' => 0.1,
                'price' => MoneyFactory::createWithCurrencyCode(22, 'EUR'),
                'isTaxIncluded' => true,
                'expectedTax' => MoneyFactory::createWithCurrencyCode(2, 'EUR')
            ],
            'tax_excluded' => [
                'taxRate' => 0.1,
                'price' => MoneyFactory::createWithCurrencyCode(20, 'EUR'),
                'isTaxIncluded' => false,
                'expectedTax' => MoneyFactory::createWithCurrencyCode(2, 'EUR')
            ]
        ];
    }

    /**
     * @dataProvider provideTestCalculateNet
     */
    public function testCalculateNet(float $taxRate, Money $price, bool $isTaxIncluded, Money $expectedTax): void
    {
        $taxableMock = $this->getMockForAbstractClass(Taxable::class);
        $taxableMock
            ->method('getTaxRate')
            ->willReturn($taxRate);
        $taxableMock
            ->method('isTaxIncluded')
            ->willReturn($isTaxIncluded);

        $taxCalculator = new TaxCalculator();
        $actualNetPrice = $taxCalculator->calculateNet($price, $taxableMock);

        static::assertEquals($expectedTax, $actualNetPrice);
    }

    public function provideTestCalculateNet(): array
    {
        return [
            'tax_included' => [
                'taxRate' => 0.1,
                'price' => MoneyFactory::createWithCurrencyCode(22, 'EUR'),
                'isTaxIncluded' => true,
                'expectedTax' => MoneyFactory::createWithCurrencyCode(20, 'EUR')
            ],
            'tax_excluded' => [
                'taxRate' => 0.1,
                'price' => MoneyFactory::createWithCurrencyCode(20, 'EUR'),
                'isTaxIncluded' => false,
                'expectedTax' => MoneyFactory::createWithCurrencyCode(20, 'EUR')
            ]
        ];
    }

    /**
     * @dataProvider provideTestCalculateGross
     */
    public function testCalculateGross(float $taxRate, Money $price, bool $isTaxIncluded, Money $expectedTax): void
    {
        $taxableMock = $this->getMockForAbstractClass(Taxable::class);
        $taxableMock
            ->method('getTaxRate')
            ->willReturn($taxRate);
        $taxableMock
            ->method('isTaxIncluded')
            ->willReturn($isTaxIncluded);

        $taxCalculator = new TaxCalculator();
        $actualGrossPrice = $taxCalculator->calculateGross($price, $taxableMock);

        static::assertEquals($expectedTax, $actualGrossPrice);
    }

    public function provideTestCalculateGross(): array
    {
        return [
            'tax_included' => [
                'taxRate' => 0.1,
                'price' => MoneyFactory::createWithCurrencyCode(22, 'EUR'),
                'isTaxIncluded' => true,
                'expectedTax' => MoneyFactory::createWithCurrencyCode(22, 'EUR')
            ],
            'tax_excluded' => [
                'taxRate' => 0.1,
                'price' => MoneyFactory::createWithCurrencyCode(20, 'EUR'),
                'isTaxIncluded' => false,
                'expectedTax' => MoneyFactory::createWithCurrencyCode(22, 'EUR')
            ]
        ];
    }
}

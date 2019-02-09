<?php

namespace App\Tests\Integration\Component\Checkout;

use App\Component\Checkout\Cart;
use App\Component\Checkout\CashRegisterFactory;
use App\Component\Checkout\Receipt;
use App\Component\Money\MoneyFactory;
use App\Component\Product\Product;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CashRegisterTest extends KernelTestCase
{
    protected function setUp()
    {
        parent::setUp();

        self::bootKernel();
    }

    public function testCreateReceipt(): void
    {
        $cart = new Cart();
        $cart->add(self::createProduct('Orangensaft', 238, 0.19));
        $cart->add(self::createProduct('Milch', 107, 0.07));

        $cashRegister = self::$container->get(CashRegisterFactory::class)->create('EUR');
        $actualReceipt = $cashRegister->createReceipt($cart->getItems());

        $expectedReceipt = new Receipt(
            $cart->getItems(),
            MoneyFactory::createWithCurrencyCode(300, 'EUR'),
            MoneyFactory::createWithCurrencyCode(345, 'EUR')
        );

        self::assertEquals($expectedReceipt, $actualReceipt);
    }

    private static function createProduct(string $name, int $amount, float $taxRate): Product
    {
        return new Product(
            123,
            $name,
            MoneyFactory::createWithCurrencyCode($amount, 'EUR'),
            $taxRate
        );
    }
}

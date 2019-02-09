<?php

namespace App\Component\Money\MoneyPhp;

use App\Component\Money\Currency;
use App\Component\Money\Money;
use Money\Money as MoneyPhpMoney;

class MoneyPhpMoneyAdapter implements Money
{
    /**
     * @var MoneyPhpMoney
     */
    private $moneyPhpMoney;

    public function __construct(MoneyPhpMoney $moneyPhpMoney)
    {
        $this->moneyPhpMoney = $moneyPhpMoney;
    }

    public function isSameCurrency(Money $other): bool
    {
        return $this->moneyPhpMoney->isSameCurrency(self::getMoneyPhpMoney($other));
    }

    public function equals(Money $other): bool
    {
        return $this->moneyPhpMoney->equals(self::getMoneyPhpMoney($other));
    }

    public function compare(Money $other): int
    {
        return $this->moneyPhpMoney->compare(self::getMoneyPhpMoney($other));
    }

    public function greaterThan(Money $other): bool
    {
        return $this->moneyPhpMoney->greaterThan(self::getMoneyPhpMoney($other));
    }

    public function greaterThanOrEqual(Money $other): bool
    {
        return $this->moneyPhpMoney->greaterThanOrEqual(self::getMoneyPhpMoney($other));
    }

    public function lessThan(Money $other): bool
    {
        return $this->moneyPhpMoney->lessThan(self::getMoneyPhpMoney($other));
    }

    public function lessThanOrEqual(Money $other): bool
    {
        return $this->moneyPhpMoney->lessThanOrEqual(self::getMoneyPhpMoney($other));
    }

    public function getAmount(): string
    {
        return $this->moneyPhpMoney->getAmount();
    }

    public function getCurrency(): Currency
    {
        return new MoneyPhpCurrencyAdapter($this->moneyPhpMoney->getCurrency());
    }

    public function add(Money ...$addends): Money
    {
        return new self(
            call_user_func_array([$this->moneyPhpMoney, 'add'], self::getMoneyPhpMoneyCollection($addends))
        );
    }

    public function subtract(Money ...$subtrahends): Money
    {
        return new self(
            call_user_func_array([$this->moneyPhpMoney, 'subtract'], self::getMoneyPhpMoneyCollection($subtrahends))
        );
    }

    /**
     * @param float|string $multiplier
     * @param int          $roundingMode
     *
     * @return Money
     */
    public function multiply($multiplier, $roundingMode = Money::ROUND_HALF_UP): Money
    {
        return new self($this->moneyPhpMoney->multiply($multiplier, $roundingMode = Money::ROUND_HALF_UP));
    }

    /**
     * @param float|string $divisor
     * @param int          $roundingMode
     *
     * @return Money
     */
    public function divide(float $divisor, $roundingMode = Money::ROUND_HALF_UP): Money
    {
        return new self($this->moneyPhpMoney->divide($divisor, $roundingMode = Money::ROUND_HALF_UP));
    }

    public function mod(Money $divisor): Money
    {
        return new self($this->moneyPhpMoney->mod(self::getMoneyPhpMoney($divisor)));
    }

    public function absolute(): Money
    {
        return new self($this->moneyPhpMoney->absolute());
    }

    public function negative(): Money
    {
        return new self($this->moneyPhpMoney->negative());
    }

    public function isZero(): bool
    {
        return $this->moneyPhpMoney->isZero();
    }

    public function isPositive(): bool
    {
        return $this->moneyPhpMoney->isPositive();
    }

    public function isNegative(): bool
    {
        return $this->moneyPhpMoney->isNegative();
    }

    private static function getMoneyPhpMoney(Money $money): MoneyPhpMoney
    {
        return new MoneyPhpMoney($money->getAmount(), new \Money\Currency($money->getCurrency()->getCode()));
    }

    private static function getMoneyPhpMoneyCollection(array $moneyCollection)
    {
        return array_map(
            function (Money $money) {
                return self::getMoneyPhpMoney($money);
            },
            $moneyCollection
        );
    }
}

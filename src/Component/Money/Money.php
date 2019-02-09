<?php

namespace App\Component\Money;

interface Money
{
    public const ROUND_HALF_UP                = PHP_ROUND_HALF_UP;
    public const ROUND_HALF_DOWN              = PHP_ROUND_HALF_DOWN;
    public const ROUND_HALF_EVEN              = PHP_ROUND_HALF_EVEN;
    public const ROUND_HALF_ODD               = PHP_ROUND_HALF_ODD;
    public const ROUND_UP                     = 5;
    public const ROUND_DOWN                   = 6;
    public const ROUND_HALF_POSITIVE_INFINITY = 7;
    public const ROUND_HALF_NEGATIVE_INFINITY = 8;

    public function isSameCurrency(Money $other): bool;

    public function equals(Money $other): bool;

    public function compare(Money $other): int;

    public function greaterThan(Money $other): bool;

    public function greaterThanOrEqual(Money $other): bool;

    public function lessThan(Money $other): bool;

    public function lessThanOrEqual(Money $other): bool;

    public function getAmount(): string;

    public function getCurrency(): Currency;

    public function add(Money ...$addends): Money;

    public function subtract(Money ...$subtrahends): Money;

    /**
     * @param float|string $multiplier
     * @param int          $roundingMode
     *
     * @return Money
     */
    public function multiply($multiplier, $roundingMode = Money::ROUND_HALF_UP): Money;

    /**
     * @param float|string $divisor
     * @param int          $roundingMode
     *
     * @return Money
     */
    public function divide(float $divisor, $roundingMode = Money::ROUND_HALF_UP): Money;

    public function mod(Money $divisor): Money;

    public function absolute(): Money;

    public function negative(): Money;

    public function isZero(): bool;

    public function isPositive(): bool;

    public function isNegative(): bool;
}

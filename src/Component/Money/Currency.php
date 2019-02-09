<?php

namespace App\Component\Money;

interface Currency
{
    public function getCode(): string;
    public function equals(Currency $other): bool;
    public function __toString(): string;
}

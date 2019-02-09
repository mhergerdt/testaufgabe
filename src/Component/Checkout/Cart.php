<?php

namespace App\Component\Checkout;

class Cart
{
    private $buyables = [];

    public function add(Buyable $buyable): void
    {
        $this->buyables[] = $buyable;
    }

    /**
     * @return Buyable[]
     */
    public function getItems(): array
    {
        return $this->buyables;
    }

    public function remove(Buyable $buyable): void
    {
        /** @var int|string $index */
        $index = array_search($buyable, $this->buyables, true);

        if ($index !== false) {
            unset($this->buyables[$index]);
        }
    }
}

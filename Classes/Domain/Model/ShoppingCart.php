<?php

declare(strict_types=1);

namespace MircoKl\Shop\Domain\Model;

/**
 * Class ShoppingCart
 */
class ShoppingCart
{
    /**
     * @var array<array{string, int, float}>
     */
    private array $items = [];

    /**
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item[1] * $item[2];
        }
        return $total;
    }

    /**
     *
     * @param string $name
     * @param int $quantity
     * @param float $price
     * @return void
     */
    public function addItem(string $name, int $quantity, float $price): void
    {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException('Quantity must be greater than zero');
        }

        if ($price < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }

        $this->items[] = [$name, $quantity, $price];
    }

    /**
     *
     * @param string $name
     * @return int
     */
    public function getQuantity(string $name): int
    {
        $sum = 0;
        foreach ($this->items as $item) {
            if ($item[0] === $name) {
                $sum += $item[1];
            }
        }
        return $sum;
    }

    /**
     *
     * @param string $name
     * @return void
     * @throws \InvalidArgumentException
     */
    public function removeItem(string $name): void
    {
        foreach ($this->items as $i => $item) {
            if ($item[0] === $name) {
                array_splice($this->items, $i, 1);
                return;
            }
        }
        throw new \InvalidArgumentException("Item not found");
    }

    /**
     *
     * @return array<array{string, int, float}>
     */
    public function debugList(): array
    {
        return $this->items;
    }
}

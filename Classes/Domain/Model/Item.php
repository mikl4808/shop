<?php

declare(strict_types=1);

namespace MircoKl\Shop\Domain\Model;

/**
 * Class ShoppingCart
 */
class Item
{
    /**
     * @var int
     */
    private int $cart = 0;

    /**
     * @var string
     */
    private string $itemName;

    /**
     * @var float
     */
    private float $price;

    /**
     * @var int
     */
    private int $quantity;

    /**
     * Item constructor.
     *
     * @param string $itemName
     * @param int $quantity
     * @param float $price
     */
    public function __construct(string $itemName, int $quantity, float $price)
    {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException('Quantity must be greater than zero');
        }
        if ($price < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }
        $this->itemName = $itemName;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    /**
     * Get the total price of the item.
     *
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->quantity * $this->price;
    }

    /**
     * Get the item name.
     *
     * @return string
     */
    public function getItemName(): string
    {
        return $this->itemName;
    }

    /**
     * Get the quantity of the item.
     *
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Get the price of the item.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Set the quantity of the item.
     *
     * @param int $quantity
     * @return void
     */
    public function setQuantity(int $quantity): void
    {
        if ($quantity <= 0) {
            throw new \InvalidArgumentException('Quantity must be greater than zero');
        }
        $this->quantity = $quantity;
    }
    /**
     * Set the price of the item.
     *
     * @param float $price
     * @return void
     */
    public function setPrice(float $price): void
    {
        if ($price < 0) {
            throw new \InvalidArgumentException('Price cannot be negative');
        }
        $this->price = $price;
    }

    /**
     * Get the cart ID.
     *
     * @return int
     */
    public function getCart(): int
    {
        return $this->cart;
    }

    /**
     * Set the cart ID.
     *
     * @param int $cart
     * @return void
     */
    public function setCart(int $cart): void
    {
        if ($cart < 0) {
            throw new \InvalidArgumentException('Cart ID cannot be negative');
        }
        $this->cart = $cart;
    }
}

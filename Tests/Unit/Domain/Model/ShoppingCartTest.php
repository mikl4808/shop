<?php

declare(strict_types=1);

namespace MircoKl\Shop\Tests\Unit\Domain\Model;

use PHPUnit\Framework\TestCase;
use MircoKl\Shop\Domain\Model\ShoppingCart;

/**
 * @coversDefaultClass ShoppingCart
 */
class ShoppingCartTest extends TestCase
{
    /**
     * @covers ShoppingCart::getTotal
     */
    public function testCartHasNoItems(): void
    {
        $cart = new ShoppingCart();
        $this->assertSame(0.0, $cart->getTotal());
    }

    /**
     * @covers ShoppingCart::addItem
     * @covers ShoppingCart::getTotal
     */
    public function testAddItemAndRaiseTotal(): void
    {
        $cart = new ShoppingCart();
        $cart->addItem("Schrauben", 1, 1.50);
        $this->assertSame(1.50, $cart->getTotal());
    }

    /**
     * @covers ShoppingCart::addItem
     * @covers ShoppingCart::getTotal
     */
    public function testAddMultipleItems(): void
    {
        $cart = new ShoppingCart();
        $cart->addItem("Buch", 2, 1.00);
        $cart->addItem("Schrauben", 3, 0.50);
        $this->assertSame(3.50, $cart->getTotal());
    }

    /**
     * @covers ShoppingCart::addItem
     */
    public function testAddItemThrowsExceptionOnInvalidInput(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $cart = new ShoppingCart();
        $cart->addItem("Buch", -1, 1.00);
    }

    /**
     * @covers ShoppingCart::addItem
     */
    public function testAddItemThrowsExceptionOnNegativePrice(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $cart = new ShoppingCart();
        $cart->addItem("Apple", 1, -0.5);
    }

    /**
     * @covers ShoppingCart::addItem
     * @covers ShoppingCart::getQuantity
     */
    public function testGetQuantity(): void
    {
        $cart = new ShoppingCart();
        $cart->addItem("Apple", 2, 1.00);
        $cart->addItem("Apple", 1, 1.00);
        $this->assertSame(3, $cart->getQuantity("Apple"));
    }

    /**
     * @covers ShoppingCart::addItem
     * @covers ShoppingCart::removeItem
     * @covers ShoppingCart::getTotal
     */
    public function testRemoveItem(): void
    {
        $cart = new ShoppingCart();
        $cart->addItem("Apple", 1, 1.00);
        $cart->removeItem("Apple");
        $this->assertSame(0.0, $cart->getTotal());
    }

    /**
     * @covers ShoppingCart::removeItem
     */
    public function testRemveItemThrowsExcpetion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $cart = new ShoppingCart();
        $cart->removeItem("NonExistent");
    }
}

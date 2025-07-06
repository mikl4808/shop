<?php

declare(strict_types=1);

namespace MircoKl\Shop\Tests\Unit\Domain\Model;

use PHPUnit\Framework\TestCase;
use MircoKl\Shop\Domain\Model\Item;

/**
 * @coversDefaultClass Item
 */
class ItemTest extends TestCase
{
    /**
     * @covers Item::__construct
     */
    public function testItemCreationWithValidData(): void
    {
        $item = new Item("Test Item", 2, 10.00);
        $this->assertSame("Test Item", $item->getItemName());
        $this->assertSame(2, $item->getQuantity());
        $this->assertSame(10.00, $item->getPrice());
    }

    /**
     * @covers Item::__construct
     */
    public function testItemCreationWithInvalidQuantity(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Item("Test Item", -1, 10.00);
    }

    /**
     * @covers Item::__construct
     */
    public function testItemCreationWithNegativePrice(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Item("Test Item", 1, -5.00);
    }

    /**
     * @covers Item::getTotalPrice
     */
    public function testGetTotalPrice(): void
    {
        $item = new Item("Test Item", 3, 5.00);
        $this->assertSame(15.00, $item->getTotalPrice());
    }

    /**
     * @covers Item::getTotalPrice
     */
    public function testGetTotalPriceWithZeroQuantity(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $item = new Item("Test Item", 0, 10.00);
        $this->assertSame(0.00, $item->getTotalPrice());
    }

    /**
     * @covers Item::getTotalPrice
     */
    public function testGetTotalPriceWithZeroPrice(): void
    {
        $item = new Item("Test Item", 2, 0.00);
        $this->assertSame(0.00, $item->getTotalPrice());
    }

    /**
     * @covers Item::getItemName
     */
    public function testGetItemName(): void
    {
        $item = new Item("Test Item", 1, 10.00);
        $this->assertSame("Test Item", $item->getItemName());
    }

    /**
     * @covers Item::getQuantity
     */
    public function testGetQuantity(): void
    {
        $item = new Item("Test Item", 5, 10.00);
        $this->assertSame(5, $item->getQuantity());
    }

    /**
     * @covers Item::getPrice
     */
    public function testGetPrice(): void
    {
        $item = new Item("Test Item", 1, 20.00);
        $this->assertSame(20.00, $item->getPrice());
    }

    /**
     * @covers Item::setQuantity
     */
    public function testSetQuantity(): void
    {
        $item = new Item("Test Item", 1, 10.00);
        $item->setQuantity(3);
        $this->assertSame(3, $item->getQuantity());
    }

    /**
     * @covers Item::setQuantity
     */
    public function testSetQuantityThrowsExceptionOnInvalidInput(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $item = new Item("Test Item", 1, 10.00);
        $item->setQuantity(-2);
    }

    /**
     * @covers Item::setQuantity
     */
    public function testSetQuantityThrowsExceptionOnZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $item = new Item("Test Item", 1, 10.00);
        $item->setQuantity(0);
    }

    /**
     * @covers Item::setQuantity
     */
    public function testSetQuantityToOne(): void
    {
        $item = new Item("Test Item", 1, 10.00);
        $item->setQuantity(1);
        $this->assertSame(1, $item->getQuantity());
    }
}

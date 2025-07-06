<?php

declare(strict_types=1);

namespace MircoKl\Shop\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use MircoKl\Shop\Domain\Model\ShoppingCart;
use MircoKl\Shop\Service\OrderService;

/**
 * @coversDefaultClass OrderService
 */
class OrderServiceTest extends TestCase
{
    /**
     * @covers OrderService::calculateFinalPrice
     */
    public function testCalculateFinalPriceAppliesDiscount(): void
    {
        /** @var ShoppingCart&\PHPUnit\Framework\MockObject\MockObject $mockCart */
        $mockCart = $this->createMock(ShoppingCart::class);
        $mockCart->method('getTotal')->willReturn(100.0);

        /** @var OrderService&\PHPUnit\Framework\MockObject\MockObject $serviceMock */
        $serviceMock = new OrderService($mockCart);
        $finalPrice = $serviceMock->calculateFinalPrice(0.1); // 10% discount

        $this->assertSame(90.0, $finalPrice);
    }
}

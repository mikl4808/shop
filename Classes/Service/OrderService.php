<?php

declare(strict_types=1);

namespace MircoKl\Shop\Service;

use MircoKl\Shop\Domain\Model\ShoppingCart;

/**
 * Class OrderService
 */
class OrderService
{
    private ShoppingCart $cart;

    public function __construct(ShoppingCart $cart)
    {
        $this->cart = $cart;
    }

    /**
     *
     * @param float $discountRate
     * @return float
     */
    public function calculateFinalPrice(float $discountRate): float
    {
        $total = $this->cart->getTotal();
        return $total * (1 - $discountRate);
    }
}

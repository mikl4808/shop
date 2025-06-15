<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Model\Cart;
use App\Model\Product;
use App\Discount\DiscountStrategyResolver;

class CartManager
{
    /**
     * Konstruktor für den Warenkorb-Manager
     *
     * @param SessionInterface $session
     * @param DiscountStrategyResolver $discountResolver
     */
    public function __construct(private SessionInterface $session, private DiscountStrategyResolver $discountResolver) {}

    /**
     * Liefert den aktuellen Warenkorb aus der Session zurück.
     *
     * @return Cart
     */
    public function getCart(): Cart
    {
        return $this->session->get('cart', new Cart());
    }

    /**
     * Speichert den Warenkorb in der Session.
     *
     * @param Cart $cart
     * @return void
     */
    public function saveCart(Cart $cart): void
    {
        $this->session->set('cart', $cart);
    }

    /**
     * Fügt ein Produkt zum Warenkorb hinzu.
     *
     * @param integer $id
     * @param string $name
     * @param float $price
     * @param integer $quantity
     * @return void
     */
    public function add(int $id, string $name, float $price, int $quantity): void
    {
        $cart = $this->getCart();
        $product = new Product($id, $name, $price);
        $cart->addProduct($product, $quantity);
        $this->saveCart($cart);
    }

    /**
     * Entfernt ein Produkt aus dem Warenkorb.
     *
     * @param integer $id
     * @return void
     */
    public function remove(int $id): void
    {
        $cart = $this->getCart();
        $cart->removeProduct($id);
        $this->saveCart($cart);
    }

    /**
     * Berechnet den Gesamtpreis des Warenkorbs unter Berücksichtigung von Rabatten.
     *
     * @param float $total
     * @param string $customerType
     * @return float
     */
    public function getDiscountedTotal(float $total, string $customerType): float
    {
        $strategy = $this->discountResolver->resolve($customerType);
        $discount = $strategy->calculateDiscount($total);

        return $total - $discount;
    }

}

<?php

namespace App\Model;

class Cart
{
    /**
     * Warenkorbinhalte
     *
     * @var array
     */
    private array $items = [];

    /**
     * Fügt ein Produkt zum Warenkorb hinzu
     *
     * @param Product $product
     * @param integer $quantity
     * @return void
     */
    public function addProduct(Product $product, int $quantity): void
    {
        $id = $product->getId();
        if (isset($this->items[$id])) {
            $this->items[$id]['quantity'] += $quantity;
        } else {
            $this->items[$id] = [
                'product' => $product,
                'quantity' => $quantity
            ];
        }
    }


    /**
     * Entfernt ein Produkt aus dem Warenkorb
     *
     * @param integer $id
     * @return void
     */
    public function removeProduct(int $id): void
    {
        unset($this->items[$id]);
    }

    /**
     * Gibt alle Produkte im Warenkorb zurück
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Berechnet den Gesamtpreis des Warenkorbs
     *
     * @return float
     */
    public function getTotal(): float
    {
        return array_reduce($this->items, function ($carry, $item) {
            return $carry + ($item['product']->getPrice() * $item['quantity']);
        }, 0.0);
    }
}

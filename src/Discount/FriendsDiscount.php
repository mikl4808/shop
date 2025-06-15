<?php

namespace App\Discount;

class FriendsDiscount implements DiscountStrategyInterface
{
    /**
     * Überprüft, ob der Rabatt für den angegebenen Kundentyp unterstützt wird.
     *
     * @param string $customerType
     * @return boolean
     */
    public function supports(string $customerType): bool
    {
        return $customerType === 'friends';
    }

    /**
     * Berechnet den Rabatt für den angegebenen Gesamtbetrag.
     *
     * @param float $total
     * @return float
     */
    public function calculateDiscount(float $total): float
    {
        return $total * 0.15;
    }
}

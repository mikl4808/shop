<?php

namespace App\Discount;

class DiscountStrategyResolver
{
    /**
     * Konstruktor für den Rabattstrategie-Resolver
     * 
     * @param DiscountStrategyInterface[] $strategies
     */
    public function __construct(private iterable $strategies) {}

    /**
     * Löst die passende Rabattstrategie basierend auf dem Kundentyp auf.
     *
     * @param string $customerType
     * @return DiscountStrategyInterface
     */
    public function resolve(string $customerType): DiscountStrategyInterface
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->supports($customerType)) {
                return $strategy;
            }
        }

        throw new \RuntimeException("Keine gültige Rabattstrategie für '$customerType' gefunden.");
    }
}

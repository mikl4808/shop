<?php

namespace App\Model;

class Product
{
    /**
     * Produkt-ID
     *
     * @var integer
     */
    private int $id;

    /**
     * Produktname
     *
     * @var string
     */
    private string $name;

    /**
     * Produktpreis
     *
     * @var float
     */
    private float $price;

    /**
     * Konstruktor für das Produkt
     *
     * @param integer $id
     * @param string $name
     * @param float $price
     */
    public function __construct(int $id, string $name, float $price)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->price = $price;
    }

    /**
     * Getter für Produkt-ID
     *
     * @return integer
     */
    public function getId(): int
    { 
        return $this->id;
    }

    /**
     * Getter für Produktname
     *
     * @return string
     */
    public function getName(): string
    { 
        return $this->name;
    }

    /**
     * Getter für Produktpreis
     *
     * @return float
     */
    public function getPrice(): float
    { 
        return $this->price;
    }
}

<?php

namespace App\Models;

class Product
{

    /**
     * The product constructor.
     *
     * @param string $name
     *   The name of the product
     * @param float $unitPrice
     *   The unit price of the product
     */
    public function __construct(protected string $name, protected float $unitPrice)
    {
    }

    /**
     * Gets the name of the product.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the unit price.
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }
}

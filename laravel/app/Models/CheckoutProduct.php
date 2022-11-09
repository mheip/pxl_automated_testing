<?php

namespace App\Models;

class CheckoutProduct
{

    /**
     * The product constructor.
     *
     * @param \App\Models\Product $product The product
     * @param int $amount
     *   The amount of the product
     * @param float $discount
     *   The discount give to the product
     */
    public function __construct(protected Product $product, protected int $amount, protected float $discount = 0.0)
    {
    }

    /**
     * Gets the amount of items requested.
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Gets the discount percentage.
     */
    public function getDiscount(): float
    {
        return $this->discount;
    }

    /**
     * Gets the product model.
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * Does this checkout product have a discount?
     */
    public function hasDiscount(): bool
    {
        return $this->discount > 0;
    }

    /**
     * Returns the discount percentage.
     */
    public function getDiscountAmount(): float
    {
        return $this->getTotalPriceWithoutDiscount() * $this->discount;
    }

    /**
     * Gets the total price.
     *
     * Does not take the discount into account.
     *
     * @return float
     *   The total price.
     */
    public function getTotalPriceWithoutDiscount(): float
    {
        return $this->getProduct()->getUnitPrice() * $this->getAmount();
    }

    /**
     * Gets the total price, takes discount into consideration.
     *
     * @return float
     *   The discount.
     */
    public function getTotalPriceWithDiscount(): float
    {
        return $this->getTotalPriceWithoutDiscount() - $this->getDiscountAmount();
    }
}

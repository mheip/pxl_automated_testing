<?php

namespace App\Models;

class Checkout
{

    /**
     * The checkout constructor.
     *
     * @param \App\Models\CheckoutProduct[] $products
     */
    public function __construct(protected array $products = [])
    {
    }

    /**
     * The global discount.
     *
     * @var float
     */
    protected float $globalDiscount = 0.05;

    /**
     * Returns the products.
     *
     * @return \App\Models\CheckoutProduct[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * Calculates the total price, including VAT.
     *
     * @return float
     *   The total price, including VAT.
     */
    public function calculatePriceWithVat(): float
    {
        return $this->calculatePriceWithoutVat() + $this->calculateVat();
    }

    /**
     * Calculates the VAT amount.
     *
     * @return float
     *   The VAT amount.
     */
    public function calculateVat(): float
    {
        return $this->calculatePriceWithoutVat() * 0.21;
    }

    /**
     * Returns the global discount percentage.
     */
    public function getGlobalDiscountPercentage(): float
    {
        return $this->globalDiscount;
    }

    /**
     * Calculates the discount amount.
     */
    public function calculateDiscount(): float
    {
        return (float) $this->calculatePriceWithoutGlobalDiscount() * $this->getGlobalDiscountPercentage();
    }

    /**
     * Calculates the price without vat.
     *
     * @return float
     *   The price without VAT.
     */
    public function calculatePriceWithoutVat(): float
    {
        if ($this->applyGlobalDiscount()) {
            return $this->calculatePriceWithoutGlobalDiscount() - $this->calculateDiscount();
        }

        return $this->calculatePriceWithoutGlobalDiscount();
    }

    /**
     * Calculates the total price of all products.
     */
    public function calculatePriceWithoutGlobalDiscount(): float
    {
        // Loop over all products and calculate the total price.
        $totalPrice = 0;

        foreach ($this->getProducts() as $product) {
            $totalPrice += $product->getTotalPriceWithDiscount();
        }

        return (float) $totalPrice;
    }

    /**
     * The global discount is applied when we have 5 or more different products.
     */
    protected function applyGlobalDiscount(): bool
    {
        return count($this->getProducts()) >= 5;
    }
}

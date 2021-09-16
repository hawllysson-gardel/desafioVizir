<?php

class Order
{
    private $id;
    private $userId;
    private $shoppingCart;
    private $coupon;

    public function __construct(int $id, int $userId, object $shoppingCart, ?object $coupon = NULL)
    {
        if($shoppingCart->isEmpty())
        {
            throw new Exception('Shopping Cart Empty!');
        }

        $this->id           = $id;
        $this->userId       = $userId;
        $this->shoppingCart = $shoppingCart;
        $this->coupon       = $coupon;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getItems()
    {
        return $this->shoppingCart->getItems();
    }

    public function getTotalValueOfProducts()
    {
        return $this->shoppingCart->getTotalValueOfProducts();
    }

    public function getDiscountAmount()
    {
        if (!isset($this->coupon))
        {
            return 0.0;
        }

        return $this->coupon->getDiscount($this->shoppingCart);
    }

    public function getTotalValueOfOrder()
    {
        if (!isset($this->coupon))
        {
            return 0.0;
        }

        return $this->getDiscountAmount() < $this->getTotalValueOfProducts() ? ($this->getTotalValueOfProducts() - $this->getDiscountAmount()) : 0.0;
    }
}
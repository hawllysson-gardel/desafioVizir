<?php

class ShoppingCart
{
    private $id;
    private $userId;
    private $items;

    public function __construct(int $id, int $userId, array $items)
    {
        $this->id     = $id;
        $this->userId = $userId;
        $this->items  = $items;
    }

    public function isEmpty()
    {
        return count($this->items) ? false : true;
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
        return $this->items;
    }

    public function setItems(array $items)
    {
        $this->items = $items;
    }

    public function getTotalValueOfProducts()
    {
        $totalProductsValue = 0;

        foreach ($this->getItems() as $item)
        {
            $totalProductsValue = $totalProductsValue + $item->getPrice();
        }

        return $totalProductsValue;
    }
}
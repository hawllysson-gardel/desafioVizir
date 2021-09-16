<?php

class Product
{
    private $id;
    private $name;
    private $categoryId;
    private $price;

    public function __construct(int $id, string $name, int $categoryId, float $price)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->categoryId = $categoryId;
        $this->price      = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }
}
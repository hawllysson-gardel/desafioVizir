<?php

class Coupon
{
    private $id;
    private $code;
    private $scope;
    private $type;
    private $categoryId;
    private $percentage;
    private $value;

    const FLAG_ITEMS      = "ITEMS";
    const FLAG_ORDER      = "ORDER";
    const FLAG_PERCENTAGE = "PERCENTAGE";
    const FLAG_VALUE      = "VALUE";

    public function __construct(int $id, string $code, string $scope, string $type, int $categoryId = 0, float $percentage = 0.0, float $value = 0.0)
    {
        $this->id         = $id;
        $this->code       = $code;
        $this->scope      = $scope;
        $this->type       = $type;
        $this->categoryId = $categoryId;
        $this->percentage = $percentage;
        $this->value      = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode(string $code)
    {
        $this->code = $code;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function setScope(string $scope)
    {
        $this->scope = $scope;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getPercentage()
    {
        return $this->percentage;
    }

    public function setPercentage(float $percentage)
    {
        $this->percentage = $percentage;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue(float $value)
    {
        $this->value = $value;
    }

    public function getDiscount(object $shoppingCart)
    {
        $discount = 0.0;

        if($shoppingCart->isEmpty())
        {
            return $discount;
        }

        if ($this->getScope() == self::FLAG_ITEMS && $this->getType() == self::FLAG_PERCENTAGE)
        {            
            foreach ($shoppingCart->getItems() as $item)
            {
                if ($this->getCategoryId() == $item->getCategoryId())
                {
                    $discount = $discount + ($item->getPrice() * $this->getPercentage());
                }
            }
        }

        $totalOrderValue = $shoppingCart->getTotalValueOfProducts();
    
        if ($this->getScope() == self::FLAG_ORDER && $this->getType() == self::FLAG_PERCENTAGE)
        {
            $discount = $totalOrderValue * $this->getPercentage();
        }
    
        if ($this->getScope() == self::FLAG_ORDER && $this->getType() == self::FLAG_VALUE)
        {
            $discount = $this->getValue();
        }
    
        return $discount;
    }
}
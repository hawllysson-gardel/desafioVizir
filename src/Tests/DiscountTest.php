<?php

class DiscountTest
{
    public function ShouldCalculateCouponItemsPercentageTest()
    {
        // ID, NAME
        $categoryOne  = new Category(1, 'Eletronics');
        $categoryTwo  = new Category(2, 'Books');

        // ID, NAME, CATEGORYID, PRICE
        $productOne   = new Product(1, 'Notebook Lenovo 330', 1, 3000.00);
        $productTwo   = new Product(2, 'Clean Code',          2, 70.00);

        // ID, USERID, ARRAY_PRODUCTS
        $shoppingCart = new ShoppingCart(1, 1, array($productOne, $productTwo));

        // ID, CODE, SCOPE, TYPE, CATEGORYID, PERCENTAGE, VALUE
        $coupon       = new Coupon(1, 'COUPON', 'ITEMS', 'PERCENTAGE', 1, 0.1, 0.0);

        // ID, USERID, SHOPPING_CART, COUPON
        $order        = new Order(1, 1, $shoppingCart, $coupon);

        $receivedValue = $order->getDiscountAmount();
        $expectedValue = 300.0;

        $this->assertEquals($expectedValue, $receivedValue);
    }

    public function ShouldCalculateCouponOrderPercentageTest()
    {
        // ID, NAME
        $categoryOne   = new Category(1, 'Eletronics');
        $categoryTwo   = new Category(2, 'Books');

        // ID, NAME, CATEGORYID, PRICE
        $productOne    = new Product(1, 'Notebook Lenovo 330', 1, 3000.00);
        $productTwo    = new Product(2, 'Clean Code',          2, 70.00);

        // ID, USERID, ARRAY_PRODUCTS
        $shoppingCart  = new ShoppingCart(1, 1, array($productOne, $productTwo));

        // ID, CODE, SCOPE, TYPE, CATEGORYID, PERCENTAGE, VALUE
        $coupon        = new Coupon(1, 'COUPON', 'ORDER', 'PERCENTAGE', 0, 0.1, 0.0);

        // ID, USERID, SHOPPING_CART, COUPON
        $order         = new Order(1, 1, $shoppingCart, $coupon);

        $receivedValue = $order->getDiscountAmount();
        $expectedValue = 307;

        $this->assertEquals($expectedValue, $receivedValue);
    }

    public function ShouldCalculateCouponOrderValueTest()
    {
        // ID, NAME
        $categoryOne   = new Category(1, 'Eletronics');
        $categoryTwo   = new Category(2, 'Books');

        // ID, NAME, CATEGORYID, PRICE
        $productOne    = new Product(1, 'Notebook Lenovo 330', 1, 3000.00);
        $productTwo    = new Product(2, 'Clean Code',          2, 70.00);

        // ID, USERID, ARRAY_PRODUCTS
        $shoppingCart  = new ShoppingCart(1, 1, array($productOne, $productTwo));

        // ID, CODE, SCOPE, TYPE, CATEGORYID, PERCENTAGE, VALUE
        $coupon        = new Coupon(1, 'COUPON', 'ORDER', 'VALUE', 0, 0.0, 15.0);

        // ID, USERID, SHOPPING_CART, COUPON
        $order         = new Order(1, 1, $shoppingCart, $coupon);

        $receivedValue = $order->getDiscountAmount();
        $expectedValue = 15.0;

        $this->assertEquals($expectedValue, $receivedValue);
    }

    public function ShouldCheckoutIfShoppingCartIsNotEmptyTest()
    {
        // ID, NAME
        $categoryOne   = new Category(1, 'Eletronics');
        $categoryTwo   = new Category(2, 'Books');

        // ID, NAME, CATEGORYID, PRICE
        $productOne    = new Product(1, 'Notebook Lenovo 330', 1, 3000.00);
        $productTwo    = new Product(2, 'Clean Code',          2, 70.00);

        // ID, USERID, ARRAY_PRODUCTS
        $shoppingCart  = new ShoppingCart(1, 1, array($productOne, $productTwo));

        $receivedValue = $shoppingCart->isEmpty();
        $expectedValue = false;

        $this->assertEquals($expectedValue, $receivedValue);
    }

    public function ShouldCheckoutIfShoppingCartIsEmptyTest()
    {
        // ID, USERID, ARRAY_PRODUCTS
        $shoppingCart  = new ShoppingCart(1, 1, array());

        $receivedValue = $shoppingCart->isEmpty();
        $expectedValue = true;

        $this->assertEquals($expectedValue, $receivedValue);
    }

    public function assertEquals($expectedValue, $receivedValue)
    {
        if ($expectedValue != $receivedValue)
        {
            $message = 'Expected: ' . $expectedValue . ' but got: ' . $receivedValue;

            throw new \Exception($message);
        }

        echo "Test Passed! \n";
    }
}
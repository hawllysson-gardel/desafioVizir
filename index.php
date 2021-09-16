<?php

include 'autoloader.php';

// ID, NAME
$user          = new User(1, 'Hawllysson');

// ID, NAME
$categoryOne   = new Category(1, 'Eletronics');
$categoryTwo   = new Category(2, 'Books');
$categoryThree = new Category(3, 'Food');

// ID, NAME, CATEGORYID, PRICE
$productOne   = new Product(1, 'Notebook Lenovo 330', 1, 3000.00);
$productTwo   = new Product(2, 'Clean Code',          2, 70.00);
$productThree = new Product(3, 'Apple',               3, 5.00);

// ID, CODE, SCOPE, TYPE, CATEGORYID, PERCENTAGE, VALUE
$couponOne   = new Coupon(1, 'COUPONONE',   'ITEMS', 'PERCENTAGE', 1, 0.1, 0.0);
$couponTwo   = new Coupon(2, 'COUPONTWO',   'ORDER', 'PERCENTAGE', 0, 0.1, 0.0);
$couponThree = new Coupon(3, 'COUPONTHREE', 'ORDER', 'VALUE',      0, 0.0, 15.0);

// ID, USERID, ARRAY_PRODUCTS
$shoppingCart = new ShoppingCart(1, 1, array($productOne, $productTwo, $productThree));

// ID, USERID, SHOPPING_CART, COUPON
$orderService = new OrderService();
$order        = $orderService->checkout(1, 1, $shoppingCart, 'COUPONONE');

echo "Valor total do carrinho R$" . $order->getTotalValueOfProducts() . ".\n";
echo "Valor total do desconto R$" . $order->getDiscountAmount() . ".\n";
echo "Valor total do pedido R$" . $order->getTotalValueOfOrder() . ".\n";
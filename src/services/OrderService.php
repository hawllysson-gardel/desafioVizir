<?php

class OrderService
{
    public function checkout(int $id, int $userId, object $shoppingCart, ?string $couponCode = "")
    {
        // BUSCAR CUMPONS NO BANCO
        // await this.repository.findDiscount(couponCode);
        // $coupon = NULL;
        $coupon = new Coupon(1, 'COUPONONE',   'ITEMS', 'PERCENTAGE', 1, 0.1, 0.0);
        // $coupon = new Coupon(2, 'COUPONTWO',   'ORDER', 'PERCENTAGE', 0, 0.1, 0.0);
        // $coupon = new Coupon(3, 'COUPONTHREE', 'ORDER', 'VALUE',      0, 0.0, 15.0);

        $order = new Order($id, $userId, $shoppingCart, $coupon);
        
        // AMAZENAR
        //await this.repository.create(order, user_Id);

        // NOTIFICAR MENSAGEM
        //await this.messaging.notify("orders-created-queue", JSON.stringify({ discountCode, order, user_Id }));

        return $order;
    }
}

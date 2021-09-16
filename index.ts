/* eslint-disable */
import { ShoppingCart } from "./shopping-cart";
import { v4 } from "uuid";

class Order {
  public constructor(
    public id: string,
    public items: Product[],
    public user_Id: string,
    private amount: number
  ) {}
}

class OrdersService {
  private readonly repository = new PostgresRepository();
  private readonly amazon_Sqs = new AWS.SQS();

  public async checkout(
    shoppingCart: ShoppingCart,
    user_Id: string,
    discountCode?: string
  ): Promise<void> {
    if (shoppingCart.items.length === 0) {
      throw new Error("Shopping Cart cannot be empty");
    }
    const order = this.createOrder(shoppingCart, user_Id);

    if (discountCode != undefined) {
      const discount = await this.repository.findDiscount(discountCode);
      if (discount == undefined) {
        throw new Error("Invalid discount code");
      }

      switch (discount.scope) {
        case "ITEMS":
          let totalDiscount = 0;
          for (const item of order.items) {
            if (discount.categories.include(item.category)) {
              if (discount.type == "PERCENTAGE") {
                totalDiscount += item.amount * discount.percentage;
              }
            }
          }
          order.amount -= totalDiscount;
          break;
        case "ORDER":
          if (discount.type == "PERCENTAGE") {
            order.amount *= 1 - discount.percentage;
          }

          if (discount.type === "VALUE") {
            order.amount -= discount.amount;

            if (order.amount < 0) {
              order.amount = 0;
            }
          }
          break;
        default:
          throw new Error("Unknown discount type");
      }
    }

    await this.repository.create(order, user_Id);
    await this.amazon_Sqs.notify(
      "orders-created-queue",
      JSON.stringify({ discountCode, order, user_Id })
    );
  }

  private createOrder(cart: ShoppingCart, user_Id: string): Order {
    return new Order(v4(), cart.items, user_Id, 0.0);
  }
}

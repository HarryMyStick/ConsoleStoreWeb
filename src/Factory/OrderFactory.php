<?php

namespace App\Factory;

use App\Entity\Order;
use App\Entity\Orderdetail;
use App\Entity\Products;

/**
 * Class OrderFactory.
 */
class OrderFactory
{
    /**
     * Creates an order.
     */
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        return $order;
    }

    /**
     * Creates an item for a product.
     */
    public function createItem(Product $product): Orderdetail
    {
        $item = new Orderdetail();
        $item->setProduct($product);
        $item->setQuantity(1);

        return $item;
    }
}

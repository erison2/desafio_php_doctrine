<?php

namespace App\Controllers;

use App\Utils\Database;
use App\Models\Order;

class OrderController
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new Database())->getEntityManager();
    }

    public function listOrders()
    {
        return $this->entityManager->getRepository(Order::class)->findAll();
    }

    public function getOrder($id)
    {
        return $this->entityManager->find(Order::class, $id);
    }

    public function createOrder($data)
    {
        $order = new Order();
        $order->setUserId($data['user_id']);
        $order->setDescription($data['description']);
        $order->setQuantity($data['quantity']);
        $order->setPrice($data['price']);
        $order->setCreatedAt(new \DateTime());
        $order->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($order);
        $this->entityManager->flush();

        return $order;
    }

    public function updateOrder($id, $data)
    {
        $order = $this->entityManager->find(Order::class, $id);

        if ($order) {
            $order->setUserId($data['user_id']);
            $order->setDescription($data['description']);
            $order->setQuantity($data['quantity']);
            $order->setPrice($data['price']);
            $order->setUpdatedAt(new \DateTime());

            $this->entityManager->flush();

            return $order;
        }

        return null;
    }

    public function deleteOrder($id)
    {
        $order = $this->entityManager->find(Order::class, $id);

        if ($order) {
            $this->entityManager->remove($order);
            $this->entityManager->flush();
            return true;
        }

        return false;
    }
}

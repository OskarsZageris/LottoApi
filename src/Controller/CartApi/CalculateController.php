<?php

namespace App\Controller\CartApi;

use App\Entity\ShoppingCart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculateController extends AbstractController
{
    /**
     * @Route("/cart/api/calculate-total", name="app_cart_api_calculate_total", methods={"GET"})
     */
    public function calculateTotal(EntityManagerInterface $entityManager): JsonResponse
    {
        $shoppingCarts = $entityManager->getRepository(ShoppingCart::class)->findAll();

        $total = 0;
        foreach ($shoppingCarts as $shoppingCart) {
            $products = $shoppingCart->getProducts();
            foreach ($products as $product) {
                $total += $product->getPrice() * $shoppingCart->getQuantity();
            }
        }

        $response = [
            'total' => $total,
        ];

        return $this->json($response, Response::HTTP_OK);
    }
}
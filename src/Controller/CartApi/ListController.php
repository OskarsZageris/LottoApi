<?php

namespace App\Controller\CartApi;

use App\Entity\ShoppingCart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/cart/api/list-cart-products", name="app_cart_api_list_cart_products", methods={"GET"})
     */
    public function listCartProducts(EntityManagerInterface $entityManager): JsonResponse
    {
        $shoppingCarts = $entityManager->getRepository(ShoppingCart::class)->findAll();

        $response = [];
        foreach ($shoppingCarts as $shoppingCart) {
            $products = $shoppingCart->getProducts();
            foreach ($products as $product) {
                $response[] = [
                    'id' => $shoppingCart->getId(),
                    'productId' => $product->getId(),
                    'name' => $product->getName(),
                    'price' => $product->getPrice(),
                    'quantity' => $shoppingCart->getQuantity(),
                ];
            }
        }

        return $this->json($response, Response::HTTP_OK);
    }
}

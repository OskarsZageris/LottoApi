<?php

namespace App\Controller\CartApi;

use App\Entity\Product;
use App\Entity\ShoppingCart;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class RemoveController extends AbstractController
{
    /**
     * @Route("/cart/api/remove-from-cart", name="app_cart_api_remove_from_cart", methods={"DELETE"})
     */
    public function removeProductFromCart(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        // Retrieve the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        $productId = $data['id'];

        // Retrieve the shopping cart item from the database
        $cartItem = $entityManager->getRepository(ShoppingCart::class)->find($productId);

        if (!$cartItem) {
            // Item not found in the cart
            return $this->json(['message' => 'Item not found in the cart.'], Response::HTTP_NOT_FOUND);
        }

        $entityManager->remove($cartItem);
        $entityManager->flush();

        $response = [
            'message' => sprintf('Item with ID %d removed from the cart successfully.', $productId),
        ];

        return $this->json($response, Response::HTTP_OK);
    }
}

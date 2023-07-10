<?php

namespace App\Controller\CartApi;

use App\Entity\Product;
use App\Entity\ShoppingCart;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    /**
     * @Route("/cart/api/add-to-cart", name="app_cart_api_add_to_cart", methods={"POST"})
     */
    public function addProductToCart(Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepository): JsonResponse
    {
        // Retrieve the JSON data from the request body
        $data = json_decode($request->getContent(), true);

        $productId = $data['id'];
        $productQuantity = $data['quantity'];

        $product = $productRepository->find($productId);

        if (!$product) {
            // Product not found
            return $this->json(['message' => 'Product not found.'], Response::HTTP_NOT_FOUND);
        }

        $productName = $product->getName();

        $cartItem = new ShoppingCart();


        $cartItem->setQuantity($productQuantity);
        $cartItem->addProduct($product);

        $entityManager->persist($cartItem);
        $entityManager->flush();

        $response = [
            'message' => "$productName added to the cart successfully.",
        ];

        return $this->json($response, Response::HTTP_CREATED);
    }
}
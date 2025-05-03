<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/products')]
class ProductController extends AbstractController
{
    private static array $products = [];
    private static int $nextId = 1;

    public function __construct()
    {
        if (empty(self::$products)) {
            self::$products = [
                1 => ['id' => 1, 'name' => 'Laptop', 'price' => 999.99, 'description' => 'High-performance laptop'],
                2 => ['id' => 2, 'name' => 'Smartphone', 'price' => 599.99, 'description' => 'Latest model'],
                3 => ['id' => 3, 'name' => 'Headphones', 'price' => 199.99, 'description' => 'Wireless headphones'],
            ];
            self::$nextId = 4;
        }
    }

    #[Route('/', name: 'product_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json(array_values(self::$products));
    }

    #[Route('/{id}', name: 'product_show', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        if (!isset(self::$products[$id])) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        return $this->json(self::$products[$id]);
    }

    #[Route('/new', name: 'product_new', methods: ['POST', 'GET'])]
    public function create(Request $request): \Symfony\Component\HttpFoundation\Response
    {
        if ($request->isMethod('GET')) {
            return $this->render('product/new.html.twig');
        }

        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['name'], $data['price'], $data['description'])) {
            return $this->json(['error' => 'Invalid data'], 400);
        }

        $product = [
            'id' => self::$nextId++,
            'name' => $data['name'],
            'price' => (float)$data['price'],
            'description' => $data['description']
        ];

        self::$products[$product['id']] = $product;

        return $this->json($product, 201);
    }

    #[Route('/{id}/edit', name: 'product_edit', methods: ['PUT', 'GET'])]
    public function update(Request $request, int $id): \Symfony\Component\HttpFoundation\Response
    {
        if (!isset(self::$products[$id])) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        if ($request->isMethod('GET')) {
            return $this->render('product/edit.html.twig');
        }

        $data = json_decode($request->getContent(), true);

        if (!$data || !isset($data['name'], $data['price'], $data['description'])) {
            return $this->json(['error' => 'Invalid data'], 400);
        }

        self::$products[$id] = [
            'id' => $id,
            'name' => $data['name'],
            'price' => (float)$data['price'],
            'description' => $data['description']
        ];

        return $this->json(self::$products[$id]);
    }

    #[Route('/{id}/delete', name: 'product_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        if (!isset(self::$products[$id])) {
            return $this->json(['error' => 'Product not found'], 404);
        }

        unset(self::$products[$id]);

        return $this->json(['message' => 'Product deleted']);
    }
}

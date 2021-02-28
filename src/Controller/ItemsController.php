<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Item;
use App\Services\ItemsApiInterface;
use React\Promise\PromiseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ItemsController
{
    /**
     * ItemsController constructor.
     * @param ItemsApiInterface $api
     */
    public function __construct(private ItemsApiInterface $api)
    {
    }

    #[Route("/api/items/{id<\d>}", methods: ["GET"])]
    public function index(string $id): PromiseInterface
    {
        return $this->api->get($id)
                ->then(fn (Item $item) => new JsonResponse($item));
    }
}

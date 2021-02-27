<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Item;
use App\Services\ItemsApiInterface;
use React\Promise\PromiseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ItemsController
{
    /**
     * ItemsController constructor.
     * @param ItemsApiInterface $api
     */
    public function __construct(private ItemsApiInterface $api)
    {
    }

    public function index(string $id): PromiseInterface
    {
        return $this->api->get($id)
                ->then(function (Item $item) {
                    return new JsonResponse($item);
                });
    }
}

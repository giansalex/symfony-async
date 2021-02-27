<?php

declare(strict_types=1);

namespace App\Controller;

use App\Services\ItemsApiInterface;
use React\Promise\PromiseInterface;

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
        return $this->api->get($id);
    }
}

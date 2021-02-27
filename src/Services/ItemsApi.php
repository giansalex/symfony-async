<?php

declare(strict_types=1);

namespace App\Services;

use App\Entity\Item;
use Psr\Http\Message\ResponseInterface;
use React\Http\Browser;
use React\Promise\PromiseInterface;

class ItemsApi implements ItemsApiInterface
{
    /**
     * ItemsApi constructor.
     * @param Browser $client
     */
    public function __construct(private Browser $client)
    {
        $this->client = $client->withBase('https://jsonplaceholder.typicode.com/');
    }

    /**
     * @param string $id
     * @return PromiseInterface<Item>
     */
    public function get(string $id): PromiseInterface
    {
        return $this->client->get("todos/$id")
                ->then(function (ResponseInterface $response) {
                    $json = (string)$response->getBody();

                    return Item::fromJson($json);
                });
    }
}
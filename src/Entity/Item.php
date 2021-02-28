<?php

declare(strict_types=1);

namespace App\Entity;

use function Safe\json_decode;

class Item
{
    public int $userId;
    public int $id;
    public string $title;
    public bool $completed;

    public static function fromJson(string $json): Item
    {
        $result = json_decode($json);

        $item = new Item();
        $item->userId = $result->userId;
        $item->id = $result->id;
        $item->title = $result->title;
        $item->completed = $result->completed;

        return $item;
    }
}
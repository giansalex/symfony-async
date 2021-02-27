<?php

declare(strict_types=1);

namespace App\Services;

use React\Promise\PromiseInterface;

interface ItemsApiInterface
{
    function get(string $id): PromiseInterface;
}
# Symfony async

This project is a demo for symfony async requests using [reactphp](https://reactphp.org/).

## Requirements

- PHP `8.0`
- `pcntl` extension

## Run

Install packages
```bash
composer install
```

Run server

```bash
vendor/bin/server run 127.0.0.1:8000 --adapter=App\\AppKernelAdapter
```

Go to http://127.0.0.1:8000/api/items/1


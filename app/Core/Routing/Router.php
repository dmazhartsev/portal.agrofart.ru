<?php

declare(strict_types=1);

namespace App\Core\Routing;

use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Path;
use App\Core\Route;

final class Router
{
    private array $routes = [];

    public function load(string $file): void
    {
        Route::setRouter($this);

        require $file;
    }

    public function get(string $uri, callable|array|string $action): void
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, callable|array|string $action): void
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function dispatch(Request $request): Response
    {
        $this->load(Path::root('routes/web.php'));

        $method = $request->method();
        $uri = $request->uri();

        if (!isset($this->routes[$method][$uri])) {
            return new Response('<h1>404</h1>', 404);
        }

        $action = $this->routes[$method][$uri];

        if (is_callable($action)) {
            return $action($request);
        }

        return new Response('<h1>Controller routing coming soon</h1>');
    }
}
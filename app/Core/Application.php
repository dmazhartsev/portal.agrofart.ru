<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Config\Config;

final class Application
{
    private function __construct()
    {
    }

    public static function boot(): self
    {
        $root = dirname(__DIR__, 2);

        Environment::load($root);

        ErrorHandler::register(
            filter_var(Config::get('APP_DEBUG', false), FILTER_VALIDATE_BOOL)
        );

        return new self();
    }

    public function run(): void
    {
        echo '<h1>Portal Agrofart 2.0</h1>';
    }
}
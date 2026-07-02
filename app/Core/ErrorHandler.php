<?php

declare(strict_types=1);

namespace App\Core;

use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

final class ErrorHandler
{
    public static function register(bool $debug): void
    {
        if (!$debug) {
            return;
        }

        $whoops = new Run();
        $whoops->pushHandler(new PrettyPageHandler());
        $whoops->register();
    }
}
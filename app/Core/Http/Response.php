<?php

declare(strict_types=1);

namespace App\Core\Http;

final class Response
{
    public function html(string $content, int $status = 200): never
    {
        http_response_code($status);

        echo $content;

        exit;
    }

    public function redirect(string $url): never
    {
        header("Location: {$url}");

        exit;
    }

    public function json(array $data, int $status = 200): never
    {
        http_response_code($status);

        header('Content-Type: application/json');

        echo json_encode(
            $data,
            JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );

        exit;
    }
}
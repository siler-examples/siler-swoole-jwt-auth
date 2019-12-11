<?php declare(strict_types=1);

namespace Acme;

use Firebase\JWT\JWT;
use Throwable;
use function Siler\array_get;
use function Siler\Dotenv\env;
use function Siler\Swoole\emit;
use function Siler\Swoole\request;
use function Siler\Twig\render;

$login_html = render('login.twig');

return function () use ($login_html): void {
    $cookies = request()->cookie;
    $token = array_get($cookies, 'token');

    if ($token === null) {
        emit($login_html);
        return;
    }

    try {
        $token = JWT::decode($token, env('APP_KEY'), ['HS256']);
        emit('Redirect', 302, ['Location' => '/dashboard']);
    } catch (Throwable $exception) {
        var_dump($exception->getMessage());
        emit($login_html);
    }
};

<?php declare(strict_types=1);

namespace Acme;

use Firebase\JWT\JWT;
use Throwable;
use function Siler\array_get;
use function Siler\Dotenv\env;
use function Siler\Swoole\emit;
use function Siler\Swoole\request;
use function Siler\Twig\render;

return function () {
    $cookies = request()->cookie;

    var_dump($cookies);

    $token = array_get($cookies, 'token');

    if ($token === null) {
        emit('Redirect', 302, ['Location' => '/login']);
        return;
    }

    try {
        $token = JWT::decode($token, env('APP_KEY'), ['HS256']);
        emit(render('dashboard.twig', ['username' => $token->username]));
    } catch (Throwable $exception) {
        var_dump($exception->getMessage());
        emit('Redirect', 302, ['Location' => '/login']);
    }
};

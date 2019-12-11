<?php declare(strict_types=1);

namespace Acme\Http;

use Acme\Http\Api\Auth\Login;
use Siler\Route;
use Siler\Swoole;

class Api
{
    public function __invoke()
    {
        Swoole\cors();
        Route\post('/login', new Login());
    }
}


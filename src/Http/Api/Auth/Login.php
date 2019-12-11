<?php declare(strict_types=1);

namespace Acme\Http\Api\Auth;

use Firebase\JWT\JWT;
use function Siler\Dotenv\env;
use function Siler\Encoder\Json\decode;
use function Siler\Swoole\json;
use function Siler\Swoole\raw;

class Login
{
    public function __invoke()
    {
        $input = raw();

        if (empty($input)) {
            json([
                'error' => true,
                'message' => 'Missing credentials',
            ], 422);
            return;
        }

        $credentials = decode($input);

        if ($credentials['username'] !== 'siler' || $credentials['password'] !== 'rocks') {
            json([
                'error' => true,
                'message' => 'Unauthorized',
            ], 401);
            return;
        }

        $payload = ['username' => $credentials['username']];
        $token = JWT::encode($payload, env('APP_KEY'));

        json([
            'error' => false,
            'data' => $token,
        ]);
    }
}

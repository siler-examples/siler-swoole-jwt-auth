<?php declare(strict_types=1);

namespace Acme\Http;

use function Siler\Route\files;
use function Siler\Route\get;
use function Siler\Swoole\emit;
use function Siler\Twig\init;

class Website
{
    public function __construct()
    {
        init(
            __DIR__ . '/../../web/templates',
            __DIR__ . '/../../web/templates/cache',
            true
        );
    }

    public function __invoke()
    {
        get('/', fn() => emit('Redirect', 302, ['Location' => '/dashboard']));
        files(__DIR__ . '/../../web/pages');
    }
}

<?php declare(strict_types=1);

namespace Acme;

use Acme\Http\{Api, Website};
use function Siler\Swoole\{http, http_server_port};

require_once __DIR__ . '/../vendor/autoload.php';

$servers = http(new Api(), 3000);
$servers->set([
    'enable_static_handler' => true,
    'document_root' => __DIR__ . '/../web/public',
]);
$website = http_server_port($servers, new Website(), 8000);
$servers->start();



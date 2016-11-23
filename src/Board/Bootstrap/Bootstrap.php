<?php
declare(strict_types = 1);

namespace LapisAngularis\Senshu\Framework\Bootstrap;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use LapisAngularis\Senshu\Framework\Http\HttpResponse;
use LapisAngularis\Senshu\Framework\Http\HttpRequest;
use LapisAngularis\Senshu\Framework\Router\Router;
use LapisAngularis\Senshu\Framework\Router\RouteCollection;

require __DIR__ . '/../../../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'dev';

$errorHandler = new Run;
if ($environment !== 'prod') {
    $errorHandler->pushHandler(new PrettyPageHandler);
} else {
    $errorHandler->pushHandler(function($e){
        echo 'Error Page';
    });
}
$errorHandler->register();

$request = new HttpRequest($_GET, $_POST, $_COOKIE, $_SERVER);

$collection = new RouteCollection();

$collection->get('/', function() {
    $content = 'This is index.';
    $response = new HttpResponse;
    $response->setContent($content);
    foreach ($response->getHeaders() as $header) {
        header($header, false);
    }

    echo $response->getContent();
    return $response;
});

$collection->get('/test/{qq}', function($i) {
    $content = 'jp2 '. $i;
    $response = new HttpResponse;
    $response->setContent($content);
    foreach ($response->getHeaders() as $header) {
        header($header, false);
    }

    echo $response->getContent();
    return $response;
});

$collection->post('/xxx', function() {
    $content = 'this is post ';
    $response = new HttpResponse;
    $response->setContent($content);
    $response->setStatusCode(201);

    foreach ($response->getHeaders() as $header) {
        header($header, false);
    }

    echo $response->getContent();
    return $response;
});

$router = new Router($collection, $request);
$router->matchRequest();
<?php
use DI\Container as Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use Controller\ProdottoController;


require __DIR__ . '/../vendor/autoload.php';
require_once '../conf/config.php';
use League\Plates\Engine;

$container = new Container();

// Set container to create App with on AppFactory
AppFactory::setContainer($container);

$app = AppFactory::create();

//Questa parte deve contenere il percorso della
//sottocartella dove si trova l'applicazione in questo caso inserito nella
//variabile di configurazione BASE_PATH
$app->setBasePath(BASE_PATH);

$container->set('template', function (){
    $engine = new Engine('../templates', 'tpl');
    $engine->addData(['base_path' => BASE_PATH]);
    return $engine;
});

$container->set('prodotto-controller', function (){
    $engine = new Engine('../templates', 'tpl');
    $engine->addData(['base_path' => BASE_PATH]);
    return new ProdottoController($engine);
});

/**
 * Add Error Middleware
 *
 * @param bool                  $displayErrorDetails -> Should be set to false in production
 * @param bool                  $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool                  $logErrorDetails -> Display error details in error log
 * @param LoggerInterface|null  $logger -> Optional PSR-3 Logger
 *
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

//$app->add($container->get('template')));

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/altra_pagina', function (Request $request, Response $response, $args) {
    $response->getBody()->write('Questa è un\'altra pagina');
    return $response;
});

$app->get('/saluti/{name}', function (Request $request, Response $response, $args) {
    $template = $this->get('template');
    $response->getBody()->write($template->render('saluti',
            [
                'name' => $args['name']
            ]
        )
    );
    return $response;
});

$app->get('/negozio', function (Request $request, Response $response, $args) {
    $controller = $this->get('prodotto-controller');
    $listaProdotti = $controller->listAll();
    $response->getBody()->write($listaProdotti);
    return $response;
});

$app->get('/negozio/genere/{genere}', function (Request $request, Response $response, $args) {
    $controller = $this->get('prodotto-controller');
    $listaProdotti = $controller->listAllByGenre($args['genere']);
    $response->getBody()->write($listaProdotti);
    return $response;
});

$app->run();

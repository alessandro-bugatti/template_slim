<?php

use Controller\AdminController;
use DI\Container as Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;

use Controller\ProdottoController;


require '../vendor/autoload.php';
require_once '../conf/config.php';
use League\Plates\Engine;

$container = new Container();

// Da inserire prima della create di AppFactory
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

$container->set('images', IMAGES);

// Define Custom Error Handler
$customErrorHandler = function (
    Request $request,
    Throwable $exception,
    bool $displayErrorDetails,
    bool $logErrors,
    bool $logErrorDetails
) use ($app) {
    $payload = ['error' => $exception->getMessage()];

    $response = $app->getResponseFactory()->createResponse();
    $engine = $app->getContainer()->get('template');

    if ($exception instanceof \Slim\Exception\HttpNotFoundException) {
        $response->getBody()->write(
            $engine->render('404', $payload)
        );
    }else{
        $response->getBody()->write(
            "Errore nella pagina"
        );
    }
    return $response;
};

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
if (MY_ERROR_HANDLER)
    $errorMiddleware->setDefaultErrorHandler($customErrorHandler);

//$app->add($container->get('template')));

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->get('/hello/{name}', function (Request $request, Response $response, $args) {
    $name = $args['name'];
    $response->getBody()->write('Hello ' . $name);
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

$app->get('/negozio',ProdottoController::class . ':listAll');

$app->get('/negozio/genere/{genere}', ProdottoController::class . ':listAllByGenre');

$app->get('/admin', AdminController::class . ':listAll');

$app->get('/admin/prodotto[/{id}]', AdminController::class . ':formProdotto');

$app->post('/admin/prodotto[/{id}]', AdminController::class . ':addProdotto');

$app->get('/admin/prodotto/{id}/delete', AdminController::class . ':deleteProdotto');

$app->get('/negozio/prodotto[/{id}]', ProdottoController::class . ':showProdotto');

$app->run();

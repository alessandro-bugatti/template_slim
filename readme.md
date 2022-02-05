# Come creare la prima applicazione in Slim

Sito di riferimento: [Slim](https://www.slimframework.com/docs/v4/)

## Come installare

In un mondo ideale senza proxy basta usare Composer.

```bash
composer require slim/slim:"4.*"
```

Se invece in laboratorio fosse impossibile usarlo per via del proxy farsi passare da chi lavora su un proprio computer il folder *vendor* creato da Composer, come già fatto per Plates.

Successivamente è necessario un altro componente per gestire le richieste sempre con Composer.

```bash
composer require slim/psr7
```

Lo stesso discorso fatto prima sul proxy vale anche qua.

A questo punto creare nel progetto una cartella *public* e al suo interno inserire il file *index.php*, che diventerà il front-controller dell'applicazione, cioè ogni richiesta passerà attraverso di lui.

Il contenuto di questo file può essere popolato in questo modo

```php
<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
$response->getBody()->write("Hello world!");
return $response;
});

$app->run();

```

## Configurare Apache per l'URL rewriting
Poichè l'applicazione ha bisogno che tutte le richieste HTTP arrivino al file *index.php*, è necessario istruire il web server per fare in modo che ogni richiesta che arriva faccia partire il file *index.php*, indipendentemte da quale sia la richiesta presente nell'URL.

Usando Apache presente in Xampp bisogna seguire questi passi
- abilitare il modulo di URL rewriting. Per far questo aprire con un editor di testo (anche PHPStorm va bene) il file ```
- directory_di_xampp/apache/conf/httpd.conf``` e controllare se la riga
```
LoadModule rewrite_module modules/mod_rewrite.so
```
ha un **#** davanti, se così fosse va eliminato. Si faccia la stessa cosa per la riga
```
LoadModule actions_module modules/mod_actions.so
```

<?php

namespace Controller;

use Model\ProdottoRepository;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class ProdottoController{

    private $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function listAll(Request $request, Response $response, array $args): Response
    {
        return $this->listAllByGenre($request, $response,['genere' => 'All']);
    }

    public function listAllByGenre(Request $request, Response $response, array $args): Response{
        $genere = $args['genere'];
        if ($genere === 'All')
            $prodotti = ProdottoRepository::listAll();
        else if ($genere === 'Uomo')
            $prodotti = ProdottoRepository::listAllMale();
        else
            $prodotti = ProdottoRepository::listAllFemale();
        $engine = $this->container->get('template');
        $response->getBody()->write($engine->render('negozio',
            [
                'prodotti' => $prodotti,
                'genere' => $genere
            ]
        ));
        return $response;
    }
}
<?php

namespace Controller;

use Model\ProdottoRepository;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class AdminController{

    private $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function listAll(Request $request, Response $response, array $args): Response
    {
        $engine = $this->container->get('template');
        $prodotti = ProdottoRepository::listAll();
        $response->getBody()->write($engine->render('adminPanel',
            [
                'prodotti' => $prodotti
            ]
        ));
        return $response;
    }
}
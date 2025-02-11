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
        $response->getBody()->write($engine->render('pannelloAdmin',
            [
                'prodotti' => $prodotti
            ]
        ));
        return $response;
    }

    public function formProdotto(Request $request, Response $response, array $args): Response
    {
        $engine = $this->container->get('template');
        $response->getBody()->write($engine->render('formProdotto'));
        return $response;
    }

    public function addProdotto(Request $request, Response $response, array $args): Response{
        $params = (array)$request->getParsedBody();
        ProdottoRepository::addProdotto($params);
        $response = $response->withStatus(302);
        return $response->withHeader('Location', BASE_PATH . '/admin');
    }

    public function deleteProdotto(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        ProdottoRepository::deleteProdotto($id);
        $response = $response->withStatus(302);
        return $response->withHeader('Location', BASE_PATH . '/admin');
    }


}
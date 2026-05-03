<?php

namespace Controller;

use Laravel\SerializableClosure\UnsignedSerializableClosure;
use Model\OperaRepository;
use Model\ProdottoRepository;
use Psr\Container\ContainerInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Util\Authenticator;

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
        $prodotto = null;
        if ($args != null)
            $prodotto = ProdottoRepository::getProdotto($args['id']);
        $response->getBody()->write($engine->render('formProdotto',
            [
                'prodotto' => $prodotto
            ])
        );
        return $response;
    }

    public function addProdotto(Request $request, Response $response, array $args): ?Response{
        $params = (array)$request->getParsedBody();
        $uploadedFiles = $request->getUploadedFiles();
        if ($uploadedFiles['immagine']->getError() === UPLOAD_ERR_NO_FILE){
            $name = ProdottoRepository::getProdotto($args['id'])['image'];
        }
        else {
            $uploadedFile = $uploadedFiles['immagine'];
            $name = sha1($uploadedFile->getClientFilename() . rand()) . '.jpg';
            $imageDir = rtrim(IMAGES_DIR, '/');
            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0775, true);
            }
            $filename = $imageDir . '/' . $name;
            $uploadedFile->moveTo($filename);
        }
        //Viene aggiunto il nome dell'immagine per poterla memorizzare nel DB
        $params['image'] = $name;
        if ($args != null)
            ProdottoRepository::update($args['id'], $params);
        else
            ProdottoRepository::add($params);
        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/admin');
    }

    public function deleteProdotto(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        ProdottoRepository::delete($id);
        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/admin');
    }

    public function login(Request $request, Response $response, array $args): Response{
        $engine = $this->container->get('template');
        $response->getBody()->write($engine->render('login'));
        return $response;
    }

    public function logout(Request $request, Response $response, array $args): Response{
        Authenticator::logout();
        $response = $response->withStatus(302);
        return $response->withHeader('Location', '/negozio');
    }
}
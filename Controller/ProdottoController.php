<?php

namespace Controller;

use League\Plates\Engine;
use Model\ProdottoRepository;

class ProdottoController{

    private Engine $templateEngine;

    public function __construct(Engine $templateEngine){
        $this->templateEngine = $templateEngine;
    }

    public function listAll(){
        return $this->listAllByGenre('All');
    }

    public function listAllByGenre($genere){
        if ($genere === 'All')
            $prodotti = ProdottoRepository::listAll();
        else if ($genere === 'Uomo')
            $prodotti = ProdottoRepository::listAllMale();
        else
            $prodotti = ProdottoRepository::listAllFemale();
        return $this->templateEngine->render('negozio',
            [
                'prodotti' => $prodotti,
                'genere' => $genere
            ]
        );

    }
}
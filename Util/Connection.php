<?php

namespace Util;
use PDO;

require_once '../conf/config.php';
/**
 * Classe per gestire la connessione al database
 */



class Connection
{

    private static PDO $pdo;

    /**
     * Costruttore privato per evitare la creazione di oggetti
     */
    private function __construct()
    {

    }

    public static function getInstance(): PDO
    {
        if (!isset($pdo)) {
            /** Variabili definite in config.php
             * @var string $host
             * @var string $database
             * @var string $user
             * @var string $password
             */
            $DSN = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
            $pdo = new PDO($DSN, DB_USER, DB_PASSWORD);
        }
        return $pdo;
    }
}


<?php
/**
 * File di configurazione che recupera i valori attuali
 * dal file con le varaibili d'ambiente (.env)
 */

// Database
define('DB_HOST', $_ENV['MYSQL_HOST']     ?? 'database');
define('DB_NAME', $_ENV['MYSQL_DATABASE'] ?? '');
define('DB_USER', $_ENV['MYSQL_USER']     ?? '');
define('DB_PASSWORD', $_ENV['MYSQL_PASSWORD'] ?? '');
define('DB_CHAR', 'utf8mb4');

//Attiva il gestore di errori personalizzato
define('MY_ERROR_HANDLER', $_ENV['MYSQL_PASSWORD'] != 'development');

<?php
/**
 * File di configurazione che recupera i valori attuali
 * dal file con le varaibili d'ambiente (.env)
 */

function env_bool(string $key, bool $default): bool
{
	if (!array_key_exists($key, $_ENV)) {
		return $default;
	}

	return filter_var($_ENV[$key], FILTER_VALIDATE_BOOL);
}

// Database
define('DB_HOST', $_ENV['MYSQL_HOST']     ?? 'database');
define('DB_NAME', $_ENV['MYSQL_DATABASE'] ?? '');
define('DB_USER', $_ENV['MYSQL_USER']     ?? '');
define('DB_PASSWORD', $_ENV['MYSQL_PASSWORD'] ?? '');
define('DB_CHAR', 'utf8mb4');

// Applicazione
define('APP_ENV', $_ENV['APP_ENV'] ?? 'development');
define('APP_DEBUG', env_bool('APP_DEBUG', APP_ENV === 'development'));
define('APP_USE_CUSTOM_ERROR_HANDLER', env_bool('APP_USE_CUSTOM_ERROR_HANDLER', APP_ENV !== 'development'));
define('TEMPLATE_DIR', $_ENV['TEMPLATE_DIR'] ?? 'templates');
define('IMAGES_DIR', $_ENV['IMAGES_DIR'] ?? 'images');
define('IMAGES_BASE_URL', $_ENV['IMAGES_BASE_URL'] ?? '/images');
define('ASSETS_BASE_URL', $_ENV['ASSETS_BASE_URL'] ?? '/assets');
define('UPLOAD_MAX_FILE_SIZE', (int)($_ENV['UPLOAD_MAX_FILE_SIZE'] ?? 1000000));

// Compatibilita' con il resto del codice
define('MY_ERROR_HANDLER', APP_USE_CUSTOM_ERROR_HANDLER);

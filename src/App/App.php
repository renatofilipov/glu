<?php
/**
 * Loads environment variables and other dependencies.
 *
 * @author Renato Filipov <renato@filipov.me>
 * @license http://renato.filipov.me
 */

require __DIR__ . '/../../vendor/autoload.php';

$baseDir = __DIR__ . '/../../';
$envFile = $baseDir . '.env';

if (file_exists($envFile)) {
    $dotenv = new Dotenv\Dotenv($baseDir);
    $dotenv->load();
}

$settings = require __DIR__ . '/Settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '/Dependencies.php';
require __DIR__ . '/Services.php';
require __DIR__ . '/DAOs.php';
require __DIR__ . '/Routes.php';

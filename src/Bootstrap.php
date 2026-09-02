<?php
declare(strict_types=1);

namespace DurakBackend;

require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

$environment = 'development';

// Registering the error handler
$whoops = new \Whoops\Run;
if ($environment === 'development') {
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else {
    $whoops->pushHandler(function ($e) {
        echo 'Todo: Friendly error page and send email to dev.';
    });
}

$whoops->register();

throw new \Exception;
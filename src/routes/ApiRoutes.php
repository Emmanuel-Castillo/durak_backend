<?php declare(strict_types=1);

$apiRoutes = [
    ['GET', $api . '/hello-world', function () {
        echo 'Hello World!';
    }]
];

return $apiRoutes;
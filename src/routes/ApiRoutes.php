<?php declare(strict_types=1);

$baseNamespace = "DurakBackend\Api\Controllers";
$apiRoutes = [
    ['GET', $api. '/users', [$baseNamespace . '\UserController', 'getAllUsers']],
    ['POST', $api. '/users', [$baseNamespace . '\UserController', 'createUser']],
    ['DELETE', $api. '/users', [$baseNamespace . '\UserController', 'deleteUser']],
];

return $apiRoutes;
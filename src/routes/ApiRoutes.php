<?php declare(strict_types=1);

$apiRoutes = [
    ['GET', $api. '/users', ['DurakBackend\Api\Controllers\UserController', 'getAllUsers']]
];

return $apiRoutes;
<?php declare(strict_types=1);

$baseUri = '/durak_backend';
$api = $baseUri . '/api';
$admin = $baseUri . '/admin';

$apiRoutes = include('routes/ApiRoutes.php');
$adminRoutes = include('routes/AdminRoutes.php');

return array_merge($apiRoutes, $adminRoutes);
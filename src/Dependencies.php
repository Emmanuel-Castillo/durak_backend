<?php declare(strict_types=1);

$injector = new \Auryn\Injector;
$serviceNamespace = 'DurakBackend\\Shared\\Services\\';
$repositoryNamespace = 'DurakBackend\\Shared\\Repositories\\';

// Inject db connection
$conn = include('config/db.php');
$injector->share($conn);

// Inject HTTP request and response
$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get'=> $_GET,
    ':post'=> $_POST,
    ':cookies'=> $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
    ':inputStream' => file_get_contents('php://input')
]);
$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

function aliasService($interface, $implementation) {
    global $injector;
    global $serviceNamespace;
    $injector->alias($serviceNamespace . $interface, $serviceNamespace . $implementation);
}

function aliasRepository($interface, $implementation) {
    global $injector;
    global $repositoryNamespace;
    $injector->alias($repositoryNamespace . $interface, $repositoryNamespace . $implementation);
}

// Alias services here
$services = [
    'IUserService' => 'UserService'
];
foreach ($services as $interface => $implementation) {
    aliasService($interface, $implementation);
}

// Alias repositories here
$repositories = [
    'IUserRepository' => 'UserRepository'
];
foreach ($repositories as $interface => $implementation) {
    aliasRepository($interface, $implementation);
}

return $injector;
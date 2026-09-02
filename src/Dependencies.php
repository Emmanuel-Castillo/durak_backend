<?php declare(strict_types=1);

$injector = new \Auryn\Injector;
$serviceNamespace = 'DurakBackend\\Shared\\Services\\';
$repositoryNamespace = 'DurakBackend\\Shared\\Repositories\\';

// Inject db connection
$conn = include('config/db.php');
$injector->share($conn);

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
<?php declare(strict_types=1);

$adminRoutes = [
    ['GET', $admin . '/dashboard', function () {
        echo 'Admin Dashboard';
    }]
];

return $adminRoutes;
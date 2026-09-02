<?php declare(strict_types=1);

namespace DurakBackend\Api\Controllers;

use DurakBackend\Shared\Services\IUserService;

class UserController {
    private IUserService $userService;

    public function __construct(IUserService $userService) {
        $this->userService = $userService;
    }
    public function getAllUsers() {
        $result = $this->userService->getAllUsers();
        echo json_encode($result);
    }
}
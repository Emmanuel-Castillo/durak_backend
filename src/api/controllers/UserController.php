<?php declare(strict_types=1);

namespace DurakBackend\Api\Controllers;

use DurakBackend\Shared\Services\IUserService;

class UserController extends BaseController {
    private IUserService $userService;

    public function __construct(
        IUserService $userService,
        \Http\Request $request,
        \Http\Response $response) {
        parent::__construct($request, $response);
        $this->userService = $userService;
    }
    public function getAllUsers() {
        $result = $this->userService->getAllUsers();
        $this->returnJSONResponse($result);
    }
    public function createUser() {
        $data = $this->fetchJSONBody();
        $username = $data["username"];
        $password = $data["password"];
        $email = $data["email"];
        $result = $this->userService->createUser($username, $email, $password);
        $response = [
            "status" => $result ? "success" : "failure"
        ];
        $this->returnJSONResponse($response);
    }
    public function deleteUser() {
        $data = $this->fetchJSONBody();
        $email = $data["email"];
        $result = $this->userService->deleteUser($email);
        $response = [
            "status" => $result ? "success" : "failure"
        ];
        $this->returnJSONResponse($response);
    }
}
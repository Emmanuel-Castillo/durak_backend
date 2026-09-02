<?php declare(strict_types=1);

namespace DurakBackend\Shared\Services;

use DurakBackend\Shared\Repositories\IUserRepository;

interface IUserService {
    public function getAllUsers(): array;
}

class UserService implements IUserService {
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function getAllUsers(): array {
        return $this->userRepository->getAllUsers();
    }
}
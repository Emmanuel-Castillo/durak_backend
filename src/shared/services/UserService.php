<?php declare(strict_types=1);

namespace DurakBackend\Shared\Services;

use DurakBackend\Shared\Repositories\IUserRepository;

interface IUserService {
    public function getAllUsers(): array;
    public function createUser(string $username, string $email, string $password): bool;
    public function deleteUser(string $email): bool;
}

class UserService implements IUserService {
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function getAllUsers(): array {
        return $this->userRepository->getAllUsers();
    }
    public function createUser(string $username, string $email, string $password): bool {
        try {
            $existingUserId = $this->userRepository->getUserByEmail($email);
            if ($existingUserId >= 0) {
                return false;
            }

            // Hash password here
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            return $this->userRepository->createUser($username, $email, $hashedPassword);
        } catch (\Exception $e) {
            return false;
        }
    }
    public function deleteUser(string $email): bool {
        try {
            $existingUserId = $this->userRepository->getUserByEmail($email);
            if ($existingUserId < 0) {
                return false;
            }

            return $this->userRepository->deleteUser($existingUserId);
        } catch (\Exception $e) {
            return false;
        }
    }

}
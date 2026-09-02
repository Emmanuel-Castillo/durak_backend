<?php declare(strict_types=1);

namespace DurakBackend\Shared\Repositories;

interface IUserRepository {
    public function getAllUsers(): array;
}

class UserRepository implements IUserRepository {
    public function getAllUsers(): array {
        return [
            ["id" => 1, "name" => "John Doe"],
            ["id" => 2, "name" => "John Doe2"]
        ];
    }
}
<?php declare(strict_types=1);

namespace DurakBackend\Shared\Repositories;

use mysqli;

interface IUserRepository {
    public function getAllUsers(): array;
}

class UserRepository implements IUserRepository {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }
    public function getAllUsers(): array {
        $stmt = $this->conn->prepare("SELECT * FROM user_account");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
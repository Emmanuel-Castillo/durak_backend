<?php declare(strict_types=1);

namespace DurakBackend\Shared\Repositories;

use mysqli;

interface IUserRepository {
    public function getAllUsers(): array;
    public function getUserByEmail(string $email): int;
    public function createUser(string $username, string $email, string $hashedPassword): bool;
    public function deleteUser(int $userId): bool;
}

class UserRepository implements IUserRepository {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }
    public function getAllUsers(): array {
        $stmt = $this->conn->prepare("SELECT * FROM user_account a INNER JOIN user_login l ON a.user_id = l.user_id ");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getUserByEmail(string $email): int {
        $stmt = $this->conn->prepare("SELECT user_id from user_login where email = (?)");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["user_id"];
        } else {
            return -1;
        }
    }
    public function createUser(string $username, string $email, string $hashedPassword): bool {
        $this->conn->begin_transaction();
        try {
            $stmt = $this->conn->prepare("INSERT INTO user_account (username) VALUES (?)");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $userId = $stmt->insert_id;
            $stmt = $this->conn->prepare("INSERT INTO user_login (user_id, email, password_hash) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $userId, $email, $hashedPassword);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (\Exception $e) {
            $this->conn->rollback();
            return false;
        }
    }
    public function deleteUser(int $userId): bool {
        $this->conn->begin_transaction();
        try {
            $stmt = $this->conn->prepare("DELETE FROM user_login WHERE user_id = (?)");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $stmt = $this->conn->prepare("DELETE FROM user_account WHERE user_id = (?)");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $this->conn->commit();
            return true;
        } catch (\Exception $e) {
            $this->conn->rollback();
            return false;
        }
    }
}
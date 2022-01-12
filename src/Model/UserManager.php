<?php

namespace App\Model;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function insert(array $user): int
    {
        if (!empty($user['password'])) {
            $password = $user['password'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
            $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
                " (`firstName`, `lastName`, `email`, `userName`, `password`) 
            VALUES (:firstName, :lastName, :email, :userName, :password)");
            $statement->bindValue('firstName', $user['firstname'], \PDO::PARAM_STR);
            $statement->bindValue('lastName', $user['lastname'], \PDO::PARAM_STR);
            $statement->bindValue('email', $user['email'], \PDO::PARAM_STR);
            $statement->bindValue('userName', $user['username'], \PDO::PARAM_STR);
            $statement->bindValue('password', $hashedPassword, \PDO::PARAM_STR);

            $statement->execute();
        }

        return (int)$this->pdo->lastInsertId();
    }

    public function selectUser(string $email): ?array
    {
        $statement = $this->pdo->prepare("SELECT id, userName , password , isAdmin from user WHERE email = :email");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->execute();
        $user = $statement->fetch();
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    public function checkEmail(string $email): bool
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE email=:email");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetch();
        if ($result != null) {
            return false;
        } else {
            return true;
        }
    }
}

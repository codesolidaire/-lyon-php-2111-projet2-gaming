<?php

namespace App\Model;

class GameManager extends AbstractManager
{
    /**
     * select game name from game table for category
     */
    public function selectGame(): array
    {
        $query = 'SELECT id, name FROM game';
        $statement = $this->pdo->query($query);
        $game = $statement->fetchAll();
        return $game;
    }

    /**
     * Select game by id from game table
     */
    public function selectGameById(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM game WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}

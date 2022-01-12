<?php

namespace App\Model;

class GameManager extends AbstractManager
{
    public const TABLE = 'game';

    public function selectGame(): array
    {
        $query = 'SELECT id, name FROM game';
        $statement = $this->pdo->query($query);
        $game = $statement->fetchAll();
        return $game;
    }

    public function selectGameById(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM game WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }

    public function insertScore(int $score): void
    {
        $statement = $this->pdo->prepare("INSERT INTO score 
        (score) VALUES
         (:score)");
        $statement->bindValue('score', $score, \PDO::PARAM_INT);
        $statement->execute();
    }
}

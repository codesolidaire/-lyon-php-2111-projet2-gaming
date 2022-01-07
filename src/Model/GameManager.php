<?php

namespace App\Model;

class GameManager extends AbstractManager
{
    public const TABLE = 'game';

    public function games(): array
    {
        $query = 'SELECT * FROM game';
        $statement = $this->pdo->query($query);
        $games = $statement->fetchAll();
        return $games;
    }
}

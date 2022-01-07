<?php

namespace App\Model;

class CommentManager extends AbstractManager
{
    /**
     * Insert comment in table
     */
    public function insertComment(array $comment): void
    {
        $statement = $this->pdo->prepare("INSERT INTO comments (comment, newsId) VALUES (:comment, :newsId)");
        $statement->bindValue('comment', $comment['comment'], \PDO::PARAM_STR);
        $statement->bindValue('newsId', $comment['newsId'], \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * Select comment by newId from comment table
     */
    public function fetchCommentById(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM comments WHERE newsId=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

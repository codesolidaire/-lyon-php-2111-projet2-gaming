<?php

namespace App\Model;

class CommentManager extends AbstractManager
{
    /**
     * Insert comment in table
     */
    public function insertComment(array $comment): void
    {

        $statement = $this->pdo->prepare("INSERT INTO comments (comment, newsId, userId) 
            VALUES (:comment, :newsId, :userId)");
        $statement->bindValue('comment', $comment['comment'], \PDO::PARAM_STR);
        $statement->bindValue('newsId', $comment['newsId'], \PDO::PARAM_INT);
        $statement->bindValue('userId', $comment['userId'], \PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * Select comment by newId from comment table
     */
    public function fetchCommentById(int $id): array
    {
        $statement = $this->pdo->prepare("SELECT c.comment, c.createdDate, u.userName FROM comments c
                INNER JOIN user u ON c.userId=u.id WHERE c.newsId = :id; ");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}

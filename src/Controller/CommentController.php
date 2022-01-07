<?php

namespace App\Controller;

use App\Model\CommentManager;

class CommentController extends AbstractController
{
    /**
    * Add a new comment for specific news
    */
    public function addComment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $comment = array_map('trim', $_POST);
            $commentManager = new CommentManager();
            $commentManager->insertComment($comment);
            header("Location: /news/show?id={$comment['newsId']}");
            die;
        }
    }
}

<?php

namespace App\Controller;

use App\Model\CommentManager;

class CommentController extends AbstractController
{
    private CommentManager $commentManager;
    public function __construct()
    {
        parent::__construct();
        $this->commentManager = new CommentManager();
    }

    public function addComment(): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $comment = array();
                $comment['comment'] = trim($_POST['comment']);
                $comment['newsId'] = trim($_POST['newsId']);
                $comment['userId'] = $_SESSION["userId"];
                $this->commentManager->insertComment($comment);
                header("Location: /news/show?id={$comment['newsId']}");
            }
    }
}

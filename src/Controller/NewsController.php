<?php

namespace App\Controller;

use App\Model\CommentManager;
use App\Model\GameManager;
use App\Model\NewsManager;

class NewsController extends AbstractController
{
    private GameManager $gameManager;
    private NewsManager $newsManager;
    private CommentManager $commentManager;

    public function __construct()
    {
        parent::__construct();
        $this->gameManager = new GameManager();
        $this->newsManager = new NewsManager();
        $this->commentManager = new CommentManager();
    }

    public function index(): string
    {
        $news = $this->newsManager->select();
        if (isset($_SESSION['admin'])){
            $isAdmin = $_SESSION['admin'];
        } else {
            $isAdmin = false;
        }
        return $this->twig->render('News/news.html.twig', ['news' => $news, 'isAdmin' => $isAdmin]);
    }

    public function add(): string
    {
        $game = $this->gameManager->selectGame();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            if (!empty($_POST['title']) && !empty($_POST['img_url_news']) && !empty($_POST['detail'])) {
                $news = array_map('trim', $_POST);
                $this->newsManager->insert($news);
                header('Location: /news');
            } else {
                $error = "All fields are required";
            }
        }

        return $this->twig->render('News/add.html.twig', ['game' => $game, 'error' => $error]);
    }


     // Edit a specific news
    public function edit(int $id): string
    {
        $news = $this->newsManager->selectOneById($id);
        $game = $this->gameManager->selectGame();
        $error = '';
        if ($news['gameId'] != "") {
            $gameName = $this->gameManager->selectGameById($news['gameId']);
        } else {
            $gameName = null;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['title']) && !empty($_POST['img_url_news']) && !empty($_POST['detail'])) {
                // clean $_POST data
                $news = array_map('trim', $_POST);
                $this->newsManager->update($news);
                header('Location: /news');
            } else {
                $error = "All fields are required";
            }
        }

        return $this->twig->render('News/edit.html.twig', ['news' => $news, 'game' => $game,
            'gameName' => $gameName, 'error' => $error]);
    }

    public function show(int $id): string
    {
        $news = $this->newsManager->selectOneById($id);
        $comments = $this->commentManager->fetchCommentById($id);
        if ($news['gameId'] != "") {
            $game = $this->gameManager->selectGameById($news['gameId']);
        } else {
            $game = null;
        }

        return $this->twig->render('News/show.html.twig', ['news' => $news, 'comments' => $comments, 'game' => $game]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $this->newsManager->deleteNews((int)$id);

            header('Location: /news');
        }
    }
}

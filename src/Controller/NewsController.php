<?php

namespace App\Controller;

use App\Model\CommentManager;
use App\Model\GameManager;
use App\Model\NewsManager;

class NewsController extends AbstractController
{
    public function index(): string
    {
        $newsManager = new NewsManager();
        $news = $newsManager->select();
        return $this->twig->render('News/news.html.twig', ['news' => $news, 'isadmin' => $_SESSION['admin']]);
    }

    public function add(): string
    {
        $newsManager = new NewsManager();
        $gameManager = new GameManager();
        $game = $gameManager->selectGame();
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            if (!empty($_POST['title']) && !empty($_POST['img_url_news']) && !empty($_POST['detail'])) {
                $news = array_map('trim', $_POST);
                $newsManager = new NewsManager();
                $newsManager->insert($news);
                header('Location: /news');
            } else {
                $error = "All fields are required";
            }
        }
        return $this->twig->render('News/add.html.twig', ['game' => $game, 'error' => $error]);
    }

    /**
     * Edit a specific news
     */
    public function edit(int $id): string
    {
        $newsManager = new NewsManager();
        $gameManager = new GameManager();
        $news = $newsManager->selectNewsById($id);
        $game = $gameManager->selectGame();
        $error ='';
        if ($news['gameId'] != "") {
            $gameName = $gameManager->selectGameById($news['gameId']);
        } else {
            $gameName = null;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['title']) && !empty($_POST['img_url_news']) && !empty($_POST['detail'])) {
                // clean $_POST data
                $news = array_map('trim', $_POST);
                /*$category = implode(',', $_POST['category']);
                $news['category'] = $category;
                $news['title'] = trim($_POST['title']);
                $news['detail'] = trim($_POST['detail']);
                $news['img_url_news'] = trim($_POST['img_url_news']);*/
                $newsManager->update($news);
                header('Location: /news');
            } else {
                $error = "All fields are required";
            }
        }
        return $this->twig->render('News/edit.html.twig', [
            'news' => $news, 'game' => $game, 'gameName' => $gameName, 'error' => $error]);
    }

    /**
     * Show informations for a specific news with comments
     */
    public function show(int $id): string
    {
        $newsManager = new NewsManager();
        $commentManager = new CommentManager();
        $gameManger = new GameManager();
        $news = $newsManager->selectNewsById($id);
        $comments = $commentManager->fetchCommentById($id);
        if ($news['gameId'] != "") {
            $game = $gameManger->selectGameById($news['gameId']);
        } else {
            $game = null;
        }
        //$categories =  explode(",",$news['category']);
        return $this->twig->render('News/show.html.twig', ['news' => $news,
            'comments' => $comments, 'game' => $game]);
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $newsManager = new NewsManager();
            $newsManager->deleteNews((int)$id);
            header('Location: /news');
        }
    }
}

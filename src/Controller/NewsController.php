<?php

namespace App\Controller;

use App\Model\NewsManager;

class NewsController extends AbstractController
{
    /**
     * List news
     */
    public function index(): string
    {
        $newsManager = new NewsManager();
        $news = $newsManager->select();
        return $this->twig->render('News/news.html.twig', ['news' => $news]);
    }

    /**
     * Add a new news
     */
    public function add(): string
    {
        $newsManager = new NewsManager();
        $game = $newsManager->selectGame();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $news = array_map('trim', $_POST);
            /*$news = array();
            $category = implode(',', $_POST['category']);
            $news['category'] = $category;
            $news['title'] = trim($_POST['title']);
            $news['detail'] = trim($_POST['detail']);
            $news['img_url_news'] = trim($_POST['img_url_news']);*/
            $newsManager = new NewsManager();
            $newsManager->insert($news);
            header('Location: /news');
            die;
        }
        return $this->twig->render('News/add.html.twig', ['game' => $game]);
    }

    /**
     * Edit a specific news
     */
    public function edit(int $id): string
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectNewsById($id);
        $game = $newsManager->selectGame();
        if ($news['gameId'] != "") {
            $gameName = $newsManager->selectById($news['gameId']);
        } else {
            $gameName = null;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $news = array_map('trim', $_POST);
            /*$category = implode(',', $_POST['category']);
            $news['category'] = $category;
            $news['title'] = trim($_POST['title']);
            $news['detail'] = trim($_POST['detail']);
            $news['img_url_news'] = trim($_POST['img_url_news']);*/
            $newsManager->update($news);
            header('Location: /news');
            die;
        }
        return $this->twig->render('News/edit.html.twig', [
            'news' => $news, 'game' => $game, 'gameName' => $gameName]);
    }

    /**
     * Show informations for a specific news with comments
     */
    public function show(int $id): string
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectNewsById($id);
        $comments = $newsManager->fetchCommentById($id);
        if ($news['gameId'] != "") {
            $game = $newsManager->selectById($news['gameId']);
        } else {
            $game = null;
        }
        //$categories =  explode(",",$news['category']);
        return $this->twig->render('News/show.html.twig', ['news' => $news,
            'comments' => $comments, 'game' => $game]);
    }
    /**
     * Delete a specific news
     *
     * public function delete()
     * {
     * if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     * $id = trim($_POST['id']);
     * $newsManager = new NewsManager();
     * $newsManager->delete((int)$id);
     * header('Location: /news');
     * die;
     * }
     * }*/

    /**
     * Display game page with related news
     */
    public function showGame(int $id): string
    {
        $newsManager = new NewsManager();
        $game = $newsManager->selectById($id);
        $news = $newsManager->fetchNewsByGameId($id);
        return $this->twig->render('News/showGame.html.twig', ['game' => $game, 'news' => $news]);
    }

    /**
     * Add a new comment for specific news
     */
    public function addComment(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $comment = array_map('trim', $_POST);
            $newsManager = new NewsManager();
            $newsManager->insertComment($comment);
            header("Location: /news/show?id={$comment['newsId']}");
            die;
        }
    }
}

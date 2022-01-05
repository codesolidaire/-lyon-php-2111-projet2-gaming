<?php

namespace App\Controller;

use App\Model\NewsManager;

class NewsController extends AbstractController
{
    /**
     * List items
     */
    public function index(): string
    {

        $newsManager = new NewsManager();
        $news = $newsManager->select();
        return $this->twig->render('News/news.html.twig', ['news' => $news]);
    }

    /**
     * Add a new item
     */
    public function add(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $news = array_map('trim', $_POST);
            /*$news = array();
            $category = implode(',', $_POST['category']);
            $news['category'] = $category;
            $news['title'] = trim($_POST['title']);
            $news['detail'] = trim($_POST['detail']);
            $news['img_url_news'] = trim($_POST['img_url_news']);*/
            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $newsManager = new NewsManager();
            $newsManager->insert($news);
            header('Location:/news');
        }

        return $this->twig->render('News/add.html.twig');
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): string
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $news = array_map('trim', $_POST);
            /*$category = implode(',', $_POST['category']);
            $news['category'] = $category;
            $news['title'] = trim($_POST['title']);
            $news['detail'] = trim($_POST['detail']);
            $news['img_url_news'] = trim($_POST['img_url_news']);*/
            // TODO validations (length, format...)
            // if validation is ok, update and redirection
            $newsManager->update($news);
            header('Location: /news');
        }

        return $this->twig->render('News/edit.html.twig', [
            'news' => $news,
        ]);
    }

    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectOneById($id);
        $comments = $newsManager->fetchCommentById($id);
        //$categories =  explode(",",$news['category']);
        return $this->twig->render('News/show.html.twig', ['news' => $news , 'comments' => $comments,]);
    }
    /**
     * Delete a specific item
     */
    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $newsManager = new NewsManager();
            $newsManager->delete((int)$id);
            header('Location: /news');
        }
    }

    public function addComment()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $comment = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $newsManager = new NewsManager();
            $newsManager->insertComment($comment);
            header("Location: /news/show?id={$comment['news_id']}");
        }
    }
    public function showGame(int $id)
    {
        $newsManager = new NewsManager();
        $game = $newsManager->selectById($id);
        $news = $newsManager->fetchNewsByGameId($id);
        return $this->twig->render('News/showGame.html.twig', ['game' => $game, 'news' => $news]);
    }

}
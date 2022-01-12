<?php

namespace App\Controller;

use App\Model\NewsManager;
use App\Model\GameManager;

class GameController extends AbstractController
{
    private GameManager $gameManager;
    private NewsManager $newsManager;

    public function __construct()
    {
        parent::__construct();
        $this->gameManager = new GameManager();
        $this->newsManager = new NewsManager();
    }

    public function game(): string
    {
        return $this->twig->render('Game/game.html.twig');
    }

    public function show(): string
    {
        $game = $this->gameManager->SelectAll();

        return $this->twig->render('Game/game.html.twig', ['game' => $game]);
    }

    public function submitMathGameScore(): void
    {
        $score = $_GET["score"];
        echo "Submit score called";
        $this->gameManager->insertScore($score);

        header('Location: /wildMathGame');
    }

    //Display game page with related news
    public function showGame(int $id): string
    {
        $game = $this->gameManager->selectGameById($id);
        $news = $this->newsManager->fetchNewsByGameId($id);

        return $this->twig->render('Game/showGame.html.twig', ['game' => $game, 'news' => $news]);
    }
}

<?php

namespace App\Controller;

use App\Model\NewsManager;
use App\Model\GameManager;

class GameController extends AbstractController
{

    public function game()
    {
        return $this->twig->render('Game/game.html.twig');
    }

    public function show(): string
    {
        $gameManager = new GameManager();
        $game = $gameManager->games();
        return $this->twig->render('Game/game.html.twig', ['game' => $game]);
    }
    /**
     * Display game page with related news
     */
    public function showGame(int $id): string
    {
        $newsManager = new NewsManager();
        $gameManger = new GameManager();
        $game = $gameManger->selectGameById($id);
        $news = $newsManager->fetchNewsByGameId($id);
        return $this->twig->render('Game/showGame.html.twig', ['game' => $game, 'news' => $news]);
    }
}

<?php

namespace App\Controller;

use App\Model\GameManager;
use App\Model\NewsManager;

class GameController extends AbstractController
{
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

<?php

namespace App\Controller;

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
}

<?php

namespace App\Controller;

class MemoryGameController extends AbstractController
{
    public function memoryGame(): string
    {
        return $this->twig->render('wildGames/wildMemoryGame.html.twig');
    }

    public function mathGame(): string
    {

        return $this->twig->render('wildGames/wildMathGame.html.twig');
    }
}

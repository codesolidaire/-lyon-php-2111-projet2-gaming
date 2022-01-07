<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

class MemoryGameController extends AbstractController
{
    public function memoryGame(): string
    {
        return $this->twig->render('wildGames/wildMemoryGame.html.twig');
    }
}

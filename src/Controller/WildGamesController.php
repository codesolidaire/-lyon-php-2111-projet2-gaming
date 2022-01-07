<?php

namespace App\Controller;

class WildGamesController extends AbstractController
{
    public function wildGames(): string
    {
        return $this->twig->render('wildGames/wildgames.html.twig');
    }
}

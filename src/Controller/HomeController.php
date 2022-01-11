<?php

namespace App\Controller;

use App\Model\NewsManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index()
    {
        $newsManager = new NewsManager();
        $news = $newsManager->selectLimited();
        return $this->twig->render('Home/index.html.twig', ['news' => $news]);
    }
}

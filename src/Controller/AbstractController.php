<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class AbstractController
{
    protected Environment $twig;
    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => (ENV === 'dev'),
            ]
        );
        $this->twig->addExtension(new DebugExtension());

        if (isset($_SESSION['uname'])) {
            $username = $_SESSION['uname'];
            $this->twig->addGlobal('userName', $username);
            $isAdmin = $_SESSION['admin'];
            $this->twig->addGlobal('isAdmin', $isAdmin);
        }
    }
}

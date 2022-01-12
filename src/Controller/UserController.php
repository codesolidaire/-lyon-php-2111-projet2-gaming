<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login(): string
    {
        $userManager = new UserManager();
        $errors = '';
        $admin = false;
        $id = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $user = $userManager->selectUser($_POST['email']);
                print_r($user);
                if ($user != null) {
                    $_SESSION['uname'] = $user['userName'];
                    $id = $user['id'];
                    $_SESSION['userId'] = $id;
                    $admin = $user['isAdmin'];
                    if (password_verify($_POST['password'], $user['password'])) {
                        header("Location: /");
                    } else {
                        $errors = 'Please enter valid password';
                    }
                } else {
                    $errors = 'Please enter valid Username';
                }

            } else {
                $errors = 'All Fields are required.';
            }
        }
        $_SESSION['admin'] = $admin;
        //$_SESSION["userId"] = $id;
        //echo $_SESSION['id'] ;
        return $this->twig->render('User/login.html.twig', ['errors' => $errors]);
    }

    public function register(): string
    {
        $userManager = new UserManager();
        $errors = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = array();
            if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $email = $userManager->selectUser($_POST['email']);
                if ($email === null) {
                    $user['email'] = trim($_POST['email']);
                    $user['username'] = trim($_POST['username']);
                    $user['password'] = trim($_POST['password']);
                    $user['firstname'] = null;
                    $user['lastname'] = null;
                    $userManager->insert($user);
                    header("Location: /user/login");
                } else {
                    $errors = "The email address is already present please select another";
                }
            } else {
                $errors = 'Email, Username and Password are required.';
            }
        }
        return $this->twig->render('User/register.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        session_destroy();
        header("Location: /user/login");
    }
}

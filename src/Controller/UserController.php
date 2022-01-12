<?php

namespace App\Controller;

use App\Model\UserManager;

class UserController extends AbstractController
{
    private UserManager $userManager;
    public function __construct()
    {
        parent::__construct();
        $this->userManager = new UserManager();
    }
    public function login(): string
    {
        $errors = '';
        $admin = false;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $user = $this->userManager->selectUser($_POST['email']);
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

        return $this->twig->render('User/login.html.twig', ['errors' => $errors ]);
    }

    public function register(): string
    {
        $errors = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = array();
            if (!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $email = $this->userManager->selectUser($_POST['email']);
                if ($email === null) {
                    $user['email'] = trim($_POST['email']);
                    $user['username'] = trim($_POST['username']);
                    $user['password'] = trim($_POST['password']);
                    $user['firstname'] = null;
                    $user['lastname'] = null;
                    $this->userManager->insert($user);
                    header("Location: /user/login");
                } else {
                    $errors = "The email address is already present please select another";
                }
            } else {
                $errors = 'Email, DisplayName and Password are required.';
            }
        }
        return $this->twig->render('User/register.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        session_destroy();
        header("Location: /user/login");
    }

    public function forgotPassword(): string
    {
        $errors = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = array();
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = $this->userManager->selectUser($_POST['email']);
                if ($email != null) {
                    $user['email'] = trim($_POST['email']);
                    $user['password'] = trim($_POST['password']);
                    $this->userManager->updatePassword($user);
                    header("Location: /user/login");
                } else {
                    $errors = "Please enter valid email";
                }
            } else {
                $errors = 'Email and Password are required.';
            }
        }
        return $this->twig->render('User/forgotPassword.html.twig', ['errors' => $errors]);
    }
}

<?php

namespace App\Controller;

class ContactController extends AbstractController
{
    public function sendMail(): string
    {
        if (isset($_POST['Send'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $mailheader = "From:" . $name . "<" . $email . ">\r\n";
            $recipient = "baki69190@gmail.com";

            mail($recipient, $subject, $message, $mailheader);
            header('Location: /');
        }
        return $this->twig->render('Contact/_contact.html.twig');
    }
}

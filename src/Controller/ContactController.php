<?php

namespace App\Controller;

class ContactController extends AbstractController
{
    public function testInput($data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
    public function sendMail(): string
    {
        $errors = '';
        $name = '';
        $email = '';
        $subject = '';
        $message = '';

        if (isset($_POST['Send'])) {
            $name = $this->testInput($_POST['name']);
            $email = $this->testInput($_POST['email']);
            $subject = $this->testInput($_POST['subject']);
            $message = $this->testInput($_POST['message']);

            if (empty($name) || empty($email) || empty($subject) || empty($message)) {
                $errors = 'All fields are required.';
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            } else {
                $errors = 'Invalid format of email';
            }

            $mailheader = "From:" . $name . "<" . $email . ">\r\n";
            $recipient = "baki69190@gmail.com";

            if ($errors) {
            } else {
                mail($recipient, $subject, $message, $mailheader);
                header('Location: /');
            }
        }
        return $this->twig->render('Contact/_contact.html.twig', [
            'errors' => $errors,
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
        ]);
    }
}

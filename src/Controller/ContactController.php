<?php

namespace src\Controller;

use Exception;

class ContactController
{
    /**
     * Récupères les données du formulaire de contact, et les envoie avec la fonction mail()
     * 
     * @param string $lastName
     * @param string $firstName
     * @param string $email
     * @param string $messageForm
     * 
     * @return bool true en cas de succés -> affiche la page de succés, false en cas d'erreur
     */
    public function getContactForm(string $lastName, string $firstName, string $email, string $messageForm) {
        $name = htmlspecialchars(strtoupper($lastName)) . " " . htmlspecialchars($firstName);
        $mail = htmlspecialchars($email);
        $message = htmlspecialchars($messageForm);

        $to = "bastlcrf.dev@gmail.com";
        $subject = "Prise de contact de : " . $name;
        $mailContent = "
            <html lang=\"fr\">
                <body>
                    <div style=\"text-align: center;\">
                        <p>Bonjour , je suis $name</p><br/>
                        <p>Mon adresse email est : $mail</p><br/>
                        <p>$message</p>
                    </div>
                </body>
            </html>
            ";

        $mailIsOk = mail($to, $subject, $mailContent);

        if($mailIsOk) {
            $messageSuccess = 'Votre message a bien été envoyer';
            require('public/templates/success.php');
            return true;
        } else {
            throw new Exception('Une erreur est survenue, veuillez réessayer plus tard');
        }
    }
}
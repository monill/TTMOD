<?php

namespace App\Libs;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Libs\Helper;

class Email extends PHPMailer {

    public function confirmEmail($email, $key)
    {
        // get instance of PHPMailer (including some additional info)
        $mail = $this->getMailer();
        // where you want to send confirmation email
        $mail->addAddress($email);
        // link for email confirmation
        //TODO fix link
        $link = URL . "/confirmacc.php?k=" . $key;
        // load email HTML template
        $body = file_get_contents(VIEWS . "emails/confirmacc.php");

        // replace appropriate placeholders
        $body = str_replace("{{website_name}}", "Track", $body);
        $body = str_replace("{{link}}", $link, $body);

        // set subject and body
        $mail->Subject = SNAME . " - Email confirmation.";
        $mail->Body = $body;

        // try to send the email
        if (!$mail->send()) {
            echo "Message can not be sent. <br />";
            echo "Mail error: " . $mail->ErrorInfo;
            exit();
        }
    }

    public function resetPass($email, $key)
    {
        // get instance of PHPMailer (including some additional info)
        $mail = $this->getMailer();
        // where you want to send confirmation email
        $mail->addAddress($email);
        // link for email confirmation
        //TODO fix link
        $link = URL . "/resetpass.php?k=" . $key;
        // load email HTML template
        $body = file_get_contents(VIEWS . "emails/resetpass.php");

        $body = str_replace("{{ip}}", Helper::getIP(), $body);
        $body = str_replace("{{website_name}}", SNAME, $body);
        $body = str_replace("{{link}}", $link, $body);

        $mail->Subject = SNAME . " - Password Reset.";
        $mail->Body = $body;

        if (!$mail->send()) {
            echo "Message can not be sent. <br />";
            echo "Mail error: " . $mail->ErrorInfo;
            exit();
        }
    }

    public function invite($email, $key)
    {
        // get instance of PHPMailer (including some additional info)
        $mail = $this->getMailer();
        // where you want to send confirmation email
        $mail->addAddress($email);
        // link for email confirmation
        //TODO fix link
        $link = URL . "/resetpass.php?k=" . $key;
        // load email HTML template
        $body = file_get_contents(VIEWS . "emails/invite.php");

        $body = str_replace("{{website_name}}", SNAME, $body);
        $body = str_replace("{{email}}", Helper::escape($email), $body);
        $body = str_replace("{{rulink}}", URL . '/rules', $body);
        $body = str_replace("{{falink}}", URL . '/faq', $body);
        $body = str_replace("{{invlink}}", $link, $body);

        $mail->Subject = SNAME . " - user invitation confirmation.";
        $mail->Body = $body;

        if (!$mail->send()) {
            echo "Message can not be sent. <br />";
            echo "Mail error: " . $mail->ErrorInfo;
            exit();
        }
    }

    private function getMailer()
    {
        $email = new PHPMailer();

        if (MAILER == "smtp") {
            $email->isSMTP();
            $email->Host = SMTP_HOST;
            $email->SMTPAuth = true;
            $email->Username = SMTP_USERNAME;
            $email->SMTPSecure = SMTP_ENCRYPTION;
            $email->Port = SMTP_PORT;
        }

        $email->CharSet = "UTF-8";
        // tell mailer that we are sending HTML email
        $email->isHTML(true);

        //TODO
        //fix website_domain
        $email->From = "123456@inbox.mailtrap.io";
        $email->FromName = SNAME;
        $email->addReplyTo("123456@inbox.mailtrap.io", SNAME);

        return $email;
    }

}

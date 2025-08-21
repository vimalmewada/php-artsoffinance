<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require_once __DIR__ . '/../public/PHPmailer/Exception.php';
require_once __DIR__ . '/../public/PHPmailer/PHPMailer.php';
require_once __DIR__ . '/../public/PHPmailer/SMTP.php';


class MailService {
    private $mailer;
    private $toEmail = "vimalmewada.vm@gmail.com"; 

    public function __construct() {
        $this->mailer = new PHPMailer(true);

        try {
            // SMTP settings
            $this->mailer->isSMTP();
            $this->mailer->Host       = 'smtp.gmail.com';
            $this->mailer->SMTPAuth   = true;
            $this->mailer->Username   = 'vimalmewada91@gmail.com';   // Gmail
            $this->mailer->Password   = 'thkgibqrkkfczpnb';         // 🔑 App Password
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mailer->Port       = 587;

            // Default "From"
            $this->mailer->setFrom('vimalmewada91@gmail.com', 'Website Builder');
        } catch (Exception $e) {
            error_log("Mailer setup error: " . $e->getMessage());
        }
    }

    public function sendMail($subject, $body) {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($this->toEmail);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->AltBody = strip_tags($body);

            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            error_log("Mailer Error: " . $this->mailer->ErrorInfo);
            return false;

        }
    }
}

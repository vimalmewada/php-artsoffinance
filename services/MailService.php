<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../public/vendor/autoload.php';


//Load Composer's autoloader

class MailService {
    private $mailer;
    private $toEmail = "contact.us@artsoffinance.in"; 

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
            $this->mailer->setFrom('vimalmewada91@gmail.com', 'New Enquiry!');
        } catch (Exception $e) {
            error_log("Mailer setup error: " . $e->getMessage());
        }
    }

    public function sendMail($mobileNumber, $body) {
        try {
            $this->mailer->clearAddresses();
            $this->mailer->addAddress($this->toEmail);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = "enquiry";
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

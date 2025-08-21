<?php
header('Content-Type: application/json');
require_once '../services/MailService.php';

$response = ["success" => false, "message" => "Something went wrong."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $subject = !empty($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : "New Contact Form Message";
    $message = htmlspecialchars(trim($_POST['message']));
    $mailService = new MailService();

    $body = "
        <h3>New Contact Form Message</h3>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    if ($mailService->sendMail($email, $name, $subject, $body)) {
        $response = [
            "success" => true,
            "message" => "Message sent successfully!"
        ];
    } else {
        $response = [
            "success" => false, 
            "message" => "Sorry, message could not be sent."
        ];
    }
}

echo json_encode($response);
exit;
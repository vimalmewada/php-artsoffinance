<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../../services/MailService.php';

$response = ["success" => false, "message" => "Something went wrong."];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $mobileNumber = !empty($_POST['mobileNumber']) ? htmlspecialchars(trim($_POST['mobileNumber'])) : "New Contact Form Message";
    $message = htmlspecialchars(trim($_POST['message']));
    $mailService = new MailService();
    
$body = '
    <div style="font-family: Arial, sans-serif; color: #333; max-width: 600px; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 6px;">
        <h2 style="color: #2c3e50; border-bottom: 1px solid #eee; padding-bottom: 10px;">📩 New Enquiry!!</h2>
        
        <p style="margin: 15px 0;">
            <strong>Name:</strong><br>
            <span style="color: #555;">' . $name . '</span>
        </p>
        
        <p style="margin: 15px 0;">
            <strong>Email:</strong><br>
            <span style="color: #555;">' . $email . '</span>
        </p>

        <p style="margin: 15px 0;">
            <strong>Mobile Number:</strong><br>
            <span style="color: #555;">' . $mobileNumber . '</span>
        </p>
        
        <p style="margin: 15px 0;">
            <strong>Message:</strong><br>
            <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #3498db; border-radius: 4px; color: #444;">
                ' . nl2br($message) . '
            </div>
        </p>
        
        <p style="font-size: 12px; color: #999; margin-top: 30px; text-align: center;">
            This message was sent from your website contact form.
        </p>
    </div>
';

    if ($mailService->sendMail($subject, $body)) {
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

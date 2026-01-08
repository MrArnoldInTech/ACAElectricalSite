<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* ----------------------------------------------------
        OPTIONAL: GOOGLE RECAPTCHA (disable if not needed)
    ---------------------------------------------------- */
    $recaptchaSecret = ""; // <-- Add your Secret Key (optional)
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? "";

    if (!empty($recaptchaSecret)) {
        $verify = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret=" .
            $recaptchaSecret . "&response=" . $recaptchaResponse
        );
        $responseData = json_decode($verify);

        if (!$responseData->success) {
            echo "reCAPTCHA verification failed. Please try again.";
            exit;
        }
    }

    /* ----------------------------------------------------
        GET FORM DATA
    ---------------------------------------------------- */
    $firstName  = $_POST['firstName'] ?? "";
    $lastName   = $_POST['lastName'] ?? "";
    $email      = $_POST['email'] ?? "";
    $service    = $_POST['service'] ?? "";
    $message    = $_POST['message'] ?? "";

    /* ----------------------------------------------------
        EMAIL SETTINGS
    ---------------------------------------------------- */
    $mailTo = "";  // <-- Your email goes here
    $subject = "New Contact Form Message - " . $service;
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";

    $txt = "
You have received a new inquiry from your website contact form.\n
------------------------------
Sender Information
------------------------------
First Name: $firstName
Last Name: $lastName
Email: $email
Service Type: $service

------------------------------
Message
------------------------------
$message

------------------------------
Sent from your website contact form
";

    /* ----------------------------------------------------
        SEND EMAIL
    ---------------------------------------------------- */
    // mail($mailTo, $subject, $txt, $headers);

    /* ----------------------------------------------------
        REDIRECT TO THANK YOU PAGE
    ---------------------------------------------------- */
    header("Location: ./contact_submit.html");
    exit;
}
?>

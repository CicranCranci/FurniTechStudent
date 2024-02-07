<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check the data
    if (empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($message)) {
        echo "Please fill in all fields correctly.";
        exit;
    }

    // Build the email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Write to a file
    file_put_contents('form-submissions.txt', $email_content, FILE_APPEND);
    
    // Thank you message
    echo "Thank you for contacting us, $name. We will get back to you soon.";

    // Redirect after 10 seconds
    header("refresh:5;url=contacts.html");
    exit;
} else {
    echo "Something went wrong.";
}

ini_set('display_errors', 1);
error_reporting(E_ALL);
?>


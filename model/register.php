

 <?php
// Start session to store API key
session_start();

include "../model/database.php";
include "../model/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["email"])) {
    $email = $_POST["email"];
    $apiKey = bin2hex(random_bytes(16)); // Generate random API key

    $stmt = $db->prepare("INSERT INTO users (email, api_key) VALUES (:email, :api_key)");
    $stmt->execute(['email' => $email, 'api_key' => $apiKey]);

    $_SESSION['api_key'] = $apiKey; // Store API key in session so it can be used across pages
    header("Location: ../view/registration_success.php"); // Redirect to registration success page
    exit;
} else {
    // Redirect back to index page if the form is not submitted properly
    header("Location: ../index.php");
    exit;
}


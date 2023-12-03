
<?php
// Start a session so the API key can be stored while the user visits different pages
session_start();

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["email"])) {

    if(empty($_POST['email']))
    {
        echo json_encode(["error" => "Email is required"]);
    }
    else 
    {
        $email = $_POST["email"];
        $apiKey = bin2hex(random_bytes(16)); // Generates a random api key
    }

    $_SESSION['api_key'] = $apiKey;

    try {
        // Use prepared statements for security purposes to insert user's api key and email into the database
        $stmt = $db->prepare("INSERT INTO users (email, api_key) VALUES (:email, :api_key)");
        $stmt->execute(['email' => $email, 'api_key' => $apiKey]);

        // Check if the insert was successful
        if ($stmt->rowCount() > 0) {
            echo json_encode(["api_key" => $apiKey]); // Return api key in json format
        } else {
            echo json_encode(["error" => "Failed to save API key"]);
        }

    } catch(PDOException $e) {
        // Log the error and return a generic error message
        error_log("Database error: " . $e->getMessage());
        echo json_encode(["error" => "An error occurred during registration"]);
    }
} 
else {
    echo json_encode(["error" => "Invalid request method"]);
}

$_SESSION['api_key'] = $apiKey;
header("Location: ../view/registration_success.php");
exit;

?>

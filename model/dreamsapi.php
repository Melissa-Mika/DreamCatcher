

<?php

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include "database.php";


ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if the request method is GET and the API key is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["api_key"])) {
    $apiKey = $_GET["api_key"];

    // Validate the API key by checking it against the database
    $stmt = $db->prepare("SELECT * FROM users WHERE api_key = :api_key");
    $stmt->execute(['api_key' => $apiKey]);
    $user = $stmt->fetch();

    // If no user found with the provided API key, return an error
    if (!$user) {
        echo json_encode(["error" => "Invalid API key"]);
        exit;
    }

// Check if a symbol is provided in the GET request
if (!empty($_GET['symbol'])) {
    // Add condition to the query to filter by symbol
    $sql = "SELECT symbol, interpretation FROM dream_symbols WHERE symbol = :symbol";
    $stmt = $db->prepare($sql);

    // Bind the symbol parameter directly
    $stmt->bindValue(':symbol', $_GET['symbol']);
} else {
    // Prepare query to fetch all symbols if no specific symbol is provided
    $sql = "SELECT symbol, interpretation FROM dream_symbols";
    $stmt = $db->prepare($sql);
}

// Execute the query
$stmt->execute();

// Fetch results as an associative array
$dreams = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return the dream interpretations in JSON format
echo json_encode($dreams);

}
?>

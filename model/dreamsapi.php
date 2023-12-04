
<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include "database.php";

// Validate API key 
if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["api_key"])) {
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

    // Prepare SQL query to select symbol and interpretation
    $sql = "SELECT symbol, interpretation FROM dream_symbols";

    // Check if a symbol is provided in the GET request
    if (!empty($_GET['symbol'])) {
        // Add condition to the query to filter by symbol
        $sql .= " WHERE symbol = :symbol";
        $stmt = $db->prepare($sql);
        // Bind the symbol parameter
        $stmt->bindValue(':symbol', filter_input(INPUT_GET, 'symbol', FILTER_SANITIZE_SPECIAL_CHARS));
    } else {
        // Prepare query to fetch all symbols if no specific symbol is provided
        $stmt = $db->prepare($sql);
    }

    // Execute the query
    $stmt->execute();

    // Fetch results as an associative array
    $dreams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the dream interpretations in JSON format
    echo json_encode($dreams);
} else {
    // Handle cases where API key is missing or request method is not GET
    echo json_encode(["error" => "Invalid request"]);
}
?>

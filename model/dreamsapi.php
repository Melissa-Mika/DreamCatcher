
<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include "database.php";

// Validate API key 
if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["api_key"])) {
    $apiKey = $_GET["api_key"];

    // fetch all of the information from the specific row in the user table which is determined by the api key
    $stmt = $db->prepare("SELECT * FROM users WHERE api_key = :api_key");
    $stmt->execute(['api_key' => $apiKey]);
    $user = $stmt->fetch();

    // If no user found with the provided api key
    if (!$user) {
        // Handle invalid API key
        echo json_encode(["error" => "Invalid API key"]);
        exit;
    }

    // Select the symbol and the symbol's interpretation information from the dream_symbols table
    $sql = "SELECT symbol, interpretation FROM dream_symbols";

    // If there is a symbolID
    if (isset($_GET['symbolID'])) {
        // add on to sequel statement and filter by symbolID if it is set
        $sql .= " WHERE symbolID = :symbolID";
        // Prepare the statement
        $stmt = $db->prepare($sql);
        // Bind the 'symbolID' parameter to the value from $_GET ensuring it's a string
        $stmt->bindValue(':symbolID', filter_input(INPUT_GET, 'symbolID', FILTER_SANITIZE_SPECIAL_CHARS));
    } else {
        // Fetch all symbols if no specific symbolID is requested
        $stmt = $db->prepare($sql);
    }

    // Execute the query
    $stmt->execute();

    // gets results as an associative array which makes it easier to convert to JSON
    $dreams = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the dream interpretations in JSON format
    echo json_encode($dreams);
} else {
    // Handle cases where API key is missing or request method is not GET
    echo json_encode(["error" => "Invalid request"]);
}




?>



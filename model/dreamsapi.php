
<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include "database.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["api_key"])) {
    $apiKey = $_GET["api_key"];

    // Validates the API key
    $stmt = $db->prepare("SELECT * FROM users WHERE api_key = :api_key");
    $stmt->execute(['api_key' => $apiKey]);
    if (!$stmt->fetch()) {
        echo json_encode(["error" => "Invalid API key"]);
        exit;
    }

    // If a symbol is found, it fetches its interpretation
    if (isset($_GET['symbol'])) {
        $symbol = $_GET['symbol'];
        $stmt = $db->prepare("SELECT interpretation FROM dream_symbols WHERE symbol = :symbol");
        $stmt->execute(['symbol' => $symbol]);
        $result = $stmt->fetch();

        if ($result) {
            echo json_encode(["interpretation" => $result['interpretation']]);
        } else {
            echo json_encode(["error" => "Symbol not found"]);
        }
    } else {
        // If no symbol is found, all symbols and their interpretations are displayed
        $stmt = $db->query("SELECT symbol, interpretation FROM dream_symbols");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
}

?>



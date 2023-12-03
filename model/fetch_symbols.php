
<?php
include "database.php";

// fetch the symbols from the database and return them as a JSON array; This script is called by the JavaScript function fetchSymbols()
$stmt = $db->prepare("SELECT symbolID, symbol, interpretation FROM dream_symbols");
$stmt->execute();
$symbols = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($symbols);
?>

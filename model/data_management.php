
<?php
// Use PHP to handle form submissions and update the database

// Handlling of form that the user can add, edit, or delete a dream symbol
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    $symbol = $_POST["symbol"];
    $interpretation = $_POST["interpretation"] ?? '';

    if ($action == "add_symbol") {
        // SQL to add a new symbol
        $stmt = $db->prepare("INSERT INTO dream_symbols (symbol, interpretation) VALUES (:symbol, :interpretation)");
        $stmt->execute(['symbol' => $symbol, 'interpretation' => $interpretation]);
    } elseif ($action == "edit_symbol") {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'edit_symbol') {
            $symbolID = $_POST['symbolID'];
            $newSymbol = $_POST['new_symbol'];
            $newInterpretation = $_POST['new_interpretation'];

        // SQL to update the symbol
        $stmt = $db->prepare("UPDATE dream_symbols SET symbol = :new_symbol, interpretation = :new_interpretation WHERE symbolID = :symbolID");
        $stmt->execute(['new_symbol' => $newSymbol, 'new_interpretation' => $newInterpretation, 'symbolID' => $symbolID]);

       // Redirect or message after successful update
       echo "Symbol updated successfully";
        }
        
    } elseif ($action == "delete_symbol") {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] == 'delete_symbol') {
            $symbolID = $_POST['symbolID'];
        
            // SQL to delete the symbol
            $stmt = $db->prepare("DELETE FROM dream_symbols WHERE symbolID = :symbolID");
            $stmt->execute(['symbolID' => $symbolID]);
        
            // Redirect or message after successful deletion
            echo "Symbol deleted successfully";
    }

    /// message after the action is completed
    echo "Action completed: $action";
} else {
    echo "Invalid request";
}
}

?>

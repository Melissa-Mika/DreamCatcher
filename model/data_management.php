
<?php
session_start();

include "../model/database.php";

// Handling of form that the user can add, edit, or delete a dream symbol
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST["action"];
    

    if ($action == "add_symbol") {
        $symbol = $_POST["symbol"];
        $interpretation = $_POST["interpretation"] ?? '';

        // SQL to add a new symbol
        $stmt = $db->prepare("INSERT INTO dream_symbols (symbol, interpretation) VALUES (:symbol, :interpretation)");
        if ($stmt->execute(['symbol' => $symbol, 'interpretation' => $interpretation])) {
            // Use the session to send the message that the symbol was successfully added
            $_SESSION['success_message'] = "Symbol added successfully";
            header("Location: ../view/forms.php");
        } else {
            echo "Error adding symbol: " . $stmt->errorInfo()[2]; // Error details from PDOStatement
        }
        

    } elseif ($action == "edit_symbol") {
        $symbolID = $_POST['symbolID'];
        $newSymbol = $_POST['new_symbol'];
        $newInterpretation = $_POST['new_interpretation'];

        // SQL to update the symbol in the database
        $stmt = $db->prepare("UPDATE dream_symbols SET symbol = :new_symbol, interpretation = :new_interpretation WHERE symbolID = :symbolID");
        if ($stmt->execute(['new_symbol' => $newSymbol, 'new_interpretation' => $newInterpretation, 'symbolID' => $symbolID])) {
            // Use the session to send the message that the symbol was successfully edited
            $_SESSION['success_message'] = "Symbol edited successfully";
            header("Location: ../view/forms.php");
        } else {
            echo "Error editing symbol: " . $stmt->errorInfo()[2]; // Error details from PDOStatement
        }

    } elseif ($action == "delete_symbol") {
        // SQL to delete the symbol
        $symbolID = $_POST['symbolID'];
        
        //SQL to delete the symbol from the database
        $stmt = $db->prepare("DELETE FROM dream_symbols WHERE symbolID = :symbolID");
        if ($stmt->execute(['symbolID' => $symbolID]))
        {
            // Use the session to send the message that the symbol was successfully deleted
            $_SESSION['success_message'] = "Symbol successfully deleted";
            header("Location: ../view/forms.php");
        }
        } else {
        echo "Error editing symbol: " . $stmt->errorInfo()[2]; // Error details from PDOStatement)
    }

} else {
    echo "Invalid request method";
}
?>

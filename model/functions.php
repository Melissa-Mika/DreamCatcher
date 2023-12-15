

<?php

include "database.php";

//gets dream symbols from the database and populates the dropdown menus
function generateSymbolDropdown() {
    global $db; // Ensure that $db is accessible within the function

    // sequel statement to retrieve the symbolIDs and the symbol names from the database
    $sql = "SELECT symbolID, symbol FROM dream_symbols ORDER BY symbol ASC";
    $qry = $db->query($sql);
    $symbols = $qry->fetchAll(PDO::FETCH_ASSOC);

    $dropdownHTML = '<select id="symbolID" name="symbolID" required>';
    $dropdownHTML .= '<option value="" disabled selected>Select a Symbol</option>';
    
    // iterate through array and assign symbols to the option tags
    foreach ($symbols as $symbol) {
        $dropdownHTML .= '<option value="' . htmlspecialchars($symbol['symbolID']) . '">' . htmlspecialchars($symbol['symbol']) . '</option>';
    }
    
    // close the select tag
    $dropdownHTML .= '</select>';

    return $dropdownHTML;
}

// Function to retrieve all dream symbols and their interpretations from the database
function getAllDreamSymbols() {
    global $db;  
    // SQL statement to retrieve the symbols and interpretations, ordered alphabetically by symbol
    $sql = "SELECT symbol, interpretation FROM dream_symbols ORDER BY symbol ASC";
    try {
        // Execution of the query
        $stmt = $db->query($sql);
        // Return the symbols and interpretations
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Handle error
        echo "Database error: " . $e->getMessage();
        // Return an empty array
        return [];
    }
}


function addSymbolToDatabase($symbol, $interpretation) {
    global $db;
    $sql = "INSERT INTO dream_symbols (symbol, interpretation) VALUES (:symbol, :interpretation)";
    try {
        // Prepare the SQL statement for execution.
        $stmt = $db->prepare($sql);

         // Execute the statement with the provided $symbol and $interpretation values.
        // The array maps the placeholders in the SQL statement to the actual values.
        $stmt->execute(['symbol' => $symbol, 'interpretation' => $interpretation]);

        // If execution is successful, return a success message.
        return "Symbol added successfully";
    } catch (PDOException $e) {
        // If an exception occurs during the execution of the try block, catch it and return an error message with the exception details.
        return "Error adding symbol: " . $e->getMessage();
    }
}



function updateSymbolInDatabasae()
{
    global $db;
    // SQL statement to update the dream symbol info in the database

}


function deleteSymbolFromDatabase()
{
    global $db;
}



?>
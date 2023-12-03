
<?php include "nav.php";?>
<?php include "../model/header.php"?>
<?php include "../model/functions.php"?>

<?php include "../model/database.php";
      include "../model/header.php";
      include "nav.php";?>

<h1>Dream Catcher</h1>

<h2>Dream Symbols</h2>


<?php
// Checks to see if a symbol was passed in the url via the GET request
$selectedSymbol = $_GET['symbol'] ?? null;
$selectedInterpretation = '';

// If a symbol was selected
if ($selectedSymbol) {
    // Loop through the array of symbols
    foreach ($symbols as $symbol) {
        // Check if the current symbol in the loop matches the selected symbol
        if ($symbol['symbol'] === $selectedSymbol) {
            // If it matches, store the interpretation of the selected symbol
            $selectedInterpretation = $symbol['interpretation'];
            // Break out of the loop because the symbol was found
            break;
        }
    }
}
?>

<h1>Dream Symbol Interpretation</h1>

<?php if ($selectedSymbol): ?>
    <!-- If a symbol was selected, display its name and interpretation -->
    <h2>Symbol: <?php echo htmlspecialchars($selectedSymbol); ?></h2>
    <p>Interpretation: <?php echo htmlspecialchars($selectedInterpretation); ?></p>
<?php else: ?>
    <!-- If no symbol was selected, display a prompt to select a symbol -->
    <p>Please select a symbol to see its interpretation.</p>
<?php endif; ?>







<?php include "nav.php"; ?>
<?php include "../model/header.php" ?>
<?php include "../model/functions.php" ?>
<?php include "../model/database.php"; ?>

<h1>The Dream Catcher</h1>
<h3>A Dream Interpreter</h3>

        <div class="container show_dream_info">
            <?php

            // Get the selected symbol ID from the GET request
            $symbolID = $_GET['symbolID'] ?? null;
            $symbol = '';
            $interpretation = '';

            if ($symbolID) {
                // If a symbolID is found prepare and execute the query to fetch symbol and interpretation from the database
                $stmt = $db->prepare("SELECT symbol, interpretation FROM dream_symbols WHERE symbolID = :symbolID");
                $stmt->execute(['symbolID' => $symbolID]);

                // Fetch the result
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                // If result found, assign symbol and dream interpretation to their variables
                if ($result) {
                    $symbol = $result['symbol'];
                    $interpretation = $result['interpretation'];
                }
            }
            ?>

            <?php if ($symbolID && $symbol) : ?>
                <h2>Symbol: <?php echo htmlspecialchars($symbol); ?></h2>
                <h4>Interpretation: <?php echo htmlspecialchars($interpretation); ?></h4>
            <?php else : ?>
                <p>Please select a symbol to see its interpretation.</p>
            <?php endif; ?>

        </div>

       

    
    <?php include "../model/footer.php";?>


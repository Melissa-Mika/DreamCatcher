
<?php include "nav.php";?>
<?php include "../model/header.php"?>
<?php include "../model/functions.php"?>

<h1>Dream Catcher</h1>

<h2>Dream Symbols</h2>

<?php include "./model/database.php";?>

<?php $symbols = getAllDreamSymbols(); ?>

<table id="dreamSymbolsTable">
    <tr>
        <th>Symbol</th>
        <th>Interpretation</th>
    </tr>
    <?php foreach ($symbols as $symbol): ?>
        <tr>
            <td><?php echo htmlspecialchars($symbol['symbol']); ?></td>
            <td><?php echo htmlspecialchars($symbol['interpretation']); ?></td>
        </tr>
    <?php endforeach; ?>
</table>







<?php
include "nav.php";
include "../model/header.php";
include "../model/functions.php";
include "../model/database.php";
?>

<h1>The Dream Catcher</h1>
<h3>A Dream Interpreter</h3>

<?php $symbols = getAllDreamSymbols(); ?>

<div class="container">
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
</div>

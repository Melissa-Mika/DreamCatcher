



<?php
include "nav.php";
include "../model/header.php";
include "../model/functions.php";
include "../model/database.php";
?>

<?php $symbols = getAllDreamSymbols(); ?>

<body class="all-symbols" style="background-color: lightblue; background-image:none;">
<h1>The Dream Catcher</h1>
<h3>A Dream Interpreter</h3>


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
<?php include "../model/footer.php";?>

</body>

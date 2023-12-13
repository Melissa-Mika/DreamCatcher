
<?php session_start(); ?>

<?php include "nav.php" ?>
<?php include "../model/database.php"; ?>
<?php include "../model/functions.php";?>
<?php include "../model/header.php" ?>


<h1>The Dream Catcher</h1>
<h3>A Dream Interpreter</h3>

<div class="container search_symbols_form">

<!-- Form to search for symbol in order to get a dream interpretation -->
<form class="search_symbols" action="show_dream_info.php" method="GET">
    <label for="symbolID">Please choose a dream symbol:</label>
    <?php echo generateSymbolDropdown(); ?>
    <input type="submit" id="submit" value="Search">
</form>

<!-- Link to display all of the dream symbols and their interpretations -->
<div>
<a href="view_all_symbols.php">
<button type="button" class="btn btn-outline-light">View All Dream Symbols</button>
</a>
</div>



<?php include "../model/footer.php";?>

    

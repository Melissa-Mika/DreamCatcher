
<?php session_start(); ?>

<?php include "nav.php" ?>
<?php include "../model/database.php"; ?>
<?php include "../model/functions.php";?>
<?php include "../model/header.php" ?>

<script>
    // Retrieve the API key from the PHP session.
    // The 'json_encode' function is used to safely output the PHP string as a JavaScript string.
    // The '??' is the null coalescing operator, which provides an empty string if '$_SESSION['api_key']' is not set.
    const apiKey = <?php echo json_encode($_SESSION['api_key'] ?? ''); ?>;
    // Call the 'fetchDreamSymbols' function with the API key.
    // This function will make a request to the server using the API key to fetch dream symbols.
    fetchDreamSymbols(apiKey);
</script>

<h1>The Dream Catcher</h1>
<h3>Search for a Dream Symbol</h3>

<!-- Form to search for symbol in order to get a dream interpretation -->
<form class="search_symbol">
    Please enter a symbol: <label for="symbol_choice"></label>
    <input type="text" id="symbol_choice" name="symbol_choice">
    <input type="submit" id="submit" value="Search">
</form>


<!-- Form to add dream symbol, edit dream symbol, or delete dream symbol -->
<h3>Add, Edit, or Delete a Dream Symbol</h3>

<form action="data_management.php" class="symbol-form" method="post">
    <label for="action">Choose an action:</label>
    <select name="action" id="action" required onchange="updateFormFields()">
        <option value="" disabled selected>Please choose an action</option>
        <option value="add_symbol">Add a Symbol</option>
        <option value="edit_symbol">Edit a Symbol</option>
        <option value="delete_symbol">Delete a Symbol</option>
    </select>
</form>

<div id="form-fields">
    <!-- The appropriate form will be displayed based on the selected action -->
</div>

<!-- JavaScript to populate the appropriate form based on the selected action -->
<script>
    function updateFormFields() {
        var action = document.getElementById('action').value;
        var formFields = document.getElementById('form-fields');

        if (action === 'add_symbol') {
            formFields.innerHTML = `
                    <input type="text" name="symbolID" placeholder="Symbol ID">
                    <label for="symbol">Symbol:</label>
                    <input type="text" id="symbol" name="symbol" required><br>

                    <label for="interpretation">Interpretation:</label>
                    <textarea id="interpretation" name="interpretation" required></textarea><br>
                `;
        } else if (action === 'edit_symbol')
        {
            formFields.innerHTML = `
            <label for="symbol_id">Choose a Symbol to Edit:</label>
            <?php echo generateSymbolDropdown(); ?> 
            <label for="new_symbol">New Symbol:</label>
            <input type="text" id="new_symbol" name="new_symbol" required><br>

            <label for="new_interpretation">New Interpretation:</label>
            <textarea id="new_interpretation" name="new_interpretation" required></textarea><br>;

            <input type="submit" value="Edit Symbol">`
        } 
        else if (action === 'delete_symbol') {
            formFields.innerHTML = `
        <label for="symbol_id">Choose a Symbol to Delete:</label>
        <?php echo generateSymbolDropdown(); ?> 

        <input type="submit" value="Delete Symbol">`;
        } 
        else {
            formFields.innerHTML = '';
        }
    };
</script>

<!-- Hidden template for dropdown, used in JavaScript -->
<div id="symbol-dropdown-template" style="display:none;">
    <label for="symbol_id">Choose a Symbol:</label>
    <?php echo generateSymbolDropdown(); ?> 
</div>

<div><a href="show_dream_info.php">Show all Dream Symbols</a></div<a href="#" onclick="fetchDreamSymbols(apiKey); return false;">View Dream Symbols</a>

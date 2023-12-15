<?php session_start(); ?>

<?php include "nav.php" ?>
<?php include "../model/database.php"; ?>
<?php include "../model/functions.php"; ?>
<?php include "../model/header.php" ?>

<?php
// Check for success message
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Clear the message after displaying
} else {
    $successMessage = '';
}
?>

<?php if ($successMessage) : ?>
    <div class="alert alert-success">
        <?php echo $successMessage; ?>
    </div>
<?php endif; ?>

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
<h3>A Dream Interpreter</h3>

<div class="container">

    <!-- Form to add dream symbol, edit dream symbol, or delete a dream symbol -->
    <h3 class="change-symbol"> Add, Edit, or Delete a Dream Symbol</h3>

    <div class="change-form">
        <label for="action" class="action-label">Choose an action:</label>
        <select name="action" id="action" required onchange="updateFormFields()"> <!-- Calls the updateFormFields function which retrieves the selected form -->
            <option value="" disabled selected>Please choose an action</option>
            <option value="add_symbol">Add a Symbol</option>
            <option value="edit_symbol">Edit a Symbol</option>
            <option value="delete_symbol">Delete a Symbol</option>
        </select>
    </div>


    <div id="form-fields">
        <!-- The appropriate form will be displayed based on the selected action. JavaScript will make the form dynamically appear in this div -->
    </div>

    <!-- JavaScript to populate the appropriate form based on the selected action -->
    <script>
        function updateFormFields() {
            var action = document.getElementById('action').value;
            var formFields = document.getElementById('form-fields');

            // The add_symbol form
            if (action === 'add_symbol') {
                formFields.innerHTML = `
                    <div class="add-form">
                    <form action="../model/data_management.php" method="POST">
                    <label for="symbol" class="add-label">New Symbol:</label>
                    <input type="text" id="symbol" name="symbol" required><br>

                    <label for="interpretation" class="interpretation-label">Interpretation:</label>
                    <textarea id="interpretation" name="interpretation" required></textarea><br>
                    <input type="submit" value="Add Symbol" class="btn btn-outline-light">
                    <input type="hidden" name="action" value="add_symbol" class="btn btn-outline-light">
                    </form>
                    </div>
                `;

            } else if (action === 'edit_symbol') { // The edit_symbol form
                formFields.innerHTML = `
            <div class="edit-form">       
            <form action="../model/data_management.php" method="POST">       
            <label for="symbolID" class="edit-label">Please choose a symbol to edit</label>
            <?php echo generateSymbolDropdown(); ?> <br>

            <label for="new_symbol" class="new-symbol-label">New Symbol:</label>
            <input type="text" id="new_symbol" name="new_symbol" required><br>

            <label for="new_interpretation" class="interpretation-label">New Interpretation:</label>
            <textarea id="new_interpretation" name="new_interpretation" required></textarea><br>;

            <input type="submit" value="Edit Symbol" class="btn btn-outline-light">
            <input type="hidden" name="action" value="edit_symbol">
            </form>
            </div>
            `;
            } else if (action === 'delete_symbol') {
                // The delete_symbol form
                formFields.innerHTML = `
        <div class="delete-form">
        <form action="../model/data_management.php" method="post">
        <label for="symbol_id" class="delete-label">Choose a Symbol to Delete:</label>
        <?php echo generateSymbolDropdown(); ?> 
        <input type="submit" value="Delete Symbol" class="btn btn-outline-light">
        <input type="hidden" name="action" value="delete_symbol">
        </form>
        </div>
        `;
            } else {
                formFields.innerHTML = '';
            }
        }
    </script>

    <!-- Hidden template for dropdown, used in JavaScript -->
    <div id="symbol-dropdown-template" style="display:none;">
        <label for="symbol_id">Choose a Symbol:</label>
        <?php echo generateSymbolDropdown(); ?>
    </div>


    <?php include "../model/footer.php"; ?>
</div>
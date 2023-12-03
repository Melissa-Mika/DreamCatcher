
<?php
session_start();

include "../model/functions.php";
include "./nav.php";
include "../model/header.php";

// User is redirected back to index page if there is no API key stored in the session
if (empty($_SESSION['api_key'])) {
    header("Location: index.php");
    exit;
}

$symbols = getAllDreamSymbols();

?>

<h1>Welcome to The Dream Catcher</h1>
<h2>A Dream Interpreter</h2>

<div class="container">
<h3>Registration Successful</h3>
<h4>Your API key is: <?php echo htmlspecialchars($_SESSION['api_key']); ?></h4>

<h3>Select a Dream Symbol</h3>
    <select id="dreamSymbol" onchange="getInterpretation()">
        <?php foreach ($symbols as $symbol): ?>
            <option value="<?php echo htmlspecialchars($symbol['symbol']); ?>">
                <?php echo htmlspecialchars($symbol['symbol']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <div id="interpretation">
    </div>

    <script>
    function getInterpretation() {
        // After the onchange event, function retrieves the selected symbol
        var symbol = document.getElementById('dreamSymbol').value;
        // Retrieves the API key stored in the PHP session; This API key is necessary for authenticating the request to the API
        var apiKey = <?php echo json_encode($_SESSION['api_key']); ?>;
        
        // Construct the API URL with the selected symbol and API key; The symbol and API key are added as query parameters. The encodeURIComponent function is used to encode the symbol and API key correctly for use in a URL
        var apiUrl = '../model/dreamsapi.php?symbol=' + encodeURIComponent(symbol) + '&api_key=' + encodeURIComponent(apiKey);

        // Makes an AJAX request to the API using the Fetch API
        fetch(apiUrl)
            .then(response => {
                // Checks if the response is ok
                if (!response.ok) {
                    // If not, throw an error that will be caught in the catch block
                    throw new Error('Network response was not ok');
                }
                // Convert the response to JSON
                return response.json();
            })
            .then(data => {
                // If API response returns a JSON object with an 'interpretation' field, set the content of the 'interpretation' div to this value; If 'interpretation is not provided, display error message
                document.getElementById('interpretation').textContent = data.interpretation || 'No interpretation found';
            })
            .catch(error => {
                // If there is an error during fetch or response processing, log it to the console and show an error message in the 'interpretation' div
                console.error('Error fetching interpretation:', error);
                document.getElementById('interpretation').textContent = 'Error fetching interpretation';
            });
    }
</script>

    


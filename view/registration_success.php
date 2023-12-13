

<?php
session_start();

include "../model/functions.php";
include "./nav.php";
include "../model/header.php";

// Redirect to index page if API key is not set
if (empty($_SESSION['api_key'])) {
    header("Location: ../index.php");
    exit;
}

$symbols = getAllDreamSymbols();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Dream Catcher</title>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
</head>

<body>


    <h1>The Dream Catcher</h1>
    <h3>A Dream Interpreter</h3>

        <div class="content">
    <div class="container">
        <h3>Registration Successful</h3>
        <p>Your API key is: <strong><?php echo htmlspecialchars($_SESSION['api_key']); ?></strong></p>

        <h4>Select a dream symbol to get a dream interpretation:</h4>
        <select id="dreamSymbol" >
            <option value="" disabled selected>Please choose a dream symbol</option>
            <?php foreach ($symbols as $symbol): ?>
                <option value="<?php echo htmlspecialchars($symbol['symbol']); ?>">
                    <?php echo htmlspecialchars($symbol['symbol']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <div id="interpretation"></div>
    </div>

<script>

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('dreamSymbol').addEventListener('change', getInterpretation);
});

    function getInterpretation() {
        console.log("getInterpretation called");
    var symbol = document.getElementById('dreamSymbol').value;
    var apiKey = "<?php echo $_SESSION['api_key']; ?>";
    var apiUrl = '../model/dreamsapi.php?symbol=' + encodeURIComponent(symbol) + '&api_key=' + encodeURIComponent(apiKey);

    console.log('API URL:', apiUrl);

    axios.get(apiUrl)
        .then(response => {
            console.log('API Response:', response.data);

            // Check if the data array is not empty and the first item has an interpretation
            if (response.data.length > 0 && 'interpretation' in response.data[0]) {
                document.getElementById('interpretation').textContent = response.data[0].interpretation;
            } else {
                // Handle cases where the interpretation might not be found
                document.getElementById('interpretation').textContent = 'No interpretation found';
            }
        })
        .catch(error => {
            console.error('Error fetching interpretation:', error);
            document.getElementById('interpretation').textContent = 'Error fetching interpretation';
        });
}
</script>




        
        <?php include "../model/footer.php";?>


</body>
</html>




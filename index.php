
<?php
// Start session to access session variables
session_start();

// Include necessary files
include "./view/nav.php";
include "./model/database.php";
include "./model/functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Dream Catcher</title>

    <!-- Bootstrap CDN links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Gloria+Hallelujah&family=Rubik+Bubbles&display=swap" rel="stylesheet">

    <!-- CSS page link -->
    <link rel="stylesheet" href="./view/styles.css">
</head>


<body class="index-body">
    <h1>The Dream Catcher</h1>
    <h3>A Dream Interpreter</h3>

    
    <div class="container">

        <div id="interpretationResponse">

        <!-- Registration Form -->
        <div id="registrationForm">
            <p class="register-text">To use the Dream Catcher, please register your email to obtain an API key:</p>
            <form action="model/register.php" class="register" method="POST">
                <input type="email" name="email" placeholder="Email">
                <input type="submit" class='btn btn-outline-light' value="Register">
            </form>
        </div>
    </div>

    <script>
        // Function to fetch dream information from the API and update the DOM
        function getInterpretation() {
            axios.get('dreamsapi.php?')  
                .then(function (response) {
                    const dream = response.data;
                    let html = '<ul>';
                    dream.forEach(dream => {
                        html += `<li>${dream.symbol}: ${dream.interpretation}</li>`;
                    });
                    html += '</ul>';
                    // Display the dream interpretation
                    document.getElementById('interpretationResponse').innerHTML = html;
                })  
                .catch(function (error) { 
                    // If error occurs, display error message
                    console.log("An error occurred");
                });
            }
    </script>

    <!-- Include footer -->
    <?php include "./model/footer.php";?>

        

</body>
</html>
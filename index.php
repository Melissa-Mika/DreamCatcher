
<?php include "./view/nav.php"?>
<?php include "model/database.php";?>
<?php require_once "model/functions.php";?>

<?php

$symbols = getAllDreamSymbols();

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

<!-- CSS page link -->
<link rel="stylesheet" href="view/styles.css">

</head>
<body>

<h1>The Dream Catcher</h1>
<h3>A Dream Interpreter</h3>

<div class="container">
To use the Dream Catcher, please register your email to obtain an API key:
    <form action="model/register.php" class="register" method="POST">
    <input type="email" name="email" placeholder="Email">
    <input type="submit" value="Register">

   
<!-- Display the dream interpretation information -->
<div id="dreamInfo"></div>


 <!-- JavaScript to talk to the api-->
    <script>
        // Function to fetch dream symbol info and update the DOM
        function getDreamInfo() {
            axios.get('dreamsapi.php')  
                .then(function (response) {
                    const dreams = response.data;
                    let html = '<ul>';
                    dreams.forEach(dream => {
                        html += `<li>${dream.symbol}: ${dream.interpretation}</li>`;
                    });
                    html += '</ul>';
                    document.getElementById('dreamInfo').innerHTML = html;
                })
                .catch(function (error) {
                    console.log("An error occurred");
                });
        }

        // Call the function on page load
        getDreamInfo();
    </script>

</body>
</html>
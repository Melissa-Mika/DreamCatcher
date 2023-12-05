
<?php

// starts the session
session_start();

// resets the session variable and redirects back to the registration page that has the registration form
unset($_SESSION['api_key']);
header('Location: ../index.php');
exit;

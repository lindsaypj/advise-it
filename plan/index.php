<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Import functions
include('../functions/functions.php');

$token = "";

// Check if get was submitted, check if token was passed through GET, check that token is valid
if ($_SERVER['REQUEST_METHOD'] =! 'GET' || empty($_GET['token']) || !validToken($_GET['token'])) {
    $token = generateToken();
}
// Token was passed and is valid
else {
    $token = $_GET['token'];
}

// Get data from database

// Display data (if found)

?>

<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Advise-IT <?php echo $token; ?> Plan</title>
</head>
<body>
    <!-- Header -->
    <h1>https://plindsay.greenriverdev.com/372/sprint-one/plan/</h1>

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

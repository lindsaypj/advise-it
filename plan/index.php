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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="../styles/plan.css">

    <title>Advise-IT <?php echo $token; ?> Plan</title>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="row pb-4">
            <div class="col">
                <a class="position-absolute" href="../">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                    </svg>
                </a>
                <h1 class="text-center">Token: <?php echo $token; ?></h1>
                <div class="d-block align-middle text-center">
                    <div class="d-inline-block bg-light ps-3 rounded border-secondary">
                        <h4 class="d-inline">
                            https://plindsay.greenriverdev.com/372/sprint-one/plan/?token=<?php echo $token; ?>
                        </h4>
                        <button class="btn-secondary btn d-inline opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard2-plus" viewBox="0 0 16 16">
                                <path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
                                <path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
                                <path d="M8.5 6.5a.5.5 0 0 0-1 0V8H6a.5.5 0 0 0 0 1h1.5v1.5a.5.5 0 0 0 1 0V9H10a.5.5 0 0 0 0-1H8.5V6.5Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div> <!-- Col -->
        </div> <!-- Row -->

        <form method="post">
            <!-- Plan -->
            <div class="row">
                <!-- FALL -->
                <div class="col-md-6 col-12 pb-4">
                    <div class="form-floating">
                        <textarea class="form-control quarter-area" placeholder="Leave a comment here" name="fall" id="fall"></textarea>
                        <label for="fall">Fall</label>
                    </div>
                </div>

                <!-- WINTER -->
                <div class="col-md-6 col-12 pb-4">
                    <div class="form-floating">
                        <textarea class="form-control quarter-area" placeholder="Leave a comment here" name="winter" id="winter"></textarea>
                        <label for="winter">Winter</label>
                    </div>
                </div>

                <!-- SPRING -->
                <div class="col-md-6 col-12 pb-4">
                    <div class="form-floating">
                        <textarea class="form-control quarter-area" placeholder="Leave a comment here" name="spring" id="spring"></textarea>
                        <label for="spring">Spring</label>
                    </div>
                </div>

                <!-- SUMMER -->
                <div class="col-md-6 col-12 pb-4">
                    <div class="form-floating">
                        <textarea class="form-control quarter-area" placeholder="Leave a comment here" name="summer" id="summer"></textarea>
                        <label for="summer">Summer</label>
                    </div>
                </div>

            </div> <!-- Plan Row -->

            <div class="row">
                <div class="col text-center">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </div>

        </form>
    </div> <!-- Container -->

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

</body>
</html>

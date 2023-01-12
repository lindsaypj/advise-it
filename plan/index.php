<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Import functions
include('../functions/functions.php');

$token = "";
$formSubmitted = false;
$saveSuccess = false;

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    $formSubmitted = true;

    // Store current token
    if (validToken($_POST['token'])) {
        $token = $_POST['token'];
    }

    // Attempt to save data in POST to database
    $saveSuccess = true;

    // Get current timestamp
//    $lastUpdated = date('Y-m-d h:i:s A');
    $fmt = datefmt_create(
        'en_US',
        IntlDateFormatter::SHORT,
        IntlDateFormatter::MEDIUM,
        'America/Los_Angeles',
        IntlDateFormatter::GREGORIAN
    );
    $lastUpdated = datefmt_format($fmt, time());
}
// Check if get was submitted, check if token was passed through GET, check that token is valid
else if (empty($_GET['token']) || !validToken($_GET['token'])) {
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
    <div class="container bg-light">
        <!-- Header -->
        <div class="row pb-4">
            <div class="col">
                <!-- Homepage link -->
                <a class="position-absolute" href="../">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                    </svg>
                </a>

                <!-- Token -->
                <h1 class="text-center">Token: <?php echo $token; ?></h1>

                <!-- Unique URL with token -->
                <div class="d-block align-middle text-center rounded token-url">
                    <div class="input-group mb-3 shadow-sm rounded">
                        <input
                            type="text"
                            class="form-control bg-white border-none"
                            aria-label="Current plan link"
                            aria-describedby="copy-url"
                            value="https://plindsay.greenriverdev.com/372/sprint-one/plan/?token=<?php echo $token; ?>"
                            disabled
                            aria-disabled="true"
                        >

                        <button class="btn btn-light border-none" type="button" id="copy-url">
                            <svg fill="#000000" height="16" width="16" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 330 330" xml:space="preserve">
                                <g>
                                    <path d="M35,270h45v45c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V75c0-8.284-6.716-15-15-15h-45V15
                                        c0-8.284-6.716-15-15-15H35c-8.284,0-15,6.716-15,15v240C20,263.284,26.716,270,35,270z M280,300H110V90h170V300z M50,30h170v30H95
                                        c-8.284,0-15,6.716-15,15v165H50V30z"/>
                                    <path d="M155,120c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15s-6.716-15-15-15H155z"/>
                                    <path d="M235,180h-80c-8.284,0-15,6.716-15,15s6.716,15,15,15h80c8.284,0,15-6.716,15-15S243.284,180,235,180z"/>
                                    <path d="M235,240h-80c-8.284,0-15,6.716-15,15c0,8.284,6.716,15,15,15h80c8.284,0,15-6.716,15-15C250,246.716,243.284,240,235,240z
                                        "/>
                                </g>
                            </svg>
                        </button>
                    </div>
                </div> <!-- Token URL -->

                <h4 class="text-center"><?php if (!empty($lastUpdated)) echo "Last Updated: ".$lastUpdated; ?></h4>

            </div> <!-- Col -->
        </div> <!-- Row -->

        <form action="#" method="post">

            <!-- Token Input -->
            <input type="hidden" name="token" value="<?php echo $token ?>">

            <!-- Plan -->
            <div class="row">
                <!-- FALL -->
                <div class="col-md-6 col-12 pb-4">
                    <div class="form-floating">
                        <textarea
                            class="form-control quarter-area shadow-sm border-none"
                            placeholder="Leave a comment here"
                            name="fall"
                            id="fall"
                        ><?php if ($formSubmitted) echo $_POST['fall']; ?></textarea>
                        <label for="fall">Fall</label>
                    </div>
                </div>

                <!-- WINTER -->
                <div class="col-md-6 col-12 pb-4">
                    <div class="form-floating">
                        <textarea
                            class="form-control quarter-area shadow-sm border-none"
                            placeholder="Leave a comment here"
                            name="winter"
                            id="winter"
                        ><?php if ($formSubmitted) echo $_POST['winter']; ?></textarea>
                        <label for="winter">Winter</label>
                    </div>
                </div>

                <!-- SPRING -->
                <div class="col-md-6 col-12 pb-4">
                    <div class="form-floating">
                        <textarea
                            class="form-control quarter-area shadow-sm border-none"
                            placeholder="Leave a comment here"
                            name="spring"
                            id="spring"
                        ><?php if ($formSubmitted) echo $_POST['spring']; ?></textarea>
                        <label for="spring">Spring</label>
                    </div>
                </div>

                <!-- SUMMER -->
                <div class="col-md-6 col-12 pb-4">
                    <div class="form-floating">
                        <textarea
                            class="form-control quarter-area shadow-sm border-none"
                            placeholder="Leave a comment here"
                            name="summer"
                            id="summer"
                        ><?php if ($formSubmitted) echo $_POST['summer']; ?></textarea>
                        <label for="summer">Summer</label>
                    </div>
                </div>

            </div> <!-- Plan Row -->

            <!-- Save Button -->
            <div class="row">
                <div class="col text-center">
                    <button class="btn btn-primary shadow-sm" type="submit" id="saveBtn">Save</button>
                </div>
            </div>

        </form>


        <!-- Save Notification -->
        <?php
            // Only add toast to page if the form was submitted
            if ($formSubmitted) {
                // Display correct save notification
                if ($saveSuccess) {
                    // Success Message
                    echo
                    '<div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square-fill me-2" viewBox="0 0 16 16">
                                  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm10.03 4.97a.75.75 0 0 1 .011 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.75.75 0 0 1 1.08-.022z"/>
                                </svg>
                                <strong class="me-auto">Success!</strong>
                                <small>'.$lastUpdated.'</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                    Plan successfully saved.
                            </div>
                        </div>
                    </div>';
                } else {
                    // Error Message
                    echo
                    '<div class="toast-container position-fixed bottom-0 end-0 p-3">
                        <div id="saveNotification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill me-2" viewBox="0 0 16 16">
                                  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                </svg>
                                <strong class="me-auto">Error!</strong>
                                <small>'.$lastUpdated.'</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                    There was an error saving plan data.
                            </div>
                        </div>
                    </div>';
                }
            }
        ?>
    </div> <!-- Container -->

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

    <?php
    if ($formSubmitted) {
        echo '<script src="../scripts/saveNotification.js"></script>';
    }
    ?>
</body>
</html>

<?php
    session_start();

$validLogin = true;
$cancelLink = "";

// Display form when redirected from admin
if (isset($_SESSION['displayForm']) && $_SESSION['displayForm'] == "true") {
    $_SESSION['displayForm'] = false;
    $displayLogin = true;
}
else {
    $displayLogin = false;
}

//If the form has been submitted
if (!empty($_POST)) {

    //Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate not empty
    if ($username === "" && $password === "") {
        $errorMessage = "Please enter username and Password";
    }


    //Require the credentials file, which defines a $Logins array
    require('/home/plindsay/users.php');

    //If the username is in the array and the passwords match
    if (array_key_exists($username, $logins)) {
        if ($password == $logins[$username]) {
            //Record the username in the session array
            $_SESSION['username'] = $username;

            header('location: /portfolio/guestbook/admin.php');
        }
        else {
            //Invalid login -- set flag variable
            $errorMessage = "Invalid username or password";
            $validLogin = false;
        }
    }
    else {
        //Invalid login -- set flag variable
        if ($username !== "") {
            $errorMessage = "Invalid username or password";
        }

        $validLogin = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>Advise-IT</title>
</head>
<body>
    <!-- Login Button -->
    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#loginModal">
        Admin
    </button>
    <!-- Header -->
    <div class="bg-light p-5">
        <h1 class="display-4">Welcome to Advise-it</h1>
        <p class="lead">This is a tool for the Advising Staff</p>
        <hr class="my-4">
        <p></p>
        <!-- Button already here just need to send it somewhere on click -->
        <p>
            <a class="btn btn-primary btn-lg" href="new-plan" role="button">Create New Plan</a>
        </p>
    </div>

    <!-- LOGIN Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Admin Login</h5>
                </div>

                <form action="#" method="post" class="m-0 px-3 text-shadow-none w-100">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php if (isset($username)) { echo $username;} ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" >
                        </div>
                        <?php
                        if (!$validLogin) {
                            echo "<p class='error'>$errorMessage</p>";
                        }
                        ?>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" href="<?php echo $cancelLink; ?>">Cancel</a>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>
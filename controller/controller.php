<?php

// Create PDO for Database access
require_once $_SERVER["DOCUMENT_ROOT"].'/../config.php';
include('model/functions.php');
include('model/formatter.php');

/**
 * Controller handles the routing and form validation for all the
 * pages in the Advise-IT website
 * @author Patrick Lindsay
 * @version 1.0
 * @date 1/20/23
 */
class Controller
{
    // FIELDS //
    private $_f3;

    // CONSTRUCTOR //
    /**
     * Constructor for Adivse-IT controller object
     * @param $f3 object used for controlling Fat-Free framework
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


    // PAGE RENDERING METHODS //

    /**
     * Displays the home page (default page)
     */
    function home()
    {
        $view = new Template();
        echo $view->render('views/home.php');
    }

    /**
     * Processes the login attempt and directs the user to the correct page accordingly.
     * If Login is successful, directs admin to admin page
     * if unsuccessful, directs user back to home page with error message
     */
    function loginAttempt() {
        $this->_f3->set('validLogin', false);
        $this->_f3->set('cancelLink', "");
        $this->_f3->set('username', "");

        // If the form has been submitted
        if (!empty($_POST)) {

            //Get the form data
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (isset($username)) {
                $this->_f3->set('username', $username);
            }


            // Validate not empty
            if ($username === "" && $password === "") {
                $this->_f3->set('errorMessage', "Please enter username and Password");
            }


            // Require the credentials file, which defines a $Logins array
            require('/home/plindsay/users.php');
            if (!isset($logins)) {
                $this->_f3->set('errorMessage', "Failed to connect to server");
            }
            // If the username is in the array and the passwords match
            else if (array_key_exists($username, $logins)) {
                if ($password == $logins[$username]) {
                    //Record the username in the session array
                    $_SESSION['username'] = $username;

                    header('location: /admin');
                }
                else {
                    // Invalid login (password) -- set flag variable
                    $this->_f3->set('errorMessage', "Invalid username or password");
                }
            }
            else {
                //Invalid login (username) -- set flag variable
                if ($username !== "") {
                    $this->_f3->set('errorMessage', "Invalid username or password");
                }
            }
            // Failed to log in (Render Home page)
            $this->_f3->set('displayForm', true);

            $view = new Template();
            echo $view->render('views/home.php');
        }
    }


    /**
     * Generates a new token and displays the plan page.
     * Saves to the load plan page.
     */
    function newPlan()
    {
        $token = generateToken();

        // Prevent reusing tokens
        while(!validToken($token) || is_array(getPlan($token))) {
            $token = generateToken();
        }

        $this->_f3->set('token', $token);

        // Initialize Variables to determine rendering characteristics
        $this->_f3->set('formSubmitted', false); // Display submitted form data + confirmation
        $this->_f3->set('saveSuccess', false); // Determines state of confirmation message
        $this->_f3->set('planData', null); // Variable to store the plan data

        $view = new Template();
        echo $view->render('views/plan.php');
    }


    /**
     * Loads a plan if the passed token is valid. Handles form validation,
     * and sends data to datalayer for storage if valid.
     */
    function viewPlan($token)
    {
        // If token is invalid, redirect to home
        if (!validToken($token)) {
            header('location: /');
        }

        // Initialize Variables to determine rendering characteristics
        $lastUpdated = null; // Variable to store most recent save time
        $formSubmitted = false; // Display submitted form data + confirmation
        $saveSuccess = false; // Determines state of confirmation message
        $advisor = "";
        $fall = "";
        $winter = "";
        $spring = "";
        $summer = "";

        // Check if form was submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
            $formSubmitted = true;

            // Store current token (if valid)
            if (validToken($_POST['token'])) {
                $token = $_POST['token'];
            }

            // Attempt to save data in POST to database
            if (is_array(getPlan($token))) {
                // Plan is stored in database (UPDATE)
                $saveSuccess = updatePlan($token);
            }
            else {
                // Plan was not already in database (INSERT)
                $saveSuccess = saveNewPlan($token);
            }

            // Get current timestamp and format
            $plan = getPlan($token);
            $lastUpdated = formatTime($plan['lastUpdated']);
            $advisor = $plan['advisor'];
            $fall = $plan['fall'];
            $winter = $plan['winter'];
            $spring = $plan['spring'];
            $summer = $plan['summer'];
        }
        else {
            // Get token data from database
            $plan = getPlan($token);

            // Check if Token is stored in database
            if (!empty($plan['token'])) {
                $token = $plan['token'];
                $lastUpdated = formatTime($plan['lastUpdated']);
                $advisor = $plan['advisor'];
                $fall = $plan['fall'];
                $winter = $plan['winter'];
                $spring = $plan['spring'];
                $summer = $plan['summer'];
            }
            // Invalid Token passed
            else {
                header('location: ../');
            }
        }

        // Pass data through F3 to be rendered
        $this->_f3->set('token', $token);
        $this->_f3->set('lastUpdated', $lastUpdated);
        $this->_f3->set('formSubmitted', $formSubmitted);
        $this->_f3->set('saveSuccess', $saveSuccess);
        $this->_f3->set('advisor', $advisor);
        $this->_f3->set('fall', $fall);
        $this->_f3->set('winter', $winter);
        $this->_f3->set('spring', $spring);
        $this->_f3->set('summer', $summer);

        // Render page
        $view = new Template();
        echo $view->render('views/plan.php');
    }

    function printPlan($token) {
        if (validToken($token)) {
            $plan = getPlan($token);

            $this->_f3->set('token', $token);
            $this->_f3->set('lastUpdated', $plan['lastUpdated']);
            $this->_f3->set('advisor', $plan['advisor']);
            $this->_f3->set('fall', $plan['fall']);
            $this->_f3->set('winter', $plan['winter']);
            $this->_f3->set('spring', $plan['spring']);
            $this->_f3->set('summer', $plan['summer']);
        }

        // Render page
        $view = new Template();
        echo $view->render('views/print-plan.php');
    }
}
<?php
// Patrick Lindsay
// index.php
// 1/20/2023
// Entry Point of the Advise-IT website
// Initializes the Fat-Free Framework and defines the routing
// interfaces with the controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');
require_once $_SERVER["DOCUMENT_ROOT"].'/../config.php';

// Start Session
session_start();

// Create an instance of the base class
$f3 = Base::instance();

// Create Instance of Controller
$con = new Controller($f3);

// Create Instance of DataLayer
//$datalayer = new DataLayer();


////   ROUTES   ////

// Define default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});
// Define home route
$f3->route('GET /home', function() {
    $GLOBALS['con']->home();
});

// Define route to handle login attempts on home page (POST)
$f3->route('POST /', function() {
    $GLOBALS['con']->loginAttempt();
});

// Define New Plan page
$f3->route('GET|POST /new-plan', function($f3) {
    $GLOBALS['con']->newPlan();
});

// Define View Plan page
$f3->route('GET|POST /view-plan/@token', function($f3) {
    $GLOBALS['con']->viewPlan($f3->get('PARAMS.token'));
});

// Define View Plan page
$f3->route('GET|POST /print-plan/@token', function($f3) {
    $GLOBALS['con']->printPlan($f3->get('PARAMS.token'));
});


////   RUN FAT FREE   ////

// Run fat-free
$f3->run();
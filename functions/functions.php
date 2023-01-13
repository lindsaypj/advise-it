<?php

function validToken(string $token) {
    // validate length
    if (strlen($token) != 6) {
        return false;
    }

    // Allowed chars (letters and numbers)
    if (!ctype_alnum($token)) {
        return false;
    }

    return true;
}

function generateToken() {
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return substr(str_shuffle($permitted_chars), 0, 6);
}

function getToken(string $token) {
    // Access PDO from globals
    global $dbh;

    $sql = "SELECT * FROM plans WHERE token = :token";
    $sql = $dbh->prepare($sql);
    $sql->bindParam(':token', $token, PDO::PARAM_STR);
    $sql->execute();

    return $sql->fetch(PDO::FETCH_ASSOC);
}

function saveNewPlan(): bool {
    // Access PDO from globals
    global $dbh;
    global $token;


    // Attempt to insert
    $sql = "INSERT INTO plans (token, fall, winter, spring, summer, lastUpdated)
            VALUES (:token, :fall, :winter, :spring, :summer, :lastUpdated)";

    $sql = $dbh->prepare($sql);

    $fall = $_POST['fall'];
    $winter = $_POST['winter'];
    $spring = $_POST['spring'];
    $summer = $_POST['summer'];
    $lastUpdated = time();

    $sql->bindParam(':token', $token, PDO::PARAM_STR);
    $sql->bindParam(':fall', $fall, PDO::PARAM_STR);
    $sql->bindParam(':winter', $winter, PDO::PARAM_STR);
    $sql->bindParam(':spring', $spring, PDO::PARAM_STR);
    $sql->bindParam(':summer', $summer, PDO::PARAM_STR);
    $sql->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_INT);

    return $sql->execute();
}

function updatePlan(): bool {
    // Access PDO from globals
    global $dbh;
    global $token;

    // Attempt to insert
    $sql = "UPDATE plans SET 
            fall = :fall, 
            winter = :winter, 
            spring = :spring, 
            summer = :summer, 
            lastUpdated = :lastUpdated
            WHERE token = :token";

    $sql = $dbh->prepare($sql);

    // Get
    $fall = $_POST['fall'];
    $winter = $_POST['winter'];
    $spring = $_POST['spring'];
    $summer = $_POST['summer'];
    $lastUpdated = time();

    $sql->bindParam(':token', $token, PDO::PARAM_STR);
    $sql->bindParam(':fall', $fall, PDO::PARAM_STR);
    $sql->bindParam(':winter', $winter, PDO::PARAM_STR);
    $sql->bindParam(':spring', $spring, PDO::PARAM_STR);
    $sql->bindParam(':summer', $summer, PDO::PARAM_STR);
    $sql->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_INT);

    return $sql->execute();
}


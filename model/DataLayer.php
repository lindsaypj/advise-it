<?php

/**
 * Class to retrieve data for the findMatch() (dating) website.
 * Stores form options and methods to interact with database.
 * @author Patrick Lindsay
 * @version 1.1
 * @date 6/4/22
 */
class DataLayer
{
    // FIELDS
    private PDO $_dbh;

    /**
     * Constructor for DataLayer Objects. Instantiates the PDO object for
     * requesting data from the database.
     */
    function __construct()
    {
        // Get PDO object
        require_once($_SERVER['DOCUMENT_ROOT'].'/../config.php');
        $this->_dbh = $dbh;

        // Enable Error reporting
        $this->_dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->_dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    function getPlan(string $token) {
        $sql = "SELECT * FROM plans WHERE token = :token";
        $sql = $this->_dbh->prepare($sql);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    function saveNewPlan($token): bool {
        // Attempt to insert
        $sql = "INSERT INTO plans (token, fall, winter, spring, summer, lastUpdated, advisor)
            VALUES (:token, :fall, :winter, :spring, :summer, :lastUpdated, :advisor)";

        $sql = $this->_dbh->prepare($sql);

        $advisor = $_POST['advisor'];
        $fall = $_POST['fall'];
        $winter = $_POST['winter'];
        $spring = $_POST['spring'];
        $summer = $_POST['summer'];
        $lastUpdated = time();

        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':advisor', $advisor, PDO::PARAM_STR);
        $sql->bindParam(':fall', $fall, PDO::PARAM_STR);
        $sql->bindParam(':winter', $winter, PDO::PARAM_STR);
        $sql->bindParam(':spring', $spring, PDO::PARAM_STR);
        $sql->bindParam(':summer', $summer, PDO::PARAM_STR);
        $sql->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_INT);

        return $sql->execute();
    }

    function updatePlan($token): bool {
        // Attempt to insert
        $sql = "UPDATE plans SET 
            fall = :fall, 
            winter = :winter, 
            spring = :spring, 
            summer = :summer, 
            lastUpdated = :lastUpdated,
            advisor = :advisor
            WHERE token = :token";

        $sql = $this->_dbh->prepare($sql);

        $advisor = $_POST['advisor'];
        $fall = $_POST['fall'];
        $winter = $_POST['winter'];
        $spring = $_POST['spring'];
        $summer = $_POST['summer'];
        $lastUpdated = time();

        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':advisor', $advisor, PDO::PARAM_STR);
        $sql->bindParam(':fall', $fall, PDO::PARAM_STR);
        $sql->bindParam(':winter', $winter, PDO::PARAM_STR);
        $sql->bindParam(':spring', $spring, PDO::PARAM_STR);
        $sql->bindParam(':summer', $summer, PDO::PARAM_STR);
        $sql->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_INT);

        return $sql->execute();
    }

    function getPlans() {
        $sql = "SELECT * FROM plans";
        $sql = $this->_dbh->prepare($sql);
        $sql->execute();

        // Get query results
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
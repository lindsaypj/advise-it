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

    /**
     * Function to randomly generate a new token.
     * Ensures that the token does not already exist
     * @return string unique token for a new plan
     */
    function generateToken(): string
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = substr(str_shuffle($permitted_chars), 0, 6);

        // Prevent reusing tokens
        while(!(Validator::validToken($token)) || $this->planExists($token)) {
            $token = substr(str_shuffle($permitted_chars), 0, 6);
        }

        return $token;
    }

    function planExists($token): bool
    {
        // Get Plan
        $sql = "SELECT * FROM plans WHERE token = :token";
        $sql = $this->_dbh->prepare($sql);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->execute();

        return !empty($sql->fetch(PDO::FETCH_ASSOC));
    }

    function getPlan(string $token)
    {
        // Get Plan
        $sql = "SELECT * FROM plans WHERE token = :token";
        $sql = $this->_dbh->prepare($sql);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->execute();

        $plan = $sql->fetch(PDO::FETCH_ASSOC);

        // Get Quarter data
        $sql = "SELECT * FROM quarters WHERE token = :token";
        $sql = $this->_dbh->prepare($sql);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->execute();


        $quarters = $sql->fetchAll(PDO::FETCH_ASSOC);
        if (empty($quarters)) {
            return $plan;
        }

        // Parse Quarter data
        // columns: token year quarter notes
        foreach ($quarters as $quarter) {
            // Calendar year offset
            $offset = 0;
            if ($quarter['quarter'] == 'fall') {
                $offset = 1;
            }

            // Plan[schoolYears][2023][fall][notes] = "Some notes"
            $plan['schoolYears'][strval($quarter['year']+$offset)][$quarter['quarter']]['notes'] = $quarter['notes'];
            // Plan[schoolYears][2023][fall][calendarYear] = 2022
            $plan['schoolYears'][strval($quarter['year']+$offset)][$quarter['quarter']]['calendarYear'] = $quarter['year'];

            // If data is found, mark year as containing data
            if ($quarter['notes']) {
                $plan['schoolYears'][$quarter['year']]['render'] = true;
            }
        }

        return $plan;
    }

    function saveNewPlan($token): bool
    {
        // Attempt to insert Plan
        $sql = "INSERT INTO plans (token, lastUpdated, advisor)
            VALUES (:token, :lastUpdated, :advisor)";

        $sql = $this->_dbh->prepare($sql);

        $advisor = $_POST['advisor'];
        $lastUpdated = time();

        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':advisor', $advisor, PDO::PARAM_STR);
        $sql->bindParam(':lastUpdated', $lastUpdated, PDO::PARAM_INT);

        // Check if plan was saved
        if (!$sql->execute()) {
            return false;
        }

        return $this->saveYear();
    }

    function saveYear(): bool
    {
        $sql = "INSERT INTO quarters (token, year, quarter, notes)
                VALUES (:token, :fallYear, 'fall', :fall),
                       (:token, :winterYear, 'winter', :winter),
                       (:token, :springYear, 'spring', :spring),
                       (:token, :summerYear, 'summer', :summer)";

        $sql = $this->_dbh->prepare($sql);

        $fall = $_POST['fall'];
        $winter = $_POST['winter'];
        $spring = $_POST['spring'];
        $summer = $_POST['summer'];
        $fallYear = 2022;
        $winterYear = 2023;
        $springYear = 2023;
        $summerYear = 2023;

        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':fall', $fall, PDO::PARAM_STR);
        $sql->bindParam(':winter', $winter, PDO::PARAM_STR);
        $sql->bindParam(':spring', $spring, PDO::PARAM_STR);
        $sql->bindParam(':summer', $summer, PDO::PARAM_STR);
        $sql->bindParam(':fallYear', $fallYear, PDO::PARAM_INT);
        $sql->bindParam(':winterYear', $winterYear, PDO::PARAM_INT);
        $sql->bindParam(':springYear', $springYear, PDO::PARAM_INT);
        $sql->bindParam(':summerYear', $summerYear, PDO::PARAM_INT);

        return $sql->execute();
    }

    function updatePlan($token): bool
    {
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

    function getPlans()
    {
        $sql = "SELECT * FROM plans";
        $sql = $this->_dbh->prepare($sql);
        $sql->execute();

        // Get query results
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
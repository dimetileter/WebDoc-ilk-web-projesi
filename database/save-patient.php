<?php
session_start();
require_once("../database/database-connection.php");

if (isset($_POST["btnSavePatient"])) {
    if($dbConnection) {
        $qury = $dbConnection->prepare("INSERT INTO ");
    }
}


?>
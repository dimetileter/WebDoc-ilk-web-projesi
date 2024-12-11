<?php
require_once("../database/database-connection.php");
session_start();

try {
    if ($dbConnection) {
        $sqlQuery = $dbConnection->prepare(
            "SELECT ilac_adi, ilac_aciklamasi, tedavi_ettigi_hastalik, muayene_tarihi 
            FROM hastakayit WHERE tckn = :tckn;
        "
        );

        $sqlQuery->execute([
            'tckn' => $_SESSION['tckn']
        ]);

        $_SESSION['ilaclar'] = $sqlQuery->fetchAll(PDO::FETCH_ASSOC);
        header('Location:../html/main-page.php?ilac');
        exit;

    } else {
        echo "Veri tabanına baplanılamadı";
    }
} catch (PDOException $e) {
    echo "Veri tabanına baplanılamadı";
}
?>
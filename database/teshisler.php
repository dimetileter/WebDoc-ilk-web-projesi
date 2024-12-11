<?php
require_once("../database/database-connection.php");
session_start();

try {
    if ($dbConnection) {
        // Tanı bilgilerini sorgula
        $sqlQuery_tani = $dbConnection->prepare(
            "SELECT personel_tckn, tani, tani_aciklamasi, muayene_tarihi FROM hastakayit WHERE tckn = :tckn"
        );
        $sqlQuery_tani->execute(['tckn' => $_SESSION['tckn']]);
        $_SESSION['tanilar'] = $sqlQuery_tani->fetchAll(PDO::FETCH_ASSOC);

        // Personel bilgilerini sorgula
        $sqlQuery_personel = $dbConnection->prepare(
            "SELECT isim, soyisim FROM kullanici WHERE tckn = :tckn"
        );
        
        $personel_tckn = $sqlQuery_tani->fetch(PDO::FETCH_ASSOC)['personel_tckn'];

        // Personel bilgilerini 
        $sqlQuery_personel->execute(['tckn' => $personel_tckn]);
        $_SESSION['personel'] = $sqlQuery_personel->fetchAll(PDO::FETCH_ASSOC);

        header('Location:../html/main-page.php?tani');
        exit;
    } else {
        echo "Veri tabanına bağlanılamadı";
    }
} catch (PDOException $e) {
    echo "Veri tabanına bağlanılamadı";
}

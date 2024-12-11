<?php
require_once("../database/database-connection.php");
session_start();

try {
    if ($dbConnection) {
        // Tanı bilgilerini sorgula
        $sqlQuery_yatis = $dbConnection->prepare(
            "SELECT personel_tckn, blok, kat, oda, yatis_tarihi FROM yatiskayit WHERE tckn = :tckn"
        );
        $sqlQuery_yatis->execute(['tckn' => $_SESSION['tckn']]);
        $_SESSION['yatis'] = $sqlQuery_yatis->fetchAll(PDO::FETCH_ASSOC);

        // Personel bilgilerini sorgula
        $sqlQuery_personel = $dbConnection->prepare(
            "SELECT isim, soyisim FROM kullanici WHERE tckn = :tckn"
        );
        
        $personel_tckn = $sqlQuery_yatis->fetch(PDO::FETCH_ASSOC)['personel_tckn'];

        // Personel bilgilerini 
        $sqlQuery_personel->execute(params: ['tckn' => $personel_tckn]);
        $_SESSION['personel'] = $sqlQuery_personel->fetchAll(PDO::FETCH_ASSOC);

        header('Location:../html/main-page.php?yatis');
        exit;
    } else {
        echo "Veri tabanına bağlanılamadı";
    }
} catch (PDOException $e) {
    echo "Veri tabanına bağlanılamadı";
}

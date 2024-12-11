<?php
require_once("../database/database-connection.php");
session_start();

try {
    if ($dbConnection) {
        // Tanı bilgilerini sorgula
        $sqlQuery_gozluk = $dbConnection->prepare(
            "SELECT 
            personel_tckn,
            sol_s, sag_s, 
            sol_c, sag_c,
            sol_a, sag_a,
            gozluk_tarihi
            FROM gozlukkayit WHERE tckn = :tckn"
        );
        $sqlQuery_gozluk->execute(['tckn' => $_SESSION['tckn']]);
        $_SESSION['gozluk'] = $sqlQuery_gozluk->fetchAll(PDO::FETCH_ASSOC);

        // Personel bilgilerini sorgula
        $sqlQuery_personel = $dbConnection->prepare(
            "SELECT isim, soyisim FROM kullanici WHERE tckn = :tckn"
        );
        
        $personel_tckn = $sqlQuery_personel->fetch(PDO::FETCH_ASSOC)['personel_tckn'];

        // Personel bilgilerini 
        $sqlQuery_personel->execute(['tckn' => $personel_tckn]);
        $_SESSION['personel'] = $sqlQuery_personel->fetchAll(PDO::FETCH_ASSOC);

        header('Location:../html/main-page.php?gozluk');
        exit;
    } else {
        echo "Veri tabanına bağlanılamadı";
    }
} catch (PDOException $e) {
    echo "Veri tabanına bağlanılamadı";
}

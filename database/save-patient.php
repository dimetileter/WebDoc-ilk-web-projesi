<?php
session_start();
require_once("../database/database-connection.php");

if (isset($_POST["btnSavePatient"]) && isset($_SESSION['columnbx_TC'])) {
    try{
        if($dbConnection) {
            
            $query_hastakayit = $dbConnection->prepare(
                "INSERT INTO hastakayit SET
                    tckn = :tckn,
                    personel_tckn = :personel_tckn,
                    tani = :diagnosis,
                    tani_aciklamasi = :diagnosisDesc,
                    ilac_adi = :medicine,
                    ilac_aciklamasi = :medicineDesc,
                    tedavi_ettigi_hastalik = :medicineIllnes"
            );
    
            $query_hastakayit ->execute([
                'tckn' => $_SESSION['columnbx_TC'],
                'personel_tckn'=> $_SESSION['personel_tckn'],
                'diagnosis' => $_POST['txtDiagnosis'],
                'diagnosisDesc' => $_POST['txtDiagnosisDesc'],
                'medicine'=> $_POST['txtMedicine'],
                'medicineDesc'=> $_POST['txtMedicineDesc'],
                'medicineIllnes'=> $_POST['txtMedicineIllnes']
            ]);

            // Yatış kayıtlarını yap
            if($_POST['columnbx_yatis_durumu'] == "var") {
                $query_yatiskayit = $dbConnection->prepare(
                    "INSERT INTO yatiskayit SET
                    tckn = :tckn,
                    personel_tckn = :personel_tckn,
                    blok = :_block,
                    kat = :floor,
                    oda = :room
                ");

                $query_yatiskayit ->execute([
                    'tckn' => $_SESSION['columnbx_TC'],
                    'personel_tckn'=> $_SESSION['personel_tckn'],
                    '_block' => $_POST['txtBlock'],
                    'floor' => $_POST['txtFloor'],
                    'room' => $_POST['txtRoom']
                ]);    
                
            }

            // Gözlük kayıtlarını yap
            if($_POST['columnbx_gozluk_durumu'] == "var") {
                $query_gozlukkayit = $dbConnection->prepare(
                    "INSERT INTO gozlukkayit SET
                    tckn = :tckn,
                    personel_tckn = :personel_tckn,
                    sol_s = :txtLeftS,
                    sag_s = :txtRightS,
                    sol_c = :txtLeftC,
                    sag_c = :txtRightC,
                    sol_a = :txtLeftA,
                    sag_a = :txtRightA 
                ");

                $query_gozlukkayit ->execute([
                    'tckn' => $_SESSION['columnbx_TC'],
                    'personel_tckn'=> $_SESSION['personel_tckn'],
                    'txtLeftS' => $_POST['txtLeftS'],
                    'txtRightS' => $_POST['txtRightS'],
                    'txtLeftC' => $_POST['txtLeftC'],
                    'txtRightC' => $_POST['txtRightC'],
                    'txtLeftA'=> $_POST['txtLeftA'],
                    'txtRightA'=> $_POST['txtRightA']
                ]);

            }

            echo "<script>alert('Hasta bilgileri kaydedildi');</script>";
            header("Location:../html/main-page.php?is_employee=1");
            exit;

        }
    }
    catch(Exception $e) {

    }
}
else {
    header("Location:../html/main-page.php?nulltckn=1");
    exit;
}

?>
<?php
    session_start();
    require_once("database-connection.php");

    if (isset($_POST['researchPatient'])) {
        try {
            // Kullanıcı sorgusu
            $sqlQuery_kullanici = $dbConnection->prepare(
                "SELECT * FROM kullanici
                WHERE tckn = :tckn"
            );

            $sqlQuery_kullanici->execute([
                'tckn' => $_POST['columnbx_TC']
            ]);

            // Bulunan veriyi al
            $user = $sqlQuery_kullanici->fetch(PDO::FETCH_ASSOC);

            // Eğer kullanıcı varsa
            if ($user) {
                // Hasta bilgileri sorgusu
                $sqlQuery_2 = $dbConnection->prepare(
                    "SELECT * FROM hastabilgileri 
                    WHERE kullanici_id = :userID"
                );
                $sqlQuery_2->execute([
                    'userID' => $user['kullanici_id']
                ]);

                $cronicDiseases = $sqlQuery_2->fetch(PDO::FETCH_ASSOC);

                // Oturum verilerini ayarla
                $_SESSION['cbUserName'] = $user['isim'];
                $_SESSION['cbUserSurname'] = $user['soyisim'];
                $_SESSION['cbChronic_disease1'] = $cronicDiseases['kronik_hastalik1'] ?? "Kronik hastalık yok";
                $_SESSION['cbChronic_disease2'] = $cronicDiseases['kronik_hastalik2'] ?? "Kronik hastalık yok";
                $_SESSION['cbChronic_disease3'] = $cronicDiseases['kronik_hastalik3'] ?? "Kronik hastalık yok";
            
                header("Location:../html/main-page.php?is_employee=1");
            } 
            else {
                // Kullanıcı bulunamadıysa yapılacaklar
                $_SESSION['error'] = "Kullanıcı bulunamadı.";
            }
        } 
        catch (Exception $e) {
            error_log("Hata: " . $e->getMessage());
            $_SESSION['error'] = "Bir hata oluştu. Daha sonra tekrar deneyin.";
        }
    }
?>

<?php
    session_start();
    require_once("database-connection.php");

    // Diğer action'da kullanılmak üzere sakla
    $_SESSION['columnbx_TC'] = $_POST['columnbx_TC'];

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
                    WHERE tckn = :tckn"
                );
                
                $sqlQuery_2->execute([
                    'tckn' => $_POST['columnbx_TC']
                ]);

                $diseases = $sqlQuery_2->fetch(PDO::FETCH_ASSOC);

                // Oturum verilerini ayarla
                $_SESSION['cbUserName'] = $user['isim'];
                $_SESSION['cbUserSurname'] = $user['soyisim'];
                $_SESSION['cbBlood_type'] = $diseases['kan_grubu'];
                $_SESSION['cbChronic_disease1'] = $diseases['kronik_hastalik1'];
                $_SESSION['cbChronic_disease2'] = $diseases['kronik_hastalik2'];
                $_SESSION['cbChronic_disease3'] = $diseases['kronik_hastalik3'];
            
                header("Location:../html/main-page.php?is_employee=1");
                exit;
            } 
            else {
                // Kullanıcı bulunamadıysa yapılacaklar
                $_SESSION['cbUserName'] = "Kullanıcı bulunamadı.";
                $_SESSION['cbUserSurname'] = "-";
                $_SESSION['cbBlood_type'] = "-";
                $_SESSION['cbChronic_disease1'] = "-";
                $_SESSION['cbChronic_disease2'] = "-";
                $_SESSION['cbChronic_disease3'] = "-";
                header("Location:../html/main-page.php?is_employee=1");
                exit;
            }
        } 
        catch (Exception $e) {
            error_log("Hata: " . $e->getMessage());
            $_SESSION['error'] = "Bir hata oluştu. Daha sonra tekrar deneyin.";
        }
    }
?>

<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);    
session_start();
require_once("database-connection.php");

if (isset($_POST["btnLogin"])) {
    try {
        // Kullanıcı bilgilerini veritabanında kontrol et
        $sqlQuery_kullanici = $dbConnection->prepare(
            "SELECT * FROM kullanici 
                    WHERE email = :email 
                    AND tckn = :tckn"
        );

        $sqlQuery_kullanici->execute([
            'email' => $_POST['txtEmail'],
            'tckn' => $_POST['txtTC']
        ]);

        // Tablodan çekilen verileri user isimli değişkene aktar
        $kullanici = $sqlQuery_kullanici->fetch(PDO::FETCH_ASSOC);

        // Eğer aranan kullanıcı varsa ilgili işlemleri yap
        if ($kullanici) {
            // Session işlemleri
            $kullanici_tckn = $kullanici['tckn'];
            $_SESSION['tckn'] = $kullanici_tckn;
            $_SESSION['userName'] = $kullanici['isim'];
            $_SESSION['userSurname'] = $kullanici['soyisim'];
            $_SESSION['userPhone'] = $kullanici['telefon'];
            $_SESSION['email'] = $kullanici['email'];
            $_SESSION['birth_date'] = $kullanici['dogum_tarihi'];
            $_SESSION['birth_city'] = $kullanici['dogum_sehri'];
            $_SESSION['gender'] = $kullanici['cinsiyet'];
            $_SESSION['personel_mi'] = $kullanici['personel_mi'];
            // Çerez işlemlerini kontrol et 
            /* Çerez işlemlerini en son ekle
            if(isset($_POST[''])) {

            }
            else {

            }
            */

            // Eğer personelse personel bilgilerini al değilse hasta bilgilerini al
            if (isset($kullanici['personel_mi']) && $kullanici['personel_mi'] == 1) {
                
                // Personel bilgilerini getir
                get_personelbilgileri($dbConnection, $kullanici_tckn);
                
                // Perosnel sayfasına yönlendir
                $_SESSION['personel_tckn'] = $kullanici_tckn;
                header("Location:../html/main-page.php?is_employee=1");
                exit;
            } 
            else {
                // Kullanıcı verilerini al ve anasayfaya yönlendir
                get_hastabilgileri($dbConnection, $kullanici_tckn);
                get_yakinakraba($dbConnection, $kullanici_tckn);
                get_muayeneTarihi($dbConnection, $kullanici_tckn);

                header("Location:../html/main-page.php?is_employee=0");
                exit;
            }
        } 
        else {
            // Kullanıcının bulunamaması durumunda welcome ekranına yönlendir
            header("Location:welcome-page.php?state=0");
            exit;
        }
    } 
    catch (Exception $e) {
        $messagetext = $e->getMessage();
        echo "<scrşpt>alert('$messagetext')</script>";
    }
} else {
    echo "ERROR";
}

function get_hastabilgileri($db, $tckn)
{
    // Sql tablosundan verileri çek
    $sqlQuery_hastabilgileri = $db->prepare(
        "SELECT * FROM hastabilgileri WHERE tckn = :tckn"
    );

    $sqlQuery_hastabilgileri ->execute([
        "tckn"=> $tckn
    ]);

    // Verileri değişkene aktar
    $hastabilgileri = $sqlQuery_hastabilgileri->fetch(PDO::FETCH_ASSOC);

    if ($hastabilgileri) {
        $_SESSION['blood_type'] = $hastabilgileri['kan_grubu'];
        $_SESSION['_height'] = $hastabilgileri['boy'];
        $_SESSION['_weight'] = $hastabilgileri['kilo'];
        $_SESSION['chronic_disease1'] = $hastabilgileri['kronik_hastalik1'];
        $_SESSION['chronic_disease2'] = $hastabilgileri['kronik_hastalik2'];
        $_SESSION['chronic_disease3'] = $hastabilgileri['kronik_hastalik3'];
    } else {
        $_SESSION['blood_type'] = "Kan grubu";
        $_SESSION['_height'] = "Boy";
        $_SESSION['_weight'] = "Kilo";
        $_SESSION['chronic_disease1'] = "Kronik hastalık 1";
        $_SESSION['chronic_disease2'] = "Kronik hastalık 2";
        $_SESSION['chronic_disease3'] = "Kronik hastalık 3";
    }
}

function get_yakinakraba($db, $tckn)
{
    // Sorgu
    $sqlQuery_yakinakraba = $db->prepare(
        "SELECT * FROM yakinakraba WHERE tckn = :tckn"
    );

    $sqlQuery_yakinakraba ->execute([
        "tckn"=> $tckn
    ]);

    // Verileri değişkene aktar
    $yakinakraba = $sqlQuery_yakinakraba->fetch(PDO::FETCH_ASSOC);

    if ($yakinakraba) {
        $_SESSION['close_relative_name'] = $yakinakraba['akraba_ismi'];
        $_SESSION['crelative_surname'] = $yakinakraba['akraba_soyismi'];
        $_SESSION['close_reltaive_phone'] = $yakinakraba['akraba_telefon'];
    } else {
        $_SESSION['close_relative_name'] = "Yakın akraba ad";
        $_SESSION['crelative_surname'] = "Yakın akraba soyad";
        $_SESSION['close_reltaive_phone'] = "Yakın akraba telefon";
    }

}

function get_personelbilgileri($db, $tckn){
    // Sorgu
    $sqlQuery_personelbilgileri = $db->prepare(
        "SELECT * FROM personelbilgileri WHERE tckn = :tckn"
    );

    $sqlQuery_personelbilgileri ->execute([
        "tckn"=> $tckn
    ]);

    // Sorgu snucunu getir
    $personelbilgileri = $sqlQuery_personelbilgileri->fetch(PDO::FETCH_ASSOC);
    if($personelbilgileri) {
      $_SESSION['job'] = $personelbilgileri['gorev'];
      $_SESSION['expertis'] = $personelbilgileri['uzmanlik'];
      $_SESSION['branch'] = $personelbilgileri['brans'];
      $_SESSION['hospitalName'] = $personelbilgileri['hastane_adi'];
      $_SESSION['policlinik'] = $personelbilgileri['poliklinik'];
      $_SESSION['employeeID'] = $personelbilgileri['personel_kimligi'];
    }
    else {
        $_SESSION['job'] = "Meslek";
        $_SESSION['expertis'] = "Uzmanlık";
        $_SESSION['branch'] = "Branş";
        $_SESSION['hospitalName'] = "Hastane adı";
        $_SESSION['policlinik'] = "Poliklinik";
        $_SESSION['employeeID'] = "Personel kimliği";
    }
}

function get_muayeneTarihi($db, $tckn) {
    $sqlQuery_muayeneler = $db -> prepare(
        "SELECT muayene_tarihi FROM hastakayit WHERE tckn = :tckn"
    );

    $sqlQuery_muayeneler -> execute([
        "tckn"=> $tckn
    ]);

    // Sorgu sonucunun tümünü getir
    $muayeneTarihleri = $sqlQuery_muayeneler->fetchAll(PDO::FETCH_ASSOC);
    if ($muayeneTarihleri) {
        // Linkleri oluştur
        $links = [];
        foreach ($muayeneTarihleri as $row) {
            $muayeneTarihi = $row['muayene_tarihi'];
            $links[] = "<a href='muayene-bilgileri.php' class='column-box'>" . htmlspecialchars($muayeneTarihi) . "</a>";
        }
        // Linkleri oturum değişkenine kaydet
        $_SESSION['muayene_links'] = $links;
    } else {
        $_SESSION['error'] = "Muayene bilgisi bulunamadı.";
    }

}
?>
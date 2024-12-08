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
            $kullanici_id = $kullanici['kullanici_id'];
            $is_employee = $kullanici['personel_mi'];
            $_SESSION['userName'] = $kullanici['isim'];
            $_SESSION['userSurname'] = $kullanici['soyisim'];
            $_SESSION['userPhone'] = $kullanici['telefon'];
            $_SESSION['email'] = $kullanici['email'];
            $_SESSION['birth_date'] = $kullanici['dogum_tarihi'];
            $_SESSION['birth_city'] = $kullanici['dogum_sehri'];
            $_SESSION['gender'] = $kullanici['cinsiyet'];
            $_SESSION['tckn'] = $kullanici['tckn'];

            // Çerez işlemlerini kontrol et 
            /* Çerez işlemlerini en son ekle
            if(isset($_POST[''])) {

            }
            else {

            }
            */

            if ($is_employee == 1) {
                
                //hasta bilgilerini getir
                get_hastabilgileri($dbConnection, $kullanici_id);
                
                // Personel bilgilerini getir
                get_personelbilgileri($dbConnection, $kullanici_id);
                
                // Perosnel sayfasına yönlendir
                header("Location:../html/main-page.php?is_employee=1");
            } 
            else {
                // Kullanıcı verilerini al ve anasayfaya yönlendir
                get_hastabilgileri($dbConnection, $kullanici_id);
                get_yakinakraba($dbConnection, $kullanici_id);

                echo "<script>alert('Kullanıcı verileri çekildi, ana sayfaya yönlendirilecek')</script>";
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

function get_hastabilgileri($db, $id)
{
    // Sql tablosundan verileri çek
    $sqlQuery_hastabilgileri = $db->prepare(
        "SELECT * FROM hastabilgileri WHERE kullanici_id = $id"
    );

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

function get_yakinakraba($db, $id)
{
    // Sorgu
    $sqlQuery_yakinakraba = $db->prepare(
        "SELECT * FROM yakinakraba WHERE kullanici_id = $id"
    );

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

function get_personelbilgileri($db, $id){
    // Sorgu
    $sqlQuery_personelbilgileri = $db->prepare(
        "SELECT * FROM personelbilgileri WHERE kullanici_id = $id"
    );

    // Sorgu snucunu getir
    $personelbilgileri = $sqlQuery_personelbilgileri->fetch(PDO::FETCH_ASSOC);
    if($personelbilgileri) {
      $_SESSION['job'] = $personelbilgileri['gorev'];
      $_SESSION['expertis'] = $personelbilgileri['uzmanlik'];
      $_SESSION['branch'] = $personelbilgileri['brans'];
      $_SESSION['hospitalName'] = $personelbilgileri['hastane_adi'];
      $_SESSION['policlinik'] = $personelbilgileri['poliklinik'];
      $_SESSION['employeeID'] = $personelbilgileri['personel_id'];
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

?>
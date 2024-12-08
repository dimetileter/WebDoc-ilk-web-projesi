<?php    
    session_start();
    header('Content-Type: text/html; charset=UTF-8');
    require_once "../database/database-connection.php";

    // Eğer butona tıklanmışsa 
    if (isset($_POST['registerButton'])) {

        /* //verilerin alınıp alınmadığını kontrol et
        $required_fields = ['_name', 'surname', 'phone', 'email', 'birth_date', 'birth_city', 'select_gender', 'tckn'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                die("Hata: $field alanı zorunludur.");
            }
            else {
                header("Location:../html/welcome-page.php?state=2");
            }
        }
        */
        

        // Veri tabanına bağlanmışsa
        if($dbConnection) {
            try {
                // Genel kullanıcı bilgilerini önce ekle
                $query_for_general = $dbConnection->prepare(
                    "INSERT INTO kullanici SET
                    tckn = :tckn,
                    isim = :_name,
                    soyisim = :surname,
                    telefon = :phone,
                    email = :email,
                    dogum_tarihi = :birth_date,
                    dogum_sehri = :birth_city,
                    cinsiyet = :gender,
                    personel_mi = :personel_mi"
                );

                /*
                    '_name' => "test",
                    'surname' => "test",
                    'phone' => "000000",
                    'email' => "test@gmail.com",
                    'birth_date' => "01.01.0001",
                    'birth_city' => "city",
                    'gender' => "Erkek",
                    'tckn' => "0000000000",
                    'personel_mi' => 0
                    
                */

                $result_for_general = $query_for_general->execute([
                    'tckn' => $_POST['register_tckn'],
                    '_name' => $_POST['userName'],
                    'surname' => $_POST['userSurname'],
                    'phone' => $_POST['phone'],
                    'email' => $_POST['email'],
                    'birth_date' => $_POST['birth_date'],
                    'birth_city' => $_POST['birth_city'],
                    'gender' => $_POST['select_gender'],
                    'personel_mi' => ($_POST['select_status'] == 'personel') ? 1 : 0,
                ]);
    
                // Form verilerinin boş gödnerilmemsi sorunu çözülene kadar kapalı tutulacak
                if (isset($_POST['select_status']) && $_POST['select_status'] == "personel") {
                    // Personel bilgilerini ekle
                    $query_for_personel = $dbConnection->prepare(
                        "INSERT INTO personelbilgileri SET
                        tckn = :tckn,
                        gorev = :select_job,
                        uzmanlik = :select_expertis,
                        brans = :select_branch,
                        hastane_adi = :hospital_name,
                        poliklinik = :select_policlinic,
                        personel_kimligi = :employee_id"
                    );

                    $query_for_personel->execute([
                        'tckn' => $_POST['register_tckn'],
                        'select_job' => $_POST['select_job'],
                        'select_expertis' => $_POST['select_expertis'],
                        'select_branch' => $_POST['select_branch'],
                        'hospital_name' => $_POST['hospital_name'],
                        'select_policlinic' => $_POST['select_policlinic'],
                        'employee_id' => $_POST['employee_id']
                    ]);
                } else if (isset($_POST['select_status']) && $_POST['select_status'] == "hasta") {
                    // Hasta bilgilerini ekle
                    $query_for_hasta = $dbConnection->prepare(
                        "INSERT INTO hastabilgileri SET
                        tckn =:tckn,
                        kan_grubu =:select_blood_type,
                        boy =:_height,
                        kilo =:_weight,
                        kronik_hastalik1 =:cronic_disease1,
                        kronik_hastalik2 =:cronic_disease2,
                        kronik_hastalik3 =:cronic_disease3"
                    );
    
                    $query_for_hasta->execute([
                        'tckn' => $_POST['register_tckn'],
                        'select_blood_type' => $_POST['select_blood_type'],
                        '_height' => $_POST['_height'],
                        '_weight' => $_POST['_weight'],
                        'cronic_disease1' => $_POST['cronic_disease1'],
                        'cronic_disease2' => $_POST['cronic_disease2'],
                        'cronic_disease3' => $_POST['cronic_disease3']
                    ]);
    
                    // Yakın akraba bilgilerini ekle
                    $query_for_relative = $dbConnection->prepare(
                        "INSERT INTO yakinakraba SET
                        tckn = :tckn,
                        akraba_ismi =:close_relative_name,
                        akraba_soyismi =:close_relative_surname,
                        akraba_telefon =:close_relative_phone"
                    );
    
                    $query_for_relative->execute([
                        'tckn' => $_POST['register_tckn'],
                        'close_relative_name' => $_POST['close_relative_name'],
                        'close_relative_surname' => $_POST['close_relative_surname'],
                        'close_relative_phone' => $_POST['close_relative_phone']
                    ]);
                }
    
                // Veri tabanı kaydı başarılı ise state=1 değerini alsın
                header("Location:../html/welcome-page.php?state=1");
                exit;
    
            } catch (Exception $e) {
                // Hataları terminalde yazdır
                echo "Hata: " . $e->getMessage() . PHP_EOL;
                echo "Dosya: " . $e->getFile() . PHP_EOL;
                echo "Satır: " . $e->getLine() . PHP_EOL;
                $hata = $e->getMessage();
                echo "<script>alert($hata);</script>";

            }
        }
        else {
            // Veri tabanına bağlanmazsa state=0 döndür.
            header("Location:../html/welcome-page.php?state=0");
            exit;
        }
    }
    else {
        echo "<script>alert('sayfa butonsuz çalıştı. İf bloğuna girilmedi');</script>";
    }
?>

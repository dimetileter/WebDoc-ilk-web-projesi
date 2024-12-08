<?php 
    session_start(); 
    header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="tr">
<title>Kayıt Ol</title>

<head>
    <link rel="stylesheet" type="text/css" href="../css/login-signin-style.css">
    <meta charset="UTF-8">
    <style>
        body {
            background-color: #1D271C;
            flex-direction: column;
            height: auto;
            max-height: 100vh;
            margin: 0px;
            padding: 30px;
        }

        body * {
            z-index: 2;
        }

        div {
            width: 100%;
            height: auto;
            text-align: center;
        }

        footer {
            width: 100%;
            height: auto;
            padding: 5px;
        }

        form input,
        select {
            width: 200px;
            height: 25px;
            border: none;
            border-radius: 4px;
            align-items: center;
            margin: 4px 4px;
            padding: 0px 5px;
        }

        form select {
            width: 210px;
        }
    </style>
</head>

<body>

    <img class="background-image" src="../images/Vector.png" height="300px">

    <!--Menü-->
    <nav id="signinpage-top-bar">
        <div class="left-links">
            <a href="../html/welcome-page.php" style="font-weight: bolder;" title="welcome page">WebDoc</a>
            <span></span>
            <a href="#" title="hakkımızda">Hakkımızda</a>
            <span></span>
            <a href="#" title="Hizmet verilen kurumlar">Hizmet Verilen Kurumlar</a>
        </div>
        <div class="right-links">
            <a href="#" title="iletişim">İletişim</a>
            <span></span>
            <a href="#" title="kişisel verilerin korunumu kanunu">KVKK</a>
            <span></span>
            <a href="#" title="sık sorulan sorular">SSS</a>
        </div>
    </nav>

    <br>
    <br>
    <form action="../database/save-register.php" method="post">
        <!--Karşılama mesajları ve seçiçi-->
        <div style="padding: 30px 0px; margin-top:45px;">
            <h style="font-size: 30px; color: white; font-family: 'Konkhmer Sleokchher';">Bir Hesap Oluşturun</h>
            <br>
            <select id="select_status" name="select_status" class="select-status" onchange="loadDynamicContent()" required>
                <option disabled selected value="">Kullanıcı seçimi</option>
                <option value="hasta">Hasta</option>
                <option value="personel">Personel</option>
            </select>
        </div>

        <!--Genel bilgiler-->
        <div>
            <input type="tex" placeholder="Ad" name="userName" title="ad" required>
            <input type="tex" placeholder="Soyad"  name="userSurname" title="soyad" required>
            <input type="number" placeholder="Telefon" name="phone" title=" numarası" required>
            <input type="email" placeholder="E-mail" title="email adresi" required>
            <br>
            <input type="date" id="birth_date" name="birth_date" title="doğum tarihi" required>
            <input type="text" placeholder="Doğduğu şehir" name="birth_city" title="doğduğu şehir" required>
            <select id="select_gender" name="select_gender" title="cinsiyet" required>
                <option value="" disabled selected>Cinsiyet</option>
                <option value="Erkek">Erkek</option>
                <Option value="Kadın">Kadın</Option>
            </select>
            <input type="number" placeholder="T.C. Kimlik no" name="register_tckn" title="Türkiye Cumhuriyeti kimlik numarası" required>
            <hr>

             <!-- Dinamik Alan -->
            <div id="dynamic_fields"></div>

            <!--Giriş butonu ve sözleşmeler-->
            <div style="margin-top: 130px;">
                <p style="font-weight: bold;" class="link">KVKK, Gizlilik sözleşmesi ve Bilgi işlemleri okudum kabul ediyorum.</p>
                <br>
                <button type="submit" class="kayit-buton" name="registerButton" title="kaydol">KAYDOL</button>
            </div>
        </div>
    </form>
    <br>
    <footer>
        <!--Şikayer öneri ve yardım-->
        <p class="link" style="text-align: left;">Şikayet ve Öneri</p>
        <div class="helper">?</div>
    </footer>

    <script>
        function loadDynamicContent() {
            const selectStatus = document.getElementById("select_status").value;
            const dynamicFields = document.getElementById("dynamic_fields");

            // İçeriği temizle
            dynamicFields.innerHTML = "";

            // HTML dosyasını yükle
            let url = "";
            if (selectStatus === "hasta") {
                url = "../sign-in-forms/hasta-girdileri.html";
            } else if (selectStatus === "personel") {
                url = "../sign-in-forms/personel-girdileri.html";
            }

            // Fetch API ile içerik yükleme
            if (url) {
                fetch(url)
                    .then(response => {
                        if (!response.ok) throw new Error("HTML dosyası yüklenemedi");
                        return response.text();
                    })
                    .then(html => {
                        dynamicFields.innerHTML = html;
                    })
                    .catch(error => console.error("Hata:", error));
            }
        }
    </script>

</body>
</html>
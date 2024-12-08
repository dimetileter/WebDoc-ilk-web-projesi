<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/login-signin-style.css">
    <title>WebDoc Login</title>
    <style>
        body {
            background-image: url(../images/background.webp);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            margin: 0px;
            height: 100%;
        }
    </style>
</head>

<body>
    <!--Top nav bar-->
    <nav id="mainpage-top-bar">
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
            <a href="#" title="sık sorularn sorular">SSS</a>
        </div>
    </nav>

    <!--Login Form-->
    <div id="logindiv">
        <h4>Hoş Geldiniz</h4>
        <hr style="border: none; background-color: black; height: 1px;">
        <form action="../database/read-user.php" method="post">
            <table style="margin: 5px auto">
                <!--1.Satır giriş metni-->
                <tr>
                    <td>
                        <p style="color: black;">Giriş yapın veya hesap oluşturun</p>
                    </td>
                </tr>
                <!--2.Satır email girişi-->
                <tr>
                    <td>
                        <input class="textForm" type="email" placeholder="E-mail" name="txtEmail"><br>
                    </td>
                </tr>
                <!--3.Satır şifre girişi-->
                <tr>
                    <td>
                        <input class="textForm" type="number" placeholder="T.C." name="txtTC"><br>
                    </td>
                </tr>
                <!--4.Satır giriş ve kayıt butonları-->
                <tr>
                    <!--Giriş-Kaydol butonları-->
                    <td style="text-align: center;">
                        <button type="submit" title="giriş" name="btnLogin">Giriş</button>
                        <a href="../html/signin-page.php"><button type="button" title="kaydol">Kaydol</button></a>
                    </td>
                </tr>
            </table>
            <p style="color: white;">Şifremi unuttum</p>
        </form>
        <hr style="border: none; background-color: black; height: 1px;"><br>
        <p style="color: white; margin: auto; text-shadow: 0px 5px 5px rgb(0, 0, 0) ;">Neden hesap oluşturmalıyım?</p>
    </div>

    <?php
        if(isset($_GET['state']) && $_GET['state'] == 1) {
            echo "<script>alert('Kayıt başarılı! Hesabınıza erişmek için bilgileriniz ile giriş yapın');</script>";
        }
        elseif(isset($_GET['state']) && $_GET['state'] == 0) {
            echo "<script>alert('Kayıt başarısız! Kayıt esnasında bir sorun meydana geldi');</script>";
        }
        else if(isset($_GET['state']) && $_GET['state'] == 2) {
            echo "<script>
                    alert('Form verileri gönderildi:\\n" .
                    "İsim: " . $_POST['_name'] . "\\n" .
                    "Soyisim: " . $_POST['surname'] . "\\n" .
                    "Telefon: " . $_POST['phone'] . "\\n" .
                    "Email: " . $_POST['email'] . "\\n" .
                    "Doğum Tarihi: " . $_POST['birth_date'] . "\\n" .
                    "Doğum Şehri: " . $_POST['birth_city'] . "\\n" .
                    "Cinsiyet: " . $_POST['select_gender'] . "\\n" .
                    "TCKN: " . $_POST['tckn'] . "\\n" .
                    "Personel Mi?: " . (isset($_POST['personel']) ? 'Evet' : 'Hayır') . "'
                    );
                </script>
            ";
        }
    ?>

</body>

</html>
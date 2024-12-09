<?php header('Content-Type: text/html; charset=utf-8');
session_start(); 
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <title>Muayeneler</title>
    <link rel="stylesheet" type="text/css" href="../css/main-page-styles.css">
    <meta charset="UTF-8">
    <style>
        body {
            padding: 0px;
            margin: 0px;
            height: 100px;
            height: 100vh;
            float: left;
        }
    </style>
</head>

<body>
    <!--Muayene sonuç menüsü-->
    <nav class="nav-bar">
        <a href="#" style="font-weight: bolder;">WebDoc</a>
        <span></span>
        <a href="#" title="hasta bilgilerini görüntüle">Hasta bilgileri</a>
        <span></span>
        <a href="#" title="muayene ilaçlarını görüntüle">İlaçlar</a>
        <span></span>
        <a href="#" title="muayene teşhislerini görüntüle">Teşhisler</a>
        <span></span>
        <a href="#" title="gözlük reçetelerini görüntüle">Gözlük reçeteleri</a>
        <span></span>
        <a href="#" title="muayene eden personelleri görüntüle">Muayene eden kişiler</a>
        <span></span>
        <a href="#" title="yatakhane bilgilerini görüntüle">Yatakhane no</a>
        <span></span>
        <a href="#" title="geçmiş muayeneleri görüntüle">Muayene bilgileri</a>
        <span></span>
        <a href="#">Muayene kayıt</a>
    </nav>

    <!--Yan panel-->
    <div class="side-bar">
        <?php 
            // Eğer kullanıcı personelse personel sasyfası verilerini getir değilse hasta bilgilerini getir
            if(isset($_GET['is_employee']) && $_GET['is_employee'] == 1) {
                include("../main-page-links/personel-sidebar.php");
            }
            else if(isset($_GET["is_employee"]) && $_GET["is_employee"] == 0) {
                include("../main-page-links/hasta-sidebar.php");
            }
            else{
                echo "<h2 style='text-align: center; margin: auto;'>Sayfa yüklenirken hata oluştu!</h2>";
            }
        ?>
        
        
        <a href="../database/exit.php" class="exit">Çıkış</a>
    </div>

    <!--Bilgi kısmı-->
    <div class="information-title">
        <h2>Nasıl Kullanırım?</h2>
        <p>
            Kişisel bilgileriniz için üst panelden “Hasta Bilgileri” kısmına tıklayınız.
            Diğer hastalık bilgileriniz için yukarıdaki barı ya da sol tarafta yer alan geçmiş muayenelerinizi tıklamayı
            deneyin.
            Eğer personel değilseniz muayene kayıt sayfasına erişemezsiniz.
        </p>
    </div>

    <!--Ana içerik-->
    <div class="content-display">

        <?php 
            // Eğer kullanıcı personelse personel sasyfası verilerini getir değilse hasta bilgilerini getir
            if(isset($_GET['is_employee']) && $_GET['is_employee'] == 1) {
                include("../main-page-links/personel-bilgileri.php");
            }
            else if(isset($_GET["is_employee"]) && $_GET["is_employee"] == 0) {
                include("../main-page-links/hasta-bilgileri.php");
            }
            else{
                echo "<h2 style='text-align: center; margin: auto;'>Sayfa yüklenirken hata oluştu!</h2>";
            }
        ?>
    </div>

    <!--İletişim - Şikayet ve geri bildirim-->
    <footer>
        <p>İletişim</p>
        <p>Şikayet ve Öneri</p>
    </footer>
</body>

</html>
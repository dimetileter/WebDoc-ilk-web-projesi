<?php header('Content-Type: text/html; charset=utf-8');
session_start(); 
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <title>Muayeneler</title>
    <link rel="stylesheet" type="text/css" href="../css/main-page-styles.css">
    <script language="javascript" src="../javascript/page-loader.js"></script>
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
        <a href="main-page.php" style="font-weight: bolder;">WebDoc</a>
        <span></span>
        <a href="../database/muayene-kayit.php" title="hasta bilgilerini görüntüle">Hasta bilgileri</a>
        <span></span>
        <a href="../database/ilaclar.php" title="muayene ilaçlarını görüntüle">İlaçlar</a>
        <span></span>
        <a href="../database/teshisler.php" title="muayene teşhislerini görüntüle">Teşhisler</a>
        <span></span>
        <a href="../database/gozluk.php" title="gözlük reçetelerini görüntüle">Gözlük reçeteleri</a>
        <span></span>
        <a href="../database/yatakhane.php" title="yatakhane bilgilerini görüntüle">Yatakhane</a>
        <span></span>
        <a href="../database/muayene-kayit.php">Muayene kayıt</a>
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
            else if(isset($_GET['nulltckn']) && $_GET['nulltckn'] == 1) {
                include("../main-page-links/personel-sidebar.php");
            }
            else if(isset($_GET['ilac']) || isset($_GET['tani']) || isset($_GET['gozluk']) || isset($_GET['yatis'])) {
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
            else if(isset($_GET['nulltckn']) && $_GET['nulltckn'] == 1) {
                echo "<script>alert('Hata T.C. kimlik numarası boş bırakılamaz!');</script>";
                include("../main-page-links/personel-bilgileri.php");
            }
            else if(isset($_GET['ilac'])) {
                include("../main-page-links/ilaclar-table.php");
            }
            else if(isset($_GET['tani'])) {
                include("../main-page-links/teshisler-table.php");
            }
            else if(isset($_GET['gozluk'])) {
                include("../main-page-links/gozluk-table.php");
            }
            else if(isset($_GET['yatis'])) {
                include("../main-page-links/yatis-table.php");
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
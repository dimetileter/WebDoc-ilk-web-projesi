<?php
    // verileri getir
    session_start();
    // Getirilen verileri temizle
    session_destroy();
    // Çıkış yapıldıktan sonra giriş sayfasına yönlendir
    header("Location:../html/welcome-page.php");
?>
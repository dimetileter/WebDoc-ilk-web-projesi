<?php
    try{
        $hostName = "localhost";
        $dbName = "final_projesi";
        $userName = "root";
        $password = "12345678";
        $dbConnection = new PDO("mysql:host=$hostName;dbname=$dbName", $userName, $password);

        // echo "<script>alert('Veri tabanına bağlandı');</script>";

    }
    catch(Exception $e){
        echo $e->getMessage();
        echo "<script>alert('Veri tabanına bağlanılmamadı!');</script>";
    }

?>
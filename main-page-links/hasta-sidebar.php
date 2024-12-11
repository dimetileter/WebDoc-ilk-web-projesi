<h3>Muayeneler</h3>
<?php
    if (isset($_SESSION['muayene_links']) && is_array($_SESSION['muayene_links'])) {
        foreach ($_SESSION['muayene_links'] as $link) {
            echo $link;
        }
    } 
    else {
        echo "<p style='text-align: center; padding: 0px 14px;'>Muayene geçmişleriniz oluşturulduğunda burada görünecek.
        Geçmiş muayene kaydınız yok.</p>";
    }
?>
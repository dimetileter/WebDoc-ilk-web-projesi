<?php
session_start();
if (isset($_SESSION['ilaclar']) && is_array($_SESSION['ilaclar'])) {
    echo "<table class='information-table'>";
    echo "<thead><tr><th>İlaç Adı</th><th>İlaç Açıklaması</th><th>Tedavi Uygulaması</th><th>Reçete Tarihi</th></tr></thead><tbody>";
    foreach ($_SESSION['ilaclar'] as $ilac) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($ilac['ilac_adi']) . "</td>";
        echo "<td>" . htmlspecialchars($ilac['ilac_aciklamasi']) . "</td>";
        echo "<td>" . htmlspecialchars($ilac['tedavi_ettigi_hastalik']) . "</td>";
        echo "<td>" . htmlspecialchars($ilac['muayene_tarihi']) . "</td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
} else {
    echo "İlaç bilgisi bulunamadı.";
}
?>

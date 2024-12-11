<?php
session_start();

if (isset($_SESSION['tanilar']) && is_array($_SESSION['tanilar'])) {
    echo "<table class='information-table'>";
    echo "<thead><tr><th>Tanı</th><th>Tanı Açıklaması</th><th>Personel adı</th><th>Personel Soyadı</th><th>Muayene tarihi</th></tr></thead><tbody>";

    foreach ($_SESSION['tanilar'] as $tanilar) {
        $personel_tckn = $tanilar['personel_tckn'];
        $personel = $_SESSION['personel'][$personel_tckn] ?? ['isim' => '-', 'soyisim' => '-'];

        echo "<tr>";
        echo "<td>" . htmlspecialchars($tanilar['tani']) . "</td>";
        echo "<td>" . htmlspecialchars($tanilar['tani_aciklamasi']) . "</td>";
        echo "<td>" . htmlspecialchars($personel['isim']) . "</td>";
        echo "<td>" . htmlspecialchars($personel['soyisim']) . "</td>";
        echo "<td>" . htmlspecialchars($tanilar['muayene_tarihi']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Tanı bilgisi bulunamadı.";
}

<?php
session_start();

if (isset($_SESSION['yatis']) && is_array($_SESSION['yatis'])) {
    echo "<table class='information-table'>";
    echo "<thead><tr><th>Blok</th><th>Kat</th><th>Oda</th><th>Personel adı</th><th>Personel soyadı</th><th>Yatısş tarihi</th></tr></thead><tbody>";

    foreach ($_SESSION['yatis'] as $yatis) {
        $personel_tckn = $yatis['personel_tckn'];
        $personel = $_SESSION['personel'][$personel_tckn] ?? ['isim' => '-', 'soyisim' => '-'];

        echo "<tr>";
        echo "<td>" . htmlspecialchars($yatis['blok']) . "</td>";
        echo "<td>" . htmlspecialchars($yatis['kat']) . "</td>";
        echo "<td>" . htmlspecialchars($yatis['oda']) . "</td>";
        echo "<td>" . htmlspecialchars($personel['isim']) . "</td>";
        echo "<td>" . htmlspecialchars($personel['soyisim']) . "</td>";
        echo "<td>" . htmlspecialchars($yatis['muayene_tarihi']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Tanı bilgisi bulunamadı.";
}

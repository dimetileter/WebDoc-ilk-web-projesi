<?php
session_start();

if (isset($_SESSION['gozluk']) && is_array($_SESSION['gozluk'])) {
    echo "<table class='information-table'>";
    echo "<thead><tr><th>Sol-S</th><th>Sağ-S</th><th>Sol-C</th><th>Sağ-C</th><th>Sol-A<th>Sağ-A</th><C></th><th>Muayene tarihi</th></tr></thead><tbody>";

    foreach ($_SESSION['gozluk'] as $degerler) {
        $personel_tckn = $degerler['personel_tckn'];
        $personel = $_SESSION['personel'][$personel_tckn] ?? ['isim' => '-', 'soyisim' => '-'];

        echo "<tr>";
        echo "<td>" . htmlspecialchars($degerler['sol_s']) . "</td>";
        echo "<td>" . htmlspecialchars($degerler['sag_s']) . "</td>";
        echo "<td>" . htmlspecialchars($degerler['sol_c']) . "</td>";
        echo "<td>" . htmlspecialchars($degerler['sag_c']) . "</td>";
        echo "<td>" . htmlspecialchars($degerler['sol_a']) . "</td>";
        echo "<td>" . htmlspecialchars($degerler['sag_a']) . "</td>";
        echo "<td>" . htmlspecialchars($personel['isim']) . "</td>";
        echo "<td>" . htmlspecialchars($personel['soyisim']) . "</td>";
        echo "<td>" . htmlspecialchars($degerler['muayene_tarihi']) . "</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "Tanı bilgisi bulunamadı.";
}

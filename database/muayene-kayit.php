
<?php 
if($_SESSION['personel_mi'] == 1) {
    header("Location:../html/main-page.php?is_employee=1");
    exit;
}
else {
    header("Location:../html/main-page.php?is_employee=0");
    exit;
}

?>

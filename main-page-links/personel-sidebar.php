
<!--1. kolon-->
<form class="column" style="width:200px; margin:auto;" action="../database/research-patient.php" method="post" style="margin-left:25px">
    <h3>Hasta biligleri</h3>
    <input class="column-box" name="columnbx_TC" placeholder="T.C. Giriniz" required></input>
    <p class="column-box" name="columnbx_name"><?php echo $_SESSION['cbUserName']?></p>
    <p class="column-box" name="columnbx_surname"><?php echo $_SESSION['cbUserSurname']?></p>
    <p class="column-box" name="columnbx_kan_grubu"><?php echo $_SESSION['cbBlood_type']?></p>
    <p class="column-box" name="columnbx_cd1"><?php echo $_SESSION['cbChronic_disease1']?></p>
    <p class="column-box" name="columnbx_cd2"><?php echo $_SESSION['cbChronic_disease2']?></p>
    <p class="column-box" name="columnbx_cd3"><?php echo $_SESSION['cbChronic_disease3']?></p>
    <input class="column-button" type="submit" value="Hastayı sorgula" name="researchPatient">
</form>
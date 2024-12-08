<!--Personel içeriği-->
<!--1. kolon-->
<form class="column" action="../database/research-patient.php" method="post" style="margin-left:25px">
    <h2>Hasta biligleri</h2>
    <input class="column-box" name="columnbx_TC" placeholder="T.C. Giriniz" required></input>
    <p class="column-box" name="columnbx_name"><?php echo $_SESSION['cbUserName']?></p>
    <p class="column-box"><?php echo $_SESSION['cbUserSurname']?></p>
    <p class="column-box"><?php echo $_SESSION['cbChronic_disease1']?></p>
    <p class="column-box"><?php echo $_SESSION['cbChronic_disease2']?></p>
    <p class="column-box"><?php echo $_SESSION['cbChronic_disease3']?></p>
    <input type="submit" value="Hastayı sorgula" name="researchPatient" 
        style="border-radius: 8px; background-color: white; border-radius: 8px; width: 140px;
        height: 25px;">
</form>

<form action="../database/save-patient.php" method="post" id="patient-register" style="margin-left:20px;">    
    <!--2. kolon-->
    <div class="column">
        <h2>Hasta kayıt</h2>
        <input type="text" class="column-box" name="txtDiagnosis" placeholder="Tanı">
        <input type="text" class="column-box" name="txtDiagnosisDesc" placeholder="Tanı açıklaması">
        <input type="text" class="column-box" name="txtMedicine" placeholder="İlaç adı">
        <input type="text" class="column-box" name="txtMedicineDesc" placeholder="İlaç açıklaması">
        <input type="text" class="column-box" name="txtMedicineDesc" placeholder="Tedavi ettiği hastalık">
    </div>

    <!--3. kolon-->
    <div class="column">
        <h2>Yatış Kayıt</h2>
        <select class="column-box" id="columnbx_yatıs_durumu">
            <option disable selected>Yatış</option>
            <option value="yatis_var" name="yatis_var">Yatış var</option>
            <option value="yatis_yok" name="yatis_yok">Yatış yok</option>
        </select>

        <input type="text" class="column-box" name="txtBlock" placeholder="Blok">
        <input type="text" class="column-box" name="txtFloor" placeholder="Kat">
        <input type="text" class="column-box" name="txtRoom" placeholder="Oda">
    </div>

    <!--4. kolon-->
    <div class="column">
        <h2>Gözlük kayıt</h2>
        <div class="row">
            <input class="glass-column-box" name="txtLeftS" placeholder="Sol &lt;S>">
            <input class="glass-column-box" name="txtRightS" placeholder="Sağ &lt;S>">
        </div>
        <div class="row">
            <input class="glass-column-box" name="txtLeftC" placeholder="Sol &lt;C>">
            <input class="glass-column-box" name="txtRightC" placeholder="Sağ &lt;C>">
        </div>
        <div class="row">
            <input class="glass-column-box" name="txtLeftA" placeholder="Sol &lt;A>">
            <input class="glass-column-box" name="txtRightA" placeholder="Sağ &lt;A>">
        </div>
    </div>

    <!--Kaydet butonu-->
    <div style="height:100%; padding: 5px; flex-direction:column;">
        <input type="submit" value="Hastayı Kaydet" name="btnSavePatient"
            style="border-radius: 8px; background-color: white; 
            border-radius: 8px; height: 25px; position:absolute; bottom:40px; right: 25px;
            border: solid 2px green;">
    </div>
</form>
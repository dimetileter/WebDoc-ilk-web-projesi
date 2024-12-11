<form action="../database/save-patient.php" method="post" id="patient-register" style="margin-left:20px;">    
    
    <!--Personel içeriği-->
    <div class="column">
        <h2>Personel Bilgileri</h2>
        <p class="column-box"><?php echo $_SESSION['userName'] ?></p>
        <p class="column-box"><?php echo $_SESSION['userSurname'] ?></p>
        <p class="column-box"><?php echo $_SESSION['job'] ?></p>
        <p class="column-box"><?php echo $_SESSION['expertis'] ?></p>
        <p class="column-box"><?php echo $_SESSION['branch'] ?></p>
        <p class="column-box"><?php echo $_SESSION['policlinik'] ?></p>
        <p class="column-box"><?php echo $_SESSION['employeeID'] ?></p>
    </div>

    <!--2. kolon-->
    <div class="column">
        <h2>Hasta kayıt</h2>
        <input type="text" class="column-box" name="txtDiagnosis" placeholder="Tanı" required>
        <input type="text" class="column-box" name="txtDiagnosisDesc" placeholder="Tanı açıklaması" required>
        <input type="text" class="column-box" name="txtMedicine" placeholder="İlaç adı" required>
        <input type="text" class="column-box" name="txtMedicineDesc" placeholder="İlaç açıklaması" required >
        <textarea class="column-box" name="txtMedicineIllnes" placeholder="Tedavi yöntemi" required></textarea>
    </div>

    <!--3. kolon-->
    <div class="column">
        <h2>Yatış Kayıt</h2>
        <select class="column-box" name="columnbx_yatis_durumu">
            <option disabled selected value="">Yatış</option>
            <option value="var">Yatış var</option>
            <option value="yok">Yatış yok</option>
        </select>

        <input type="text" class="column-box" name="txtBlock" placeholder="Blok">
        <input type="text" class="column-box" name="txtFloor" placeholder="Kat">
        <input type="text" class="column-box" name="txtRoom" placeholder="Oda">
    </div>

    <!--4. kolon-->
    <div class="column">
        <h2>Gözlük kayıt</h2>
        <select class="column-box" style="margin-bottom: 0px;" name="columnbx_gozluk_durumu" >
            <option disabled selected value="">Gözlük</option>
            <option value="var">Gözlük var</option>
            <option value="yok">Gözlük yok</option>
        </select>
        <table style="margin: 0px auto;">
            <tr>
                <td>
                    <input class="glass-column-box" name="txtLeftS" placeholder="Sol &lt;S>">   
                </td>
                <td>
                    <input class="glass-column-box" name="txtRightS" placeholder="Sağ &lt;S>">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="glass-column-box" name="txtLeftC" placeholder="Sol &lt;C>">
                </td>
                <td>
                    <input class="glass-column-box" name="txtRightC" placeholder="Sağ &lt;C>">
                </td>
            </tr>
            <tr>
                <td>
                    <input class="glass-column-box" name="txtLeftA" placeholder="Sol &lt;A>">
                </td>
                <td>
                <input class="glass-column-box" name="txtRightA" placeholder="Sağ &lt;A>">
                </td>
            </tr>
        </table>
    </div>

    <!--Kaydet butonu-->
    <div style="height:100%; padding: 5px; flex-direction:column;">
        <input type="submit" value="Hastayı Kaydet" name="btnSavePatient"
            style="background-color: white; border-radius: 5px; height: 20px; position:absolute; bottom:40px; right: 25px;
            border: solid 1px black; color:green;">
    </div>
</form>
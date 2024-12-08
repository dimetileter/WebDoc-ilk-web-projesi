<!--Hasta içeriği-->
<div id="patient-informations">
            <!--1. kolon-->
            <div class="column">
                <h2>Kişi Ad Soyad</h2>
                <p class="column-box" id="columnbx_name"><?php echo $_SESSION['userName']?></p>
                <p class="column-box" id="columnnbx_surname"><?php echo $_SESSION['userSurname']?></p>
                <p class="column-box" id="columnbx_TC"><?php echo $_SESSION['tckn']?></p>
                <p class="column-box" id="columnbx_brth_date"><?php echo $_SESSION['birth_date']?></p>
                <p class="column-box" id="columnbx_birth_city"><?php echo $_SESSION['birth_city']?></p>
                <p class="column-box" id="columnbx_gender"><?php echo $_SESSION['gender']?></p>
            </div>

            <!--2. kolon-->
            <div class="column">
                <h2>İletişim</h2>
                <p class="column-box" id="columnbx_telefon"><?php echo $_SESSION['userPhone']?></p>
                <p class="column-box" id="columnbx_email"><?php echo $_SESSION['email']?></p>
            </div>

            <!--3. kolon-->
            <div class="column">
                <h2>Kişisel Bilgiler</h2>
                <p class="column-box" id="columnbx_blood_type"><?php echo $_SESSION['kan_grubu']?></p>
                <p class="column-box" id="columnbx_weight"><?php echo $_SESSION['boy']?></p>
                <p class="column-box" id="columnbx_height"><?php echo $_SESSION['email']?></p>
                <p class="column-box" id="columnbx_chronic_disease1"><?php echo $_SESSION['chronic_disease1']?></p>
                <p class="column-box" id="columnbx_chronic_disease2"><?php echo $_SESSION['chronic_disease2']?></p>
                <p class="column-box" id="columnbx_chronic_disease3"><?php echo $_SESSION['chronic_disease3']?></p>
            </div>

            <!--4. kolon-->
            <div class="column">
                <h2>Yakın Akraba</h2>
                <p class="column-box" id="columnbx_close_relative_name"><?php echo $_SESSION['close_relative_name']?></p>
                <p class="column-box" id="columnbx_close_relative_surname"><?php echo $_SESSION['crelative_surname']?></p>
                <p class="column-box" id="columnbx_close_relative_phone"><?php echo $_SESSION['close_reltaive_phone']?></p>
            </div>
        </div>
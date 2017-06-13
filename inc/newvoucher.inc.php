<?php
    //Formular zum erstellen eines neuen Gutscheins.
    //Es wird ein einzigartiger Code generiert und vorausgefüllt, ausserdem werden nur zukünftige Daten als Gültigkeitdatum zugelassen.
    $voucher = new Gutschein();
    $date = new DateTime();
    $now = date_format($date,'Y-m-d');
    $newVoucherForm = '</div><br><br><br>
        <div class="col-md-6 col-md-offset-3">
        <h2>Neuen Gutschein anlegen</h2><br>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="index.php?site=gutscheineverwalten&type=1">
         
            <div class="form-group">
              <label for="vouchID" class="col-sm-2  control-label" >GutscheinCode</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" value="'.$voucher->generateCode().'" id="vouchID" name="vouchID" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="vouchWert" class="col-sm-2 control-label">Wert*</label>
              <div class="col-sm-10">
                  <input type="number" required class="form-control"  id="vouchWert" name="vouchWert" placeholder="Wert">
              </div>
            </div>
            <div class="form-group">
              <label for="vouchDate" class="col-sm-2 control-label">Datum*</label>
              <div class="col-sm-10">
                  <input type="date" required class="form-control" min="'.$now.'" id="vouchDate" name="vouchDate" placeholder="JJJJ-MM-TT">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Speichern</button>
              </div>
            </div>
          </form>
            </div>'; 
        echo $newVoucherForm;
        ?>

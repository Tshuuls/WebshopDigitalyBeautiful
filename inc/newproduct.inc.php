<?php
    $TempForm2='';
    $TempForm1 = '</div><br><br><br>
        <div class="col-md-6 col-md-offset-3">
        <h2>Neues Produkt anlegen</h2><br>
        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="index.php?site=produktebearbeiten&type=1">
         
            <div class="form-group">
              <label for="prodName" class="col-sm-2 control-label">Produktname*</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="prodName" name="prodName" placeholder="Produktname">
              </div>
            </div>
            <div class="form-group">
              <label for="prodBeschreibung" class="col-sm-2 control-label">Beschreibung*</label>
              <div class="col-sm-10">
                  <textarea required class="form-control" rows="4" id="prodBeschreibung" name="prodBeschreibung" placeholder="Produktbeschreibung"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="prodBewertung" min="0" max="5" class="col-sm-2 control-label">Bewertung</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="prodBewertung" name="prodBewertung" placeholder="Bewertung">
              </div>
            </div>
            <div class="form-group">
              <label for="prodPreis" min="0" class="col-sm-2 control-label">Preis*</label>
              <div class="col-sm-10">
                  <input type="number" required class="form-control" id="prodPreis" name="prodPreis" placeholder="Preis">
              </div>
            </div>
            <div class="form-group">
                <label for="prodPic" class="col-sm-2 control-label">Foto</label>
                <div class="col-sm-10">
                   <input type="file" name="prodPic" id="prodPic" accept="image/*">
                </div>
            </div>
            <div class="form-group">
              <label for="prodKat" class="col-sm-2 control-label">Kategorie</label>
              <div class="col-sm-10">
                  <select class="form-control" id="prodKat" name="prodKat">'; 
                    $db = new Database();
                    $katelist = $db->getallkat();
                    foreach($katelist as $kat){
                    $TempForm2 = $TempForm2 . "<option value=".$kat->getKategorieid().">" . $kat->getBezeichnung() . "</option>";
                    }
                    $registerForm2 = $TempForm1 . $TempForm2 . '
                  </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Speichern</button>
              </div>
            </div>
          </form>
            </div>'; 
        echo $registerForm2;
        ?>

<div class="col-md-7 col-md-offset-2">
        <form class="form-horizontal" method="POST" action="index.php?site=Home&register=true">
            
            <label class="radio-inline" style="text-align: center">
                <input type="radio" name="registergender" id="inlineRadio1" value="Frau" checked> Frau
              </label>
              <label class="radio-inline" style="text-align: center">
                <input type="radio" name="registergender" id="inlineRadio2" value="Herr"> Herr
              </label>
            
            <div class="form-group">
              <label for="registerVorname" class="col-sm-2 control-label">Vorname*</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="registerVorname" name="registerVorname" placeholder="Vorname">
              </div>
            </div>
            <div class="form-group">
              <label for="registerNachname" class="col-sm-2 control-label">Nachname*</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="registerNachname" name="registerNachname" placeholder="Nachname">
              </div>
            </div>
            <div class="form-group">
              <label for="registerAdresse" class="col-sm-2 control-label">Adresse</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="registerAdresse" name="registerAdresse" placeholder="Adresse">
              </div>
            </div>
            <div class="form-group">
              <label for="registerPLZ" class="col-sm-2 control-label">PLZ</label>
              <div class="col-sm-10">
                  <input type="number" class="form-control" id="registerPLZ" name="registerPLZ" placeholder="PLZ">
              </div>
            </div>
            <div class="form-group">
              <label for="registerOrt" class="col-sm-2 control-label">Ort</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="registerOrt" name="registerOrt" placeholder="Ort">
              </div>
            </div>
            <div class="form-group">
              <label for="registerEmail" class="col-sm-2 control-label">Email*</label>
              <div class="col-sm-10">
                  <input type="email" required class="form-control" id="registerEmail" name="registerEmail" placeholder="Email">
              </div>
            </div>
            <hr>
            <fieldset class="form-group" >
            <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="optionsRadios" onClick="Kontonummer()" id="optionsRadios1" value="option1" checked>
                  Kontonummer
                </label>
             </div>
            <div class="form-check">
                <label class="form-check-label">
                  <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" onClick="KreditKarte()" >
                  Kreditkarte
                </label>
              </div>
            </fieldset>
            <div class="form-group" style=" display:inline" id="registerKontonummerDIV">
              <label for="registerKontonummer" class="col-sm-2 control-label">Kontonummer</label>
              <div class="col-sm-10">
                  <input type="number"  class="form-control" id="registerKontonummer" name="registerKontonummer" placeholder="Kontonummer">
              </div>
            </div>
            
            <div class="form-group" style=" display:none" id="registerKreditkartennummerDIV">
              <label for="registerKreditkartennummer" class="col-sm-2 control-label">Kreditkartennummer</label>
              <div class="col-sm-10">
                  <input type="number"  class="form-control" id="registerKreditkartennummer" name="registerKreditkartennummer" placeholder="Kreditkartennummer">
              </div>
            </div>
            
            <div class="form-group" style=" display:none" id="registerAblaufdatumDIV">
              <label for="registerAblaufdatum" class="col-sm-2 control-label">Ablaufdatum</label>
              <div class="col-sm-10">
                  <input type="date"  class="form-control" id="registerAblaufdatum" name="registerAblaufdatum" >
              </div>
            </div>
            <hr>
            
            
            <div class="form-group">
              <label for="registerBenutzername" class="col-sm-2 control-label">Benutzername*</label>
              <div class="col-sm-10">
                  <input type="text" required class="form-control" id="registerBenutzername" name="registerBenutzername" placeholder="Benutzername">
              </div>
            </div>
            <div class="form-group">
              <label for="registerPasswort" class="col-sm-2 control-label">Passwort*</label>
              <div class="col-sm-10">
                  <input type="password" required pattern=".{5,15}" class="form-control" id="registerPasswort" name="registerPasswort" placeholder="Passwort">
              </div>
            </div>
            <div class="form-group">
              <label for="registerPasswort2" class="col-sm-2 control-label">Passwort wiederholen*</label>
              <div class="col-sm-10">
                  <input type="password" required pattern=".{5,15}" class="form-control" id="registerPasswort2" name="registerPasswort2" placeholder="Passwort">
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Registrieren</button>
              </div>
            </div>
          </form>
            </div>
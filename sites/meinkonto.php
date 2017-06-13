
<?php
 // put your code here
   $user = new User();   
   $db= new Database();
   $user->setUserID($_SESSION['userID']);
   $userInfo=$user->selectOneUser();
   $check=false;
   //check altes passwort gegen Datenbank
   if(isset($_POST['altesPasswort'])){
    
       if(password_verify (  $_POST['altesPasswort'],$userInfo->getPasswort() )==true){
       $check=true;
        }else{
       echo "<div class='alert alert-danger col-md-6 col-md-offset-3'> Passwort inkorrekt </div>";
       
       }
   
    }
    
    //überprüfen ob stammdatenform gesendet wurde
   if (!empty($_POST['registerVorname'])&& $check==true){
       
        //Anrede festsetzen
        if(!empty($_POST['registergender'])&& $_POST['registergender']=="Frau"){
            $anrede="Frau";
        }else{
            $anrede= "Herr";
        }
        //überprüfen ob neues Passwort angegeben
        if(!empty($_POST['registerPasswort'])&&!empty($_POST['registerPasswort2'])){
            //überprüfen ob neue passwörter übereinstimmen
            if($_POST['registerPasswort']===$_POST['registerPasswort2']){
                $passwordHashed = password_hash((String)$_POST['registerPasswort'], PASSWORD_DEFAULT);

                $user->addAllValues($_SESSION['userID'], $anrede, secureString($_POST['registerVorname']), secureString($_POST['registerNachname']), secureString($_POST['registerAdresse']),
                    $_POST['registerPLZ'], secureString($_POST['registerOrt']), secureString($_POST['registerEmail']),'0', secureString($_POST['registerBenutzername']), $passwordHashed, '0');

                
                $user->updateUser();
                echo "<div class='alert alert-success col-md-6 col-md-offset-3'> Änderung erfolgreich</div>";
            }else{
                echo "<div class='alert alert-danger col-md-6 col-md-offset-3'> neue Passwörter stimmen nicht überein </div>";
            }   
       }else{//Kein neues passwort angegeben
           $passwordHashed = password_hash((String)$_POST['altesPasswort'], PASSWORD_DEFAULT);
           $user->addAllValues($_SESSION['userID'], $anrede, secureString($_POST['registerVorname']), secureString($_POST['registerNachname']), secureString($_POST['registerAdresse']),
                $_POST['registerPLZ'], secureString($_POST['registerOrt']), secureString($_POST['registerEmail']),'0', secureString($_POST['registerBenutzername']), $passwordHashed, '0');

           $user->updateUser();
            echo "<div class='alert alert-success col-md-6 col-md-offset-3'> Änderung erfolgreich </div>";
       }
   
   
    }
    //Überprüfen ob ZahlungsinformationForm gesendet
   if (!empty($_POST['Kontonummer'])&& $check==true){
       $queue="UPDATE `bezahldaten` SET `Kontonummer`='".$_POST['Kontonummer']."'WHERE `BezahldatenID` ='".$_POST['BezahldatenID']."'";
       echo $queue;
       $ergebniss=$db->update($queue);
   }else if (!empty($_POST['Kreditkartennummer'])){
       $queue="UPDATE `bezahldaten` SET `Kreditkartennummer`='".$_POST['Kreditkartennummer']."',`Ablaufdatum`='".$_POST['Ablaufdatum']."' WHERE `BezahldatenID` ='".$_POST['BezahldatenID']."'";
       $ergebniss=$db->update($queue);
   }
   
   
   
   
        
     //StammdatenForm-----------------------------------   
        echo '<div class="col-md-7 col-md-offset-2"><h2>Stammdaten</h2>
        <form class="form-horizontal" method="POST" action="index.php?site=meinkonto">
            ';
        if ($userInfo->getAnrede()=='Frau'){
            echo'
            <label class="radio-inline" style="text-align: center">
                <input type="radio" name="registergender" id="inlineRadio1" value="Frau" checked> Frau
              </label>
              <label class="radio-inline" style="text-align: center">
                <input type="radio" name="registergender" id="inlineRadio2" value="Herr"> Herr
              </label>';
        }else{
            echo'
            <label class="radio-inline" style="text-align: center">
                <input type="radio" name="registergender" id="inlineRadio1" value="Frau" > Frau
              </label>
              <label class="radio-inline" style="text-align: center">
                <input type="radio" name="registergender" id="inlineRadio2" value="Herr" checked> Herr
              </label>';
        }
        
        echo'  
            <div class="form-group">
              <label for="registerVorname" class="col-sm-2 control-label">Vorname</label>
              <div class="col-sm-10">
                  <input type="text"  class="form-control" id="registerVorname" name="registerVorname" value="'.$userInfo->getVorname().'">
              </div>
            </div>
            <div class="form-group">
              <label for="registerNachname" class="col-sm-2 control-label">Nachname</label>
              <div class="col-sm-10">
                  <input type="text"  class="form-control" id="registerNachname" name="registerNachname" value="'.$userInfo->getNachname().'">
              </div>
            </div>
            <div class="form-group">
              <label for="registerAdresse" class="col-sm-2 control-label">Adresse</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="registerAdresse" name="registerAdresse" value="'.$userInfo->getAdresse().'">
              </div>
            </div>
            <div class="form-group">
              <label for="registerPLZ" class="col-sm-2 control-label">PLZ</label>
              <div class="col-sm-10">
                  <input type="number" class="form-control" id="registerPLZ" name="registerPLZ" value="'.$userInfo->getPLZ().'">
              </div>
            </div>
            <div class="form-group">
              <label for="registerOrt" class="col-sm-2 control-label">Ort</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="registerOrt" name="registerOrt" value="'.$userInfo->getOrt().'">
              </div>
            </div>
            <div class="form-group">
              <label for="registerEmail" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                  <input type="email"  class="form-control" id="registerEmail" name="registerEmail" value="'.$userInfo->getEmail().'">
              </div>
            </div>
            
            <div class="form-group">
              <label for="registerBenutzername" class="col-sm-2 control-label">Benutzername</label>
              <div class="col-sm-10">
                  <input type="text"  class="form-control" id="registerBenutzername" name="registerBenutzername" placeholder="Benutzername" value="'.$userInfo->getBenutzerName().'">
              </div>
            </div>
            <div class="form-group">
              <label for="registerPasswort" class="col-sm-2 control-label">neues Passwort</label>
              <div class="col-sm-10">
                  <input type="password"  pattern=".{5,15}" class="form-control" id="registerPasswort" name="registerPasswort" placeholder="Passwort" ">
              </div>
            </div>
            <div class="form-group">
              <label for="registerPasswort2" class="col-sm-2 control-label">neues Passwort wiederholen</label>
              <div class="col-sm-10">
                  <input type="password"  pattern=".{5,15}" class="form-control" id="registerPasswort2" name="registerPasswort2" placeholder="Passwort" ">
              </div>
            </div>
            <div class="form-group">
              <label for="altesPasswort" class="col-sm-2 control-label">altes Passwort*</label>
              <div class="col-sm-10">
                  <input type="password" required  pattern=".{5,15}" class="form-control" id="altesPasswort" name="altesPasswort" placeholder="Passwort">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" onclick="showPopup()">Ändern</button>
              </div>
            </div>
          </form>
            </div>';
        
        //Zahlungsinformation-----------------------------
        echo "<div class='col-md-6 col-md-offset-2'><h2>Zahlungsinformation</h2>";
        echo"<table style='display: inline'  class='table striped-table'>";
        echo '<th>Zahlungsart</th><th>Nummer</th><th>Ablaufdatum</th><th>Aktion</th></tr>';
        $queue="SELECT * FROM `bezahldaten` join `user` using (`UserID`) WHERE `Benutzername` like '".$_SESSION['BN']."'";
        $ergebniss=$db->selectZahlungsArt($queue);
        foreach($ergebniss as $zeile){
                    if(!empty($zeile->getKontonummer())){
                        echo "<tr>";
                        echo "<td>Konto</td>"; 
                        echo "<td>XXX".substr($zeile->getKontonummer(),-3)."</td>"; 
                        echo "<td></td>"; 
                        echo "<td class='actiongr'> <a class='glyphicon glyphicon-pencil' href='index.php?site=meinkonto&type=2&ZID=".$zeile->getBezahlDatenID()."'></a> <a class='glyphicon glyphicon-remove' href='index.php?site=meinkonto&type=3&ZID=".$zeile->getBezahlDatenID()."'></a></td>"; 
                
                        echo "</tr>";
                    }if(!empty($zeile->getKreditkartennummer())){
                        echo "<tr>";
                        echo "<td>Kreditkarte</td>"; 
                        echo "<td>XXX".substr($zeile->getKreditkartennummer(),-3)."</td>"; 
                        echo "<td>".$zeile->getAblaufdatum()."</td>";
                        echo "<td class='actiongr'> <a class='glyphicon glyphicon-pencil' href='index.php?site=meinkonto&type=2&ZID=".$zeile->getBezahlDatenID()."'></a> <a class='glyphicon glyphicon-remove' href='index.php?site=meinkonto&type=3&ZID=".$zeile->getBezahlDatenID()."'></a></td>"; 
                
                        echo "</tr>";
                    }
                    
                }
        echo'</table></div>';
        if(isset($_GET['ZID'])){
            $queue="SELECT * FROM `bezahldaten` WHERE `BezahldatenID` = '".$_GET['ZID']."'";
        $ergebniss=$db->selectZahlungsArt($queue);
        echo'<div class="col-md-4"><form class="" method="POST" action="index.php?site=meinkonto">';
        foreach($ergebniss as $zeile){
            
            if($_GET['type']==2){//Bearbeiten
            
            if(!empty($zeile->getKontonummer())){
                echo'<div class="form-group">
                              <label for="Kontonummer" class="col-sm-4 ">Kontonummer</label>
                              <div class="col-sm-7">
                                  <input type="number" required class="form-control" id="Kontonummer" name="Kontonummer" value="'.$zeile->getKontonummer().'">
                              </div>
                            </div>';
            }if(!empty($zeile->getKreditkartennummer())){
                echo'
                    <div class="form-group">
                              <label for="Kreditkartennummer" class="col-sm-4 control-label">Kreditkartennummer</label>
                              <div class="col-sm-7">
                                  <input type="number" required class="form-control" id="Kreditkartennummer" name="Kreditkartennummer" value="'.$zeile->getKreditkartennummer().'">
                              </div>
                            </div>
                    <div class="form-group">
                              <label for="Ablaufdatum" class="col-sm-4 control-label">Ablaufdatum</label>
                              <div class="col-sm-7">
                                  <input type="date" required class="form-control" id="Ablaufdatum" name="Ablaufdatum" value="'.$zeile->getAblaufdatum().'">
                              </div>
                </div>';

            }
            }else if($_GET(['type']==3)){//Löschen
            
        } 
            echo'<input type="number" required style="display:none" class="form-control" id="BezahldatenID" name="BezahldatenID" value="'.$zeile->getBezahldatenID().'">
                <div class="form-group">
              <label for="altesPasswort" class="col-sm-4 control-label">altes Passwort*</label>
              <div class="col-sm-10">
                  <input type="password" required  pattern=".{5,15}" class="form-control" id="altesPasswort" name="altesPasswort" placeholder="Passwort">
              </div>
            </div>
                    <div class="form-group">
                          <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Ändern</button>
                          </div>
                        </div>
            </form></div>';
                
        } 
        }




//Bestellungen---------------------
        echo "<div class='col-md-9 col-md-offset-2'>";
        include './inc/BestellungensListe.inc.php';
        echo "</div>";
    
?>



        <?php
        $db = new Database();
        if(isset($_GET['GesamtPreis'])){
            //Gutschein einlösen
            if(isset($_POST['GutscheinID'])){
                    $GS = new Gutschein();
                    
                    $result=$GS->gutscheinEinlösen($_POST['GutscheinID']);
                    
            }
            //Neue bestellung erstellen   
            $bestellung =new Bestellung();
            $bestellung->adAllValues('0', $_SESSION['userID'], date("d/m/Y H:i:sa"), '0');
            
            $BSID=$bestellung->insertBestellung();
            $allProd = $db->getallproducts();
            $duplicateCount = array_count_values($_SESSION['warenkorb']);
            $pos= new Position();
            //Jedes produkt einzelnd samt anzahl in die Db einfügen
            foreach ($allProd as $prodObj){
                    if(($key = array_search($prodObj->getProduktid(), $_SESSION['warenkorb'])) !== false) {
                        $anz=$duplicateCount[$prodObj->getProduktid()];
                        $pos->insertPosition($prodObj->getProduktid(), $BSID, $anz);
                    }
                } 
            $_SESSION['warenkorb']=array();
             echo "<script>updateWarenkorbCount(".count($_SESSION['warenkorb']).")</script>";
             echo "<h1> Danke für Ihre Bestellung</h1>";
            
        }else if(!isset($_GET['bestellen'])){
            $allProd = $db->getallproducts();
            $duplicateCount = array_count_values($_SESSION['warenkorb']);
            $prodsumme=0;
            echo "<div class='col-md-8 col-md-offset-2'>";
            echo "<h2>Warenkorb</h2><br>";
            echo "<br>";
            echo "<div id='WarenkkorbDIV' class='col-sm-offset-0 col-sm-10'><form class='form-horizontal' method='POST' action='index.php?site=produktebearbeiten&type=1'></form><br></div>";
            if(!empty($_SESSION['warenkorb'])){
                echo"<table class='table striped-table'> <th>Name</th><th>Anzahl</th><th>Preis</th></tr>";
                foreach ($allProd as $prodObj){
                    if(($key = array_search($prodObj->getProduktid(), $_SESSION['warenkorb'])) !== false) {

                        echo "<tr>";

                        echo "<td>".$prodObj->getName()."</td>"; 
                        echo "<td><input type='number' min='0' onchange='ProdCounterChange(".$prodObj->getPreis().",".$prodObj->getProduktid().",this.value)' id='ProdCounter".$prodObj->getProduktid()."' value='".$duplicateCount[$prodObj->getProduktid()]."'></input></td>"; 
                        echo "<td id='ProdPreis".$prodObj->getProduktid()."'>".$prodObj->getPreis()*$duplicateCount[$prodObj->getProduktid()].".- €</td>";
                        echo "</tr>";
                        $prodsumme=$prodsumme+$prodObj->getPreis()*$duplicateCount[$prodObj->getProduktid()];
                    }
                } 
                echo "<tr style='fontweight:700'><td colspan='2'> Gesamtsumme</td><td>".$prodsumme.".- €</td><td></td></tr>";
                echo "</table>";
                echo "<a class='btn btn-default' onclick='warenkorbLöschen()' href='index.php?site=warenkorb' style ='float :left'>Warenkorb löschen</a>";

                if($_SESSION['status']!='visitor'){
                echo "<a class='btn btn-default' href='index.php?site=warenkorb&bestellen=true' style ='float :right'>Bestellen</a>";
                }else{
                echo "<a class='btn btn-default' href='index.php?site=home' style ='float :right'>Login</a>";

                }
            }

            else {
               echo "<div class='col-md-12'>";
                    echo "<div class='alert alert-danger'> Der Warenkorb ist leider leer. </div>";
               echo "</div>";
            }
        }
        
        //Bestellen------------------------------
        
        else{
            $allProd = $db->getallproducts();
            $duplicateCount = array_count_values($_SESSION['warenkorb']);
            $prodsumme=0;
            echo "<div class='col-md-8 col-md-offset-2'>";
            echo "<h2>Bestellung</h2><br>";
            echo "<br>";
            echo "<div class='col-sm-offset-0 col-sm-10'><form class='form-horizontal' method='POST' action='index.php?site=produktebearbeiten&type=1'></form><br></div>";
            if(!empty($_SESSION['warenkorb'])){
                echo"<table class='table striped-table'> <th>Name</th><th>Anzahl</th><th>Preis</th></tr>";
                foreach ($allProd as $prodObj){
                    if(($key = array_search($prodObj->getProduktid(), $_SESSION['warenkorb'])) !== false) {

                        echo "<tr>";

                        echo "<td>".$prodObj->getName()."</td>"; 
                        echo "<td>".$duplicateCount[$prodObj->getProduktid()]."</td>"; 
                        echo "<td id='ProdPreis".$prodObj->getProduktid()."'>".$prodObj->getPreis()*$duplicateCount[$prodObj->getProduktid()].".- €</td>";
                        echo "</tr>";
                        $prodsumme=$prodsumme+$prodObj->getPreis()*$duplicateCount[$prodObj->getProduktid()];
                    }
                } 
                if(isset($_POST['gutscheinInput'])){
                    $Gutschein = new Gutschein();
                    $GS=$Gutschein->gutscheinPrüfen($_POST['gutscheinInput']);
                    if($GS!=false){
                        echo "<tr ><td colspan='2'> Gutschein</td><td>-".$GS->getWert().".- €</td></tr>";
                        $prodsumme=$prodsumme-$GS->getWert();
                    }else{
                        echo "<tr ><td colspan='2'> Gutschein</td><td>ungültig</td></tr>";
                        unset($_POST['gutscheinInput']);
                    }
                }
                echo "<tr style='fontweight:700'><td colspan='2'> Gesamtsumme</td><td>".$prodsumme.".- €</td></tr>";
                echo "</table>";
                $queue="SELECT * FROM `bezahldaten` join `user` using (`UserID`) WHERE `Benutzername` like '".$_SESSION['BN']."'";
                $ergebniss=$db->selectZahlungsArt($queue);
                
            echo "<h3>Zahlungsart</h3><br>";
             echo '<fieldset class="form-group" >
            <div class="form-check">
                
            <div class="form-check">
                <label class="form-check-label">
                  <input type="checkbox" class="form-check-input" name="optionsRadios" onClick="Gutschein()" id="optionsRadios1" value="option1" >
                  Gutschein
                </label>
             </div>
            </fieldset>';
            
                echo '<form id="GutscheinForm" style="display:none" method="post" action="index.php?site=warenkorb&bestellen=true" ><div class="form-group">
                    <label for="gutscheinInput">Gutscheincode</label>
                    <input required type="text" class="form-control" id="gutscheinInput" name="gutscheinInput"  placeholder="Gutscheincode">
                  </div><button type="submit" class="btn btn-primary">Prüfen</button></form><br />';
                
            
                echo"<form class='form-horizontal' method='POST' action='index.php?site=warenkorb&GesamtPreis=".$prodsumme."'><table style='display: inline' id='KKtable' class='table striped-table'>";
                 echo '<th>Zahlungsart</th><th>Kontonummer/Kreditkartennummer</th><th>Ablaufdatum</th><th></th></tr>';
                foreach($ergebniss as $zeile){
                    if(!empty($zeile->getKontonummer())){
                        echo "<tr>";
                        echo "<td>Konto</td>"; 
                        echo "<td>".$zeile->getKontonummer()."</td>"; 
                        echo "<td></td>"; 
                        echo "<td><input required type='radio' name='Konto' value='".$zeile->getBezahlDatenID()."'></td>"; 
                        echo "</tr>";
                    }if(!empty($zeile->getKreditkartennummer())){
                        echo "<tr>";
                        echo "<td>Kreditkarte</td>"; 
                        echo "<td>".$zeile->getKreditkartennummer()."</td>"; 
                        echo "<td>".$zeile->getAblaufdatum()."</td>"; 
                        echo "<td><input type='radio' name='Konto' value='".$zeile->getBezahlDatenID()."'></td>"; 
                        echo "</tr>";
                    }
                    
                }
                echo "</table>";
               
               if(isset($_POST['gutscheinInput'])){
                    echo '<input style="display: none" name="GutscheinID" value="'.$_POST['gutscheinInput'].'">';
               
               }
                echo'<div class="form-group"><div class="col-sm-offset-2 col-sm-10"><button type="submit" class="btn btn-success">Bestellen</button></div></div></form>';
                
                
                    }
                
            }
            
        
        ?>


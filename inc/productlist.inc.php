
<?php

/*
 * Author: Stefan Seyer
 * 
 */


$String = "%";
//Wenn ein Suchstring vorhanden ist werden die Wildcards hinzugefügt.
if(isset($_GET['SS']) && isset($_GET['KK'])){
    if(!empty(trim($_GET['SS']))){
        $String = "%".$_GET['SS']."%";
    }
    
    // Produkt und Datenbank Klasse müssen nochmal inkludiert werden, da das PHP Formular nur von Javascript aufgerufen wird und daher die Klassen nicht vererbt bekommt. 
    include '../model/Product.class.php';
    include '../model/Database.class.php';
    $db = new Database();

    //hier wird zwischen Suche nach Kategorie und der Suche nach einem Suchstring jenachdem eine andere Datenbankfunktion aufgerufen.
    if($_GET['KK'] == 0) { $ergebnis = $db->getProducts($String);}
    else { $ergebnis = $db->getProductsOnKat($_GET['SS']);}
}

Echo "<br>";
//Das Suchergebnis wird mit Karten als Produkt Objekt angezeigt.
if(!empty($ergebnis)){
    Echo '<div class="row card-deck">';

    foreach ($ergebnis as $Prod){
       
        Echo '<div class="col-sm-3">';
            Echo '<div id="productcard" class="card">';
            //Das Bild wird als Dragable Objekt aktiviert.
            Echo '<img class="card-img-top img" draggable="true" ondragstart="drag(event)" id='.$Prod->getProduktid().' src="pictures/'.$Prod->getFoto().'.jpg" alt="Card image cap">';
                Echo ' <div class="card-block">';
                Echo '      <h3 class="card-title">'.$Prod->getName().'</h3>';
                Echo '      <p class="card-text">'.$Prod->getBeschreibung().'</p>';
               
            Echo '<ul class="list-group list-group-flush">';
            Echo '<li class="list-group-item">';
                     // Die Bewertung wird mit Sternen angezeigt.
                    for($i=1;$i<6;$i++){
                        IF($i<$Prod->getBewertung()){
                            Echo'<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                            }
                        else{        
                            Echo'<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span>';
                            }
                    }
            Echo '</li>';
            Echo '<li class="list-group-item">'.$Prod->getPreis().',- € </li>';
            Echo "</ul>";
            Echo ' <a class="btn btn-primary" id="KaufenBTN" onclick="addProduktToWarenkorb('.$Prod->getProduktid().')">Kaufen</a>';
            // Es wird ein unsichtbarer Karten Footer hinzugefügt damit ein Abstand zwischen den Karten besteht.
            Echo '<div class="card-footer stealth" >test</div>';
            Echo " </div>";
             Echo "  </div>
            </div>";

        }   
    Echo "</div>";
    }
Else {
    //Wird ausgeführt wenn keine Produkte gefunden wurden.
    echo "<div class='col-md-12'>";
    echo "<div class='alert alert-danger'> Keine Produkte gefunden. </div>";
    echo "</div>";
    }



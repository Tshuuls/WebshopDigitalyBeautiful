<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author julia
 */
class Database {
    
    private $host="localhost";
    private $username="root";
    private $password="";
    private $dbname="ProjectDB";
    
    //Die Datenbankverbindung wird hergestellt.
    private function connect2DB(){
        $this->conn = new mysqli($this->host,$this->username,$this->password,$this->dbname);
        mysqli_set_charset($this->conn, 'utf8');
        return $this->conn;
    }
    
    //Es wird eine Reihe je nach Statement der Datenbank hinzugefügt.
    function insert($statement){
    $db= $this->connect2DB();
    if(!$db->query($statement)){
        echo "Errormessage: ".$db->error;
        echo "<script>console.log( 'Debug Objects: " . $db->error . "' );</script>";
        }
    $db->close();
    }
    
    //Es wird eine Reihe je nach Statment aus der Datenbank gelöscht.
    function deleteIt($statement){
    $db= $this->connect2DB();
    if(!$db->query($statement)){
        echo "Errormessage: ".$db->error;
        }
    $db->close();
    }
    
    //Es werden alle Benutzer zurückgegeben.
    function select ($statement){
        
    $db= $this->connect2DB();
    $ergebniss = $db->query($statement);

        $user=array();
        while($zeile=$ergebniss->fetch_object()){
            $user1=new User();
            $user1.addAllValues($zeile->UserID, $zeile->Anrede, $zeile->Vorname, $zeile->Nachname, $zeile->Adresse, 
                $zeile->PLZ, $zeile->Ort, $zeile->Email, $zeile->Benutzername, $zeile->Passwort, $zeile->Admin);
            $user1->displayUser();
            echo "<br />";
            array_push($user, $user1); 
        }
    
    $ergebniss->close();
    $db->close();
    return $user;
    }
    
    function selectUserID($statement){
        $db= $this->connect2DB();
        $ergebniss = $db->query($statement);
        return $ergebniss;
    }
    
    function count ($statement){
        
    $db= $this->connect2DB();
    $ergebniss = $db->query($statement);
    if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                $count=$zeile->count;
            }
        }
    $ergebniss->close();
    $db->close();
    return $count;
    }
    
    function selectOneUser ($statement){
    $db= $this->connect2DB();
    $user=false;
        $ergebniss = $db->query($statement);
        if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                $user=new User();
                $user->addAllValues($zeile->UserID, $zeile->Anrede, $zeile->Vorname, $zeile->Nachname, $zeile->Adresse, 
                    $zeile->PLZ, $zeile->Ort, $zeile->Email,$zeile->Activ, $zeile->Benutzername, $zeile->Passwort, $zeile->Admin);
                //$user->displayUser();
                //echo "<br />";
            }
        }
    
    $ergebniss->close();
    $db->close();
    return $user;
    }
    
    function selectoneGutschein($statement){
        $db= $this->connect2DB();
        $ergebniss = $db->query($statement);
        if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                $GS=new Gutschein();
                $GS->addAllValues($zeile->GutscheinID, $zeile->Wert, $zeile->Gueltigkeit, $zeile->Eingeloest);
            }
        }
    
    $ergebniss->close();
    $db->close();
    return $GS;
    }
    
    function update($statement){
        $db= $this->connect2DB();
        $ergebniss = $db->query($statement);
        
    $db->close();
    }
    function updateZahlungsinformation($statement){
        $db= $this->connect2DB();
        $ergebniss = $db->query($statement);
        $ergebniss->close();
    $db->close();
    }
    
    function selectZahlungsArt($statement){
        $db= $this->connect2DB();
        $ergebniss = $db->query($statement);
        $ZAarr=array();
       
        if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                $ZA=new Zahlungsart;
                $ZA->addAllValues($zeile->UserID,$zeile->BezahldatenID, $zeile->Kontonummer, $zeile->Kreditkartennummer, $zeile->Ablaufdatum);
                array_push($ZAarr, $ZA);  
            }
        }
        
        $ergebniss->close();
        $db->close();
        return $ZAarr;
    }
    
    function selectBestellungen($statement){
        $db= $this->connect2DB();
        $ergebniss = $db->query($statement);
        $BAarr=array();
       
        if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                $BA=new Bestellung;
                $BA->adAllValues($zeile->BestellungID, $zeile->UserID, $zeile->Ausstellungsdatum, $zeile->Rechnungsnummer);
                array_push($BAarr, $BA);  
            }
        }
        
        $ergebniss->close();
        $db->close();
        return $BAarr;
    }
    
    function selectBestellungsporitionen($statement){
        $db= $this->connect2DB();
        $ergebniss = $db->query($statement);
        $BAarr=array();
       
        if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                $BA=new BestellungPositionen;
                $BA->adAllValues($zeile->ProduktID, $zeile->Name, $zeile->Anzahl, $zeile->Preis);
                array_push($BAarr, $BA);  
            }
        }
        
        $ergebniss->close();
        $db->close();
        return $BAarr;
    }
    
    function getallBenutzernamen(){
        $db= $this->connect2DB();
        $statement ="Select Benutzername from User";
        $ergebniss = $db->query($statement);
        $Namen=array();
        if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                array_push($Namen, $zeile->Benutzername);
                //echo $zeile->Benutzername .'<br />';
            }
        }
        $ergebniss->close();
    $db->close();
    return $Namen;
    }
    function getallBenutzer(){
        $db= $this->connect2DB();
        $statement ="Select * from User";
        $ergebniss = $db->query($statement);
        $Namen=array();
        if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                $user =new User();
                $user->addAllValues($zeile->UserID, $zeile->Anrede, $zeile->Vorname, $zeile->Nachname, $zeile->Adresse, $zeile->PLZ, $zeile->Ort, $zeile->Email, $zeile->Activ, $zeile->Benutzername, $zeile->Passwort, $zeile->Admin);
                array_push($Namen, $user);
                //echo $zeile->Benutzername .'<br />';
            }
        }
        $ergebniss->close();
    $db->close();
    return $Namen;
    }
    
    //Es werden alle Produkte ungefiltert zurückgegeben.
    function getallproducts(){
        $productlist = array();
        $db= $this->connect2DB();
        $Abfrage = "select * from produkte join produktkategorie using (kategorieid) order by ProduktID";
        if($result = $db->query($Abfrage)){
            while ($row = $result->fetch_assoc()) {
                $prod = new Product();
                $prod->withparam($row['ProduktID'], $row['Name'], $row['Beschreibung'], $row['Bewertung'], $row['Preis'], $row['Foto'], $row['KategorieID'], $row['Bezeichnung']);
                array_push($productlist, $prod);
            }
        }
        $db->close();
        $result->close();
        return $productlist;
        }
    
        
    //Es wird ein Produkt mit einer bestimmten Produktnummer zurückgegeben.
    function getProduct($PID){
        $prod = new Product();
        $db= $this->connect2DB();
        $Abfrage = "select * from produkte join produktkategorie using (kategorieid) where ProduktID=".$PID;
        if($result = $db->query($Abfrage)){
            while ($row = $result->fetch_assoc()) {
            $prod->withparam($row['ProduktID'], $row['Name'], $row['Beschreibung'], $row['Bewertung'], $row['Preis'], $row['Foto'], $row['KategorieID'], $row['Bezeichnung']);
            }
        }
        return $prod;
        
    }
    
    
    //Gibt alle Produkte zurück die im Namen oder in der Beschreibung den Suchstring %String% beinhalten;
    function getProducts($String){
        $productlist = array();
        $db= $this->connect2DB();
        $Abfrage = "select * from produkte join produktkategorie using (kategorieid) where Name LIKE '".$String."' or Beschreibung LIKE '".$String."'";
        if($result = $db->query($Abfrage)){
            while ($row = $result->fetch_assoc()) {
                $prod = new Product();
                $prod->withparam($row['ProduktID'], $row['Name'], $row['Beschreibung'], $row['Bewertung'], $row['Preis'], $row['Foto'], $row['KategorieID'], $row['Bezeichnung']);
                array_push($productlist, $prod);
            }
        $result->close();
        }
        $db->close();
        return $productlist;
        }
     
    //Gibt alle Produkte zurück die eine bestimmte Kategorie haben.
    function getProductsOnKat($Kat){
        $productlist = array();
        $db= $this->connect2DB();
        $Abfrage = "select * from produkte join produktkategorie using (kategorieid) where kategorieid = ".$Kat;
        if($result = $db->query($Abfrage)){
            while ($row = $result->fetch_assoc()) {
                $prod = new Product();
                $prod->withparam($row['ProduktID'], $row['Name'], $row['Beschreibung'], $row['Bewertung'], $row['Preis'], $row['Foto'], $row['KategorieID'], $row['Bezeichnung']);
                array_push($productlist, $prod);
                }
            $result->close();
            }
        $db->close();
        return $productlist;
        }
        
        
    //Es werden alle Kategorien zurückgegeben.
    function getallkat(){
        //include 'Kategory.class.php';
        $db= $this->connect2DB();
        $kategorylist = array();
        $Abfrage = "select * from produktkategorie";
        $st = $db->prepare($Abfrage);
        $st->execute();
        $rows = $st->get_result();
        if(!empty($rows)){
            while($row = $rows->fetch_assoc()){
            $kate = new kategory($row['KategorieID'],$row['Bezeichnung']);
            array_push($kategorylist, $kate);
            }
        $rows->close();
        $db->close();
        return $kategorylist;    
        }    
    }
    
    //Es wird eine Bestellung zurückgegeben.
    function getOneBestellung($statement){
        $db= $this->connect2DB();
        $ergebniss = $db->query($statement);
        if ($ergebniss!=false){
            while($zeile=$ergebniss->fetch_object()){
                $BS=$zeile->BestellungID;
            }
        }
    
    $ergebniss->close();
    $db->close();
    return $BS;
    }
    
    
    //Es werden alle Gutscheine zurückgegeben
    function getallvoucher(){
        $voucherlist = array();
        $db= $this->connect2DB();
        $Abfrage = "select * from gutscheine order by Gueltigkeit DESC";
        if($result = $db->query($Abfrage)){
            while ($row = $result->fetch_assoc()) {
                $vouch = new Gutschein();
                $vouch->addAllValues($row['GutscheinID'], $row['Wert'], $row['Gueltigkeit'], $row['Eingeloest']);
                array_push($voucherlist, $vouch);
            }
            $result->close();
        }
        $db->close();
        return $voucherlist;
        }
        
     function codeCheck($code){
       //Es wird überprüft, ob der übergebene Code schon als GutscheinID vorkommt.
       $db= $this->connect2DB();
       $Abfrage = "select * from gutscheine where GutscheinID=".$code;
       if($result = $db->query($Abfrage)) return false;
       else return true;
     }
}
    

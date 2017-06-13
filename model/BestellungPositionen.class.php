<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BestellungPositionen
 *
 * @author julia
 */
class BestellungPositionen {
    //put your code here
    private $ProduktID ;
    private $Name ;
    private $Anzahl ;
    private $Preis ;
    function getProduktID() {
        return $this->ProduktID;
    }

    function getName() {
        return $this->Name;
    }

    function getAnzahl() {
        return $this->Anzahl;
    }

    function getPreis() {
        return $this->Preis;
    }

    function setProduktID($ProduktID) {
        $this->ProduktID = $ProduktID;
    }

    function setName($Name) {
        $this->Name = $Name;
    }

    function setAnzahl($Anzahl) {
        $this->Anzahl = $Anzahl;
    }

    function setPreis($Preis) {
        $this->Preis = $Preis;
    }

    function adAllValues($ProduktID, $Name, $Anzahl, $Preis) {
        $this->ProduktID = $ProduktID;
        $this->Name = $Name;
        $this->Anzahl = $Anzahl;
        $this->Preis = $Preis;
    }
    
    function selectBestellungsporitionen($BID){
        $db= new Database();
        $queu="SELECT `ProduktID`,`Anzahl`,`Name`,`Preis` FROM `position` join produkte USING(`ProduktID`) WHERE `BestellungID` ='".$BID."' ";
        return $db->selectBestellungsporitionen($queu);
        
    }

}

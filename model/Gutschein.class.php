<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Gutschein
 *
 * @author julia
 */
class Gutschein {
    //put your code here
    private $gutscheinID;
    private $wert;
    private $gueltigkeit;
    private $eingeloest;
    
    function getGutscheinID() {
        return $this->gutscheinID;
    }

    function getWert() {
        return $this->wert;
    }

    function getGueltigkeit() {
        return $this->gueltigkeit;
    }

    function getEingeloest() {
        return $this->eingeloest;
    }

    function setGutscheinID($gutscheinID) {
        $this->gutscheinID = $gutscheinID;
    }

    function setWert($wert) {
        $this->wert = $wert;
    }

    function setGueltigkeit($gueltigkeit) {
        $this->gueltigkeit = $gueltigkeit;
    }

    function setEingeloest($eingeloest) {
        $this->eingeloest = $eingeloest;
    }

    function addAllValues($gutscheinID, $wert, $gueltigkeit, $eingeloest) {
        $this->gutscheinID = $gutscheinID;
        $this->wert = $wert;
        $this->gueltigkeit = $gueltigkeit;
        $this->eingeloest = $eingeloest;
    }
    
    function gutscheinPrüfen($ID){
        //Gutschein wird überprüft.
        $db =new Database();
        $query="SELECT count(*) as count FROM `gutscheine` WHERE `GutscheinID` like '".$ID."'";
        $count=$db->count($query);
        $date = new DateTime();
        $date->getTimestamp();
        $currday=date_format($date,'Y/m/d');
        if($count>0){
            $query="SELECT *  FROM `gutscheine` WHERE `GutscheinID` like '".$ID."'";
            $GS=$db->selectoneGutschein($query);
            echo date_diff(date_create($GS->getGueltigkeit()),$currday);
            if($GS->getEingeloest()=='0'){
            return $GS;
            }else{
            return false;
        }
        }else{
            return false;
        }
        
    }
    
    function gutscheinEinlösen($ID){
        $db =new Database();
        $query="UPDATE `gutscheine` SET `Eingeloest`='1' WHERE `GutscheinID` like '".$ID."'";
        $db->update($query);
        return $query;
    }
    function generateCode() {
        $db =new Database();
        //Es wird ein 6 stelliger Code mit allen Alphanummerischen Zeichen generiert
        $Chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        while(true){
            $code = "";
            for($i=1; $i <=5;$i++){
            $code.= sprintf('%s', $Chars[rand(0, 61)]);
            }
            //Es wird konntrolliert ob der Code schon in der Datenbank vorhanden ist.
            if ($db->codeCheck($code)){return $code;}
            echo "code ".$code." false?!";
            }  
        }
        
    function insertVoucher(){
        //Gutschein wird in die Datenbank gespeichert;
        $db =new Database();
        $query="INSERT INTO `gutscheine`(`GutscheinID`, `Wert`, `Gueltigkeit`, `Eingeloest`) VALUES "
                ."('".$this->gutscheinID."','".$this->wert."','".$this->gueltigkeit."','".$this->eingeloest."')";
        $db->insert($query);
    }
}

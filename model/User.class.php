<?php
 //include 'Database.class.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author julia
 */
class User {
    //put your code here
    private $userID;
    private $anrede;
    private $vorname;
    private $nachname;
    private $adresse;
    private $plz;
    private $ort;
    private $email;
    private $activ;
    private $benutzerName;
    private $passwort;
    private $admin;

   
    function getActiv() {
        return $this->activ;
    }

    function setActiv($activ) {
        if(!empty($activ)){
            $this->activ = $activ;
        }else{
            $this->activ = 0;
        }
    }

    
    function setUserID($userID) {
        if(!empty($userID)){
            $this->userID = $userID;
        }
    }

    function setVorname($vorname) {
        if(!empty($vorname)){
            $this->vorname = $vorname;
        }
    }

    function setNachname($nachname) {
        if(!empty($nachname)){
            $this->nachname = $nachname;
        }
    }
    function setAnrede($anrede) {
        if(!empty($anrede)){
            $this->anrede = $anrede;
        
        }else{
            $this->anrede = " ";
        }
    }

    function setAdresse($adresse) {
        if(!empty($adresse)){
            $this->adresse = $adresse;
        }
        else{
            $this->adresse = " ";
        }
    }

    function setPlz($plz) {
        if(!empty($plz)){
            $this->plz = $plz;
        }else{
            $this->plz = 0;
        }
        
    }

    function setOrt($ort) {
        if(!empty($ort)){
            $this->ort = $ort;
        }else{
            $this->ort = " ";
        }
    }

    function setEmail($email) {
        if(!empty($email)){
            $this->email = $email;
        }
    }

    public function setBenutzerName($benutzerName) {
        if(!empty($benutzerName)){
            $this->benutzerName = $benutzerName;
        
        }
    }

    public function setPasswort($passwort) {
        if(!empty($passwort)){
            $this->passwort = $passwort;
        }
    }

    function setAdmin($admin) {
        if(!empty($admin)){
        $this->admin = $admin;
        
        }
    }

        function getVorname() {
        return $this->vorname;
    }

    function getNachname() {
        return $this->nachname;
    }
    
    function getUserID() {
        return $this->userID;
    }

    function getAnrede() {
        return $this->anrede;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getPlz() {
        return $this->plz;
    }

    function getOrt() {
        return $this->ort;
    }

    function getEmail() {
        return $this->email;
    }

    function getBenutzerName() {
        return $this->benutzerName;
    }

    function getPasswort() {
        return $this->passwort;
    }

    function getAdmin() {
        return $this->admin;
    }


    function addAllValues($userID, $anrede, $vorname, $nachname, $adresse, 
            $plz, $ort, $email,$activ, $benutzerName, $passwort, $admin) {
        $this->setUserID($userID);
        $this->setAnrede($anrede); 
        $this->setVorname($vorname);
        $this->setNachname($nachname);
        $this->setAdresse($adresse);
        $this->setPlz($plz);
        $this->setOrt($ort);
        $this->setEmail($email);
        $this->setActiv($activ);
        $this->setBenutzerName($benutzerName);
        $this->setPasswort($passwort);
        $this->setAdmin($admin);
    }
    
    function insertUser(){
        
        //Benutzer hinzufügen.
        $db =new Database();
        $query="INSERT INTO `user`(`Anrede`, `Vorname`, `Nachname`, `Adresse`, `PLZ`, `Ort`, `Email`,`Benutzername`, `Passwort`, `Admin`, `Activ`) VALUES ('"
                .$this->anrede."','".$this->vorname."','".$this->nachname."','".$this->adresse."','".$this->plz."','"
                    .$this->ort."','".$this->email."','".$this->benutzerName."','".$this->passwort."','0','0')";
    

        $db->insert($query);
        $query="SELECT UserID from User where `Benutzername` like '".$this->benutzerName."'";
        $result=$db->selectUserID($query);
        while($zeile=$result->fetch_object()){
            
            $ID=$zeile->UserID;
        }
        return $ID;
    }
    
    function selectAllUsers(){
        //Alle Benutzer aus der Datenbank holen
        $db =new Database();
        $query="SELECT * from User";
        $db->select($query);
    }
    

    function checkIfUserExists(){
        //Es wir geschaut ob ein Benutzer schon exisitert.
        $db =new Database();
        $query="SELECT count(*) as counter from User where `Vorname`like '".$this->vorname."' and `Nachname`like '".$this->nachname."'";
        $result=$db->count($query);
        while($zeile=$result->fetch_object()){
            echo ($zeile->counter);
            $counter=$zeile->counter;
        }
        
        return $counter;
        
    }
    
    function displayUser(){
        //Ein Benutzer wird angezeigt.
        echo ($this->userID.'<br />'.$this->anrede.'<br />'.$this->vorname.'<br />'.$this->nachname.'<br />'.$this->adresse.'<br />'.$this->plz.
                    '<br />'.$this->ort.'<br />'.$this->email.'<br />'.$this->benutzerName.'<br />'.$this->passwort.'<br />'.$this->admin);
    }
    
    function validateUser(){
        //Es wird kontrolliert ob alle wichtigen Daten des Benutzer Objekt gesetzt sind.
        if (isset($this->vorname)&&isset($this->nachname)&&isset($this->email)&&
                isset($this->benutzerName)&&isset($this->passwort)){
            return true;
        }
        return false;
    }
    
    function loginUser(){
        //Benutzer wird geholt und das Passwort wird kontrolliert. Danach wird der Sessionstatus und Loginstatus festgelegt.
        $db =new Database();
            $query="SELECT *  from User where `Benutzername` like '".$this->benutzerName."'";
            $result=$db->selectOneUser($query);
            
            if($result!=false){
                if($result->activ==0){
                    if(password_verify (  $this->passwort,$result->passwort )==true){
                        if($result->admin==1){
                            $_SESSION['status']= "admin";
                        }else{
                            $_SESSION['status']= "user";
                        }

                        $_SESSION['user']= $this->benutzerName;
                        $_SESSION['userID']= $result->userID;
                        $LoggedIn=true;
                    }else{
                        $LoggedIn="Passwort inkorrekt";
                    }
                }else{
                    $LoggedIn="Benutzer ist deaktiviert.";
                }
            }else{
                    $LoggedIn="Benutzername nicht vorhanden";
                }
            return $LoggedIn;
    }
    
    function selectOneUser(){
        //Einen Benutzer mit der User ID aus der Datenbank holen.
        $db =new Database();
        $query="SELECT *  from User where `UserID` like '".$this->userID."'";
        $result=$db->selectOneUser($query);

        return $result;
    }
    function selectOneUserByName($BN){
        //Einen Benutzer mit einem bestimmten Benutzernamen aus der Datenbank holen.
        $db =new Database();
        $query="SELECT *  from User where `Benutzername` like '".$BN."'";
        $result=$db->selectOneUser($query);

        return $result;
    }
    function updateUser(){
        //Benutzerdaten ändern.
        $db =new Database();
        $query="UPDATE `user` SET `Anrede`='".$this->anrede."',`Vorname`='".$this->vorname."',`Nachname`='".$this->nachname."',`Adresse`='".$this->adresse."',`PLZ`='".$this->plz."',`Ort`='".$this->ort."',`Email`='".$this->email."',`Benutzername`='".$this->benutzerName."',`Passwort`='".$this->passwort."',`Activ`='".$this->activ."' WHERE `UserID` = '".$this->userID."'";
        //echo $query;
        $db->update($query);
        
    }
}

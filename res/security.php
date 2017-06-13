<?php
//Filtern der sicherheitskritischen Zeichen. 
function secureString($String){
    $invalidChars = array("\\","<",">","|",";","(",")","'","\"");
    $String = str_replace($invalidChars,"", $String);
    if(empty($String)) {
                        $String = " ";
                        }
    return $String;
}
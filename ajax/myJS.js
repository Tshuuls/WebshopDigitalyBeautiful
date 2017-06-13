/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//ügt ein produkt dem warenkorb hinzu
function addProduktToWarenkorb (produktID){
   $.post("res/warenkorbPHP.php", {operation: 'add', produkt:produktID}, function(result){
        $("span").html(result);
    });
}
//updated den counter neben dem icon
function updateWarenkorbCount(counter){
    document.getElementById("warenkorbCount").innerHTML=String(counter);
}
//updated den produktpreis
function updateProduktPreis(produktID,preis,prodCount,change){
    elementID="ProdPreis".concat(produktID);
    document.getElementById(elementID).innerHTML=String(preis*prodCount)+".- €";
    check=change-preis;
    
}

//Es werden die HTML Daten von productlist mit Ajax in den searchrestult DIV geladen.
function searchProduct(S,K){
        //Der Output von Productlist mit den Parametern SS (Suchstring) und KK (0 bei Suche ohne Kategorie, 1 mit Kategorie) wird in searchresult div geladen.
        $.get("inc/productlist.inc.php", {SS : S,KK : K})
                .done(function( data ){
                    $("#searchresult").html(data);
        });
    }
//leitet die änderung eine Produktanzahl weiter    
function ProdCounterChange(prodPreis,produktID,change){
    $.post("res/warenkorbPHP.php", {operation: 'change', produkt:produktID,change:change,preis:prodPreis}, function(result){
    $("span").html(result);
    });
    }
    
    //löscht/leehrt den warenkorb
function warenkorbLöschen(){
      $.post("res/warenkorbPHP.php", {operation: 'alleslöschen'}, function(result){
        $("span").html(result);
    });  
    document.getElementById("WarenkkorbDIV").innerHTML="<div class='col-md-12'><div class='alert alert-danger'> Der Warenkorb ist leider leer. </div></div>";
        
}
//blendet Div für Kontonummer ein
function Kontonummer(){
    document.getElementById("registerKontonummerDIV").style.display="inline"; 
    document.getElementById("registerKreditkartennummerDIV").style.display="none"; 
    document.getElementById("registerAblaufdatumDIV").style.display="none";  
}

//blendet Div für Kreditkarte und Ablaufdatum ein
function KreditKarte(){
    document.getElementById("registerKontonummerDIV").style.display="none"; 
    document.getElementById("registerKreditkartennummerDIV").style.display="inline"; 
    document.getElementById("registerAblaufdatumDIV").style.display="inline";  
}
//Blendet gutschein input ein
function Gutschein(){
    if(document.getElementById("GutscheinForm").style.display=="inline"){
    document.getElementById("GutscheinForm").style.display="none"; 
    }else{
    document.getElementById("GutscheinForm").style.display="inline"; 
    }
    
}
/*
function drag(prod) {
  prod.dataTransfer.setData("ProduktID", prod.target.id.value);
    
}

function drop(ev) {
    //ev.preventDefault();
    var ProduktID = ev.dataTransfer.getData("ProduktID");
    addProduktToWarenkorb (ProduktID);
}
*/

function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
}


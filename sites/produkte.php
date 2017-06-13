
<div class="input-group">
    <div class="input-group-btn">
    <!-- Hier werden die Buttons eingefügt um nach Kategorien zu filtern -->
        <button type="button" onclick="searchProduct('1','1');" class="btn btn-secondary">Halskette</button>
        <button type="button" onclick="searchProduct('2','1');" class="btn btn-secondary">Anhänger</button>
        <button type="button" onclick="searchProduct('3','1');" class="btn btn-secondary">Armbänder</button>
        <button type="button" onclick="searchProduct('4','1');" class="btn btn-secondary">Ohrschmuck</button>
     </div>
    <!--Hier wird die JS/Ajax Funktion aufgerufen um die Suchergebnisse zu bekommen. -->
    <input type="text"  class="form-control" id="SS" placeholder="Suche..." onkeyup="searchProduct(this.value,'0');" />
  </div>

 <!--der Iframe Container hilft dabei alle Produkte aufzulisten wenn die Seite das erste Mal geladen wird. -->
 <iframe class="stealth2" id="ifrm" src="about:blank"></iframe>

 <!--Hier wird das Suchergebnis eingetragen; -->
 <div id="searchresult"> </div>
 
<!--bei ersten Mal laden der Produktseite wird ein unsichtbares IFrame geladen damit die searchProduct funktion aufgerufen wird. -->

<script>document.getElementById('ifrm').onload = searchProduct('%',0);</script>

<script>  
   document.getElementById("SS").addEventListener("ondragover", function(event){
    event.preventDefault()
});
</script>
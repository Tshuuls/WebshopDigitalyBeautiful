   <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <!--   <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> -->
          </button>
          <a class="navbar-brand" href="index.php?site=produkte">Digitally Beautiful</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse" >
          <ul class="nav navbar-nav">
             <?php
                $xmlFile = 'inc/menuXML.xml'; 
                //auslesen des XML files 
                if (file_exists($xmlFile)) { 
                $xml = simplexml_load_file($xmlFile);
                    foreach ( $xml->$_SESSION['status']->item as $item )   
                    {  
                       echo '<li><a href="index.php?site='.trim($item->id).'">'.$item->name.'</a></li>';   
                       
                       if (isset($_GET['site'])){
                            if($_GET['site']===trim($item->id)){
                                $_SESSION['href']= trim($item->href);
                                $_SESSION['active']=$_GET['site'];
                            }
                       }else{

                                $_SESSION['href']= "sites/produkte.php";
                                $_SESSION['active']="produkte";
                            }
                       
                    }  
                }
                else {
                    echo "no XML found";
                }
            ?>
            
             
              
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li ondrop="drop(event)"><a href="index.php?site=warenkorb" ><span id="warenkorbCount"></span><span  class="glyphicon glyphicon-gift" aria-hidden="true"></span></a></li>
            <?php
                if(isset($_SESSION['status'])&&($_SESSION['status']=="user"||$_SESSION['status']=="admin")){
                    echo '<li><a href="index.php?site=Logout">Log Out</a></li>';
                }else{
                    echo '<li><a href="index.php?site=home">Log in</a></li>';
                }
            ?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<script>  
   document.getElementById("navbar").addEventListener("ondragover", function(event){
    event.preventDefault()
});
updateWarenkorbCount(".count($_SESSION['warenkorb']).");
</script>

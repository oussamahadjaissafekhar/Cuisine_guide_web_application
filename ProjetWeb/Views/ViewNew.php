<?php
require_once('Controllers/Conroller.php');
class ViewNew extends View{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/new.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            <script src="JavaScript/recette.js"></script>
        <?php
    }


    public function New($new){
        $controlleur = new Controller;
        echo "
            <div class='new'>
                <h1>$new[NewTitle]</h1>
                <div class='newImage'>
                    <img id='newImage' src='$new[ImageNew]'/>                   
                </div>
                <h3>$new[NewDescription]</h3>";
                if($new['Video'] != ""){
                    echo "<video src='$new[Video]' preload='auto' controls></video>";
                }       
        echo"
            </div>";                
    }

    public function afficherSite(){
        $controlleur = new Controller;
        $new = $controlleur->getNewByIdController($_SESSION['new'])->fetch();
        $this->New($new);         
    }

}
?>
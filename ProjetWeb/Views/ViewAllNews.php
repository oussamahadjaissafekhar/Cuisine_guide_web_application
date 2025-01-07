<?php
require_once('Controllers/Conroller.php');
class ViewAllNews extends View{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/AllNews.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            <script src="JavaScript/recette.js"></script>
        <?php
    }


    public function afficherSite(){
        $controlleur = new Controller;
        $news = $controlleur->getNewsController();
        echo "<div id='AllNews'>";
        foreach($news as $new){
            $this->afficherNew($new);
        }       
        echo "</div>";
    }

}
?>
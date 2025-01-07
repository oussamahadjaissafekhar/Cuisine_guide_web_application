<?php
require_once('Controllers/Conroller.php');
class ViewNews extends View{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/diaporama.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
            <script src="JavaScript/diaporama.js"></script>
        <?php
    }


    // Afficher les cadres
    public function cadres(){
        echo "<div class='cadres'>";
        $controlleur = new Controller();
        for ($i=0; $i<2; $i++) {
            echo "  <div class='cadre'>";
            switch($i){
                case 0 :
                    echo "<h1>Les news</h1>
                    <a href='router.php?link=9' name='link' id='AllRecipes'>Afficher tous</a>";
                    $_SESSION['news'] = true ;
                    $news = $controlleur->getNewsController();
                    echo "       <div class='cartesCadre'>
                    <img class='buttonPrevious button'src='Images/previous.png'/>
                    <div class='cartes'>";            
                    foreach($news as $new){
                        $this->afficherNew($new);
                    } 
                    break;
                case 1 :
                    echo "<h1>Les recettes</h1>
                    <a href='router.php?link=8' name='link' id='AllRecipes'>Afficher tous</a>";
                    $_SESSION['recipe'] = true ;
                    $recipes = $controlleur->getRecipesController(); 
                    echo "       <div class='cartesCadre'>
                    <img class='buttonPrevious button'src='Images/previous.png'/>
                    <div class='cartes'>";            
                    foreach($recipes as $recipe){
                        $this->afficherRecette($recipe);
                    }
                    break;                   
            }
            echo "          </div>
                            <img class='buttonNext button'src='Images/next.png'/>
                        </div>
                    </div>";
        }
        echo "</div>";
    }

    //Afficher la page accueil
    public function afficherSite(){
        $this->diaporama();
        $this->cadres();
    }
}
?>
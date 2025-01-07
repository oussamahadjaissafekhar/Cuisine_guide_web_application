<?php
require_once('Controllers/Conroller.php');
class ViewAcceuil extends View{


    
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
        $categories = $this->getCategoriesView();
        foreach($categories as $categorie){
            echo "  <div class='cadre'>";
                    echo "<h1>Les $categorie[categorieNom]s</h1>
                    <a href='router.php?link=g$categorie[categorieNom]' name='link' id='AllRecipes'>Afficher tous</a>";
                    $recipes = $this->getRecipeByCategorieView($categorie['categorieNom']);                   
            echo "       <div class='cartesCadre'>
                            <img class='buttonPrevious button'src='Images/previous.png'/>
                            <div class='cartes'>";            
            foreach($recipes as $recipe){
                $this->afficherRecette($recipe);
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
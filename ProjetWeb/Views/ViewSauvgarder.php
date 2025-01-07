<?php

use PSpell\Config;

require_once('Controllers/Conroller.php');
class ViewSauvgarder extends ViewProfil{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/FilterBar.css">
            <link rel="stylesheet" href="Css/saison.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            <script src="JavaScript/FilterSaison.js"></script>
        <?php
    }

        // Afficher la page du filter
        public function afficherSite(){
            ?>
            <h1 style="margin-left: 20px;">Les recettes aimees :</h1>
                <div class="filterResult">
                    
            <?php
            $conttrolleur = new Controller;
            $recipes = [];
            $saves = $conttrolleur->getSaves($_SESSION['user']['UserID']);
            foreach($saves as $save){
                $recipe = $conttrolleur->getRecipeByIdController($save['RecipeID'])->fetch();
                array_push($recipes,$recipe);
            }
                if(!empty($recipes)){
                    foreach($recipes as $recipe){
                        parent::afficherRecette($recipe);
                    } 
                }else{
                    echo "<p>Desole , Aucune resultat trouver !</p>";
                }   
                               
            ?>
                </div>
            <?php
        }
}
?>
<?php

use PSpell\Config;

require_once('Controllers/Conroller.php');
class ViewSaison extends View{


    
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


    // Afficher le filter
    public function afficherFilterBar(){
        ?>
            <form class="filter" method="POST">
                <div class="rechercheBar">
                    <label>
                        <input class="filterSelect" id="recherchBar" name="recherchBar" type="text" placeholder="Rechercher une recette "/>
                        <img src="Images/loop.png"/>
                    </label>
                </div>
                <h2>Choissez la saison que vous voulez</h2>
                <select class="filterSelect" id="Saison" name="Saison">
                    <option value="" disabled selected>Choisir une saison</option>
                    <option value="tous">Tous</option>
                    <option value="printemps">Printemps</option>
                    <option value="etes">Etes</option>
                    <option value="automne">Automne</option>
                    <option value="hiver">Hiver</option>
                </select>
                <input type="submit" name="saisonSubmit" value="rechercher"/>
            </form>
        <?php
    }

        public function filterSaison(){
            $controller = new Controller;
            if(isset($_POST['saisonSubmit'])){
                if(isset($_POST['Saison'])){
                    if($_POST['Saison'] != "tous"){
                       return  $controller->getRecipeSaisonController($_POST['Saison'])->fetchAll();
                    }else{
                        return $controller->getRecipesController();
                    }
                }
            }else{
                return $controller->getRecipesController();
            }
        }

        // Afficher la page du filter
        public function afficherSite(){
            $this->afficherFilterBar();
            ?>
                <div class="filterResult">
            <?php
                $recipes = $this->filterSaison();            
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
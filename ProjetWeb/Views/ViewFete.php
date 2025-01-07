<?php

use PSpell\Config;

require_once('Controllers/Conroller.php');
class ViewFete extends View{


    
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
                <h2>Choissez la fete que vous voulez</h2>
                <select class="filterSelect" id="Saison" name="fete">
                    <option value="" disabled selected>Choisir une fete</option>
                    <option value="tous">Tous</option>
                    <?php
                        $holidays = $this->getHolidaysView();
                        foreach($holidays as $holiday){
                            echo "<option value='$holiday[Holiday]'>$holiday[Holiday]</option>";
                        }
                    ?>
                </select>
                <input type="submit" name="feteSubmit" value="rechercher"/>
            </form>
        <?php
    }

        public function filterSaison(){
            $controller = new Controller;
            if(isset($_POST['feteSubmit'])){
                if(isset($_POST['fete'])){
                    if($_POST['fete'] != "tous"){
                       return  $controller->getRecipeByHolidayController($_POST['fete']);
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
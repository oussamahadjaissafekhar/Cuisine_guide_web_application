<?php
require_once('Controllers/Conroller.php');
class ViewNutrition extends View{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/nutrition.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            <script src="JavaScript/nutrition.js"></script>
        <?php
    }


    // afficher un ingredient
    public function afficherIngredient($ingredient){
        echo"   <div class='ingredient'>
                    <img src='$ingredient[ImageIngredient]'>
                        <h2>$ingredient[IngredientName]</h2>
                        <h4>Calories : $ingredient[Calorie]</h4>
                        <h4>Glucides : $ingredient[Glucide]</h4>
                        <h4>Lipides : $ingredient[Lipide]</h4>
                        <h4>Proteines : $ingredient[Proteine]</h4>
                        <h4>Vitamines : $ingredient[Vitamine]</h4>
                        <h4>Halthy : $ingredient[Halthy]</h4>
                        <h4>Saison naturelle : $ingredient[Saison]</h4>
                </div>";

    }

    public function afficherSite(){
        ?>
        <div class="rechercheBar">
            <label>
                <input class="filterSelect" id="recherchBar" name="recherchBar" type="text" placeholder="Rechercher un ingredient "/>
                <img src="Images/loop.png"/>
            </label>
        </div>
        <div class="ingredients">
            <?php
                $ingredients = $this->getIngredientsView();
                foreach($ingredients as $ingredient){
                    $this->afficherIngredient($ingredient);
                }
            ?>
        </div>
        <?php
    }

}
?>
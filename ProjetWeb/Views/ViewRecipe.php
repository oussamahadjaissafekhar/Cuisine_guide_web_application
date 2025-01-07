<?php
require_once('Controllers/Conroller.php');
class ViewRecipe extends View{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/recette.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            <script src="JavaScript/recette.js"></script>
        <?php
    }


    public function Recette($recipe){
        $controlleur = new Controller;
        $hp = substr($recipe['PrepareTime'],0,1);
        $mp = substr($recipe['PrepareTime'],3);
        $hc = substr($recipe['CookingTime'],0,1);
        $mc = substr($recipe['CookingTime'],3);
        $ht = substr($recipe['TotalTime'],0,1);
        $mt = substr($recipe['TotalTime'],3);
        echo "
            <div class='recipe'>
                <h1>$recipe[RecipeNom]</h1>
                <div class='recipeImage'>
                    <img id='recipeImage' src='$recipe[Image]'/>";
                    if($_SESSION['connected']){
                        echo "  <form class='recipeReaction' method='POST'>";
                        if($controlleur->getSave($_SESSION['recipe'],$_SESSION['user']['UserID'])>0){
                            echo "<input type='submit' class='exemp' name='save' id='save' value='' />";
                        }else{
                            echo "<input type='submit' class='exemp' name='save' id='unsave' value='' />";
                        }
                        if($controlleur->getLike($_SESSION['recipe'],$_SESSION['user']['UserID'])>0){
                            echo " <input type='submit' class='exemp' name='like' id='like' value='' /> ";
                        }else{
                            echo " <input type='submit' class='exemp' name='like' id='unlike' value='' /> ";
                        }            
                                                 
                        echo "  </form>";
                    }                    
                echo "</div>
                <h2>Description de la recette</h2>
                <h3>$recipe[RecipeDescription]</h3>
                <h2>Les ingredients de la recette</h2>";
                /*<label>inserer le nombre de personne</label>
                <input type='number' placeholder='1'>*/
                echo "<ol>
                ";
                $controlleur = new Controller;
                $ingredients = $controlleur->getIngredientsRecipeController($recipe['RecipeID']) ;
                foreach($ingredients as $ingredient){
                    $ingredientRecipe = $controlleur->getIngredientByIdController($ingredient['IngredientID'])->fetch();
                    echo"<li class='ingredient'>
                            <p>$ingredientRecipe[IngredientName]</p>
                            <p>$ingredient[Quantite] $ingredient[UniteQuantite]</p>
                        </li>";
                }
                echo "
                </ol>
                <h2>Les etapes du prparation de la recette</h2>
                <ol>";
                $steps = $controlleur->getStepsController($recipe['RecipeID']);
                foreach($steps as $step){
                    echo"<li class='step'>
                            <p>$step[StepDescription]</p>
                        </li>";
                }
               echo "
                </ol>
                <h2>Autre information :</h2>
                <h3>le nombre de calories est : $recipe[calorieTotal]</h3>
                <h3>le temps de preparation : $hp h $mp min</h3>
                <h3>le temps de cuisson : $hc h $mc min</h3>
                <h3>le temps total : $ht h $mt min</h3>";
                if($_SESSION['connected']){
                    echo "
                    <form method='post'>
                    <h2>Ajouter une note</h2>
                    <input type='number' name='note' max='5'/>
                    <input type='submit' name='noteSubmit' value='ajouter la note'/>
                    </form>"; 
                }
                
        echo "</div>";

    }



    public function afficherSite(){
        $controlleur = new Controller;
        $controlleur->reaction();
        $controlleur->addMark();
        $recipe = $controlleur->getRecipeByIdController($_SESSION['recipe'])->fetch() ;
        $this->Recette($recipe);         
    }

}
?>
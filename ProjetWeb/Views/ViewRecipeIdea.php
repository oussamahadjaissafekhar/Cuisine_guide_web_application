<?php
require_once('Controllers/Conroller.php');
class ViewRecipeIdea extends View{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/recipeIdea.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
            <script src="JavaScript/recipeIdea.js"></script>
        <?php
    }



    // Afficher un ingredient
    public function afficherIngredient($ingredient){
        echo "  <form method='POST'>
                    <img src='$ingredient[ImageIngredient]'/>
                    <h2>$ingredient[IngredientName]</h2>
                    <input type='submit' name='delet' value='Delete Ingredient'/>
                    <input type='hidden' name='deletId' value='$ingredient[IngredientID]'/>
                </form>";
    }

    // recuperer l'ingredient
    public function getIngredientViwe($ingredientId){
        $controller = new Controller;
        $ingredients = $controller->getIngredientByIdController($ingredientId);
        foreach($ingredients as $ingredient){
            $this->afficherIngredient($ingredient);
        }
    }
    //
    public function afficherForm(){
        echo "  <form class='ingredientForm' method='POST' style='display: none;'>
                    <div class='rechercheBar'>
                        <label>
                            <input type='text' id='recherch' placeholder='Rechercher une recette '/>
                            <img src='Images/loop.png'/>
                        </label>
                    </div>
                    <div class='ingredients'>";
                     $controller = new Controller;
                     $ingredients = $controller->getIngredientsController(); 
                     foreach($ingredients as $ingredient){
                        $this->afficherIngredientForm($ingredient);
                     } 
            echo   "</div>
                    <div class='buttons'>
                        <input type='button' id='fermer' value='fermer'/>
                        <input type='submit' id='ajouter' value='ajouter'/>
                    </div>
                </form>";
    }
    // Afficher imgredient dans le form
    public function afficherIngredientForm($ingredient){
        echo"   <div class='ingredient'> 
                    <img src='$ingredient[ImageIngredient]'/>   
                    <label for='ingredient'>
                        <input type='checkbox' id='ingredient' name='ingredient[]' value='$ingredient[IngredientID]'/>
                        <p>$ingredient[IngredientName]</p>
                    </label>
                </div>";
    }

    // Recuperer les ingredients choissient
    public function getIngredientChosen(){
        $this->delete();
        if(ISSET($_POST['ingredient'])){
            if(!empty($_POST['ingredient']) ){
                if(ISSET($_SESSION['ingredients'])){
                    $_SESSION['ingredients'] = array_unique(array_merge($_SESSION['ingredients'],$_POST['ingredient'])) ;
                }else{
                    $_SESSION['ingredients'] = $_POST['ingredient'];
                }
            }        
        }
        if(ISSET($_SESSION['ingredients'])){
            foreach($_SESSION['ingredients'] as $ingredientId){
                $this->getIngredientViwe($ingredientId);
            }
        }
        
    }
    public function delete(){
        if(ISSET($_POST['deletAll'])){
            $_SESSION['ingredients'] = [];
        }
        if(ISSET($_POST['delet'])){
            if (($key = array_search($_POST['deletId'],$_SESSION['ingredients'])) !== false){
                unset($_SESSION['ingredients'][$key]);
            }
        }
    }
    public function rechercher(){
        if(ISSET($_POST['Sign'])){
            $controller = new Controller;
            $recipes = $controller->getRecipesController();
            $pourcentage = $controller->getPourcentageController()['parametreValue'];
            $_SESSION['recipesIdea'] = [];
            foreach($recipes as $recipe){
                $recipeIngredients = $controller->getIngredientsRecipeController($recipe['RecipeID']);
                $recipeIngredientArray = [];
                foreach($recipeIngredients as $recipeIngredient){
                    array_push($recipeIngredientArray,$recipeIngredient['IngredientID']);
                }
                $arr_common= array_intersect($_SESSION['ingredients'], $recipeIngredientArray);
                $row = count($arr_common);
                if(count($_SESSION['ingredients'])>=1){
                    if(($row/count($_SESSION['ingredients'])) >= ($pourcentage/100)){
                        array_push($_SESSION['recipesIdea'],$recipe) ;
                     }
                }else{
                    $_SESSION['recipesIdea'] = $recipes->fetchAll();
                }
            }
        }
    }

    // Afficher la page recttes idees
    public function afficherSite(){
        ?>
            <div class="recipeIdea" method="POST">
                <h1>Vous n'avez pas trouvé quoi cuisiner ?</h1>
                <h3>Nous sommes là pour vous aider</h3>
                <h2>insérer les ingrédients que vous avez</h2>
                <form class="ingredientControlle" method="POST"> 
                    <input type="button" id="ajouterIngredient" value="+ ajouter ingredient"/>
                    <input type="submit" name="deletAll" value="Delet All"/>
                </form>
                <div class="ingredientTable">
                    <?php
                    $this->getIngredientChosen();
                    ?>
                </div>
                <form method="POST">
                    <input type="submit" name="Sign" id="rechercherButton" value="Rechercher"/>
                </form> 
            </div>
        <?php
        $this->afficherForm();
    }

}
?>
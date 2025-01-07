<?php

use PSpell\Config;

require_once('Controllers/Conroller.php');
require_once('Controllers/ControllerRecipe.php');

class ViewAddRecipeUser extends ViewProfil{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/addRecipe.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            <script src="JavaScript/FilterSaison.js"></script>
        <?php
    }
        // Afficher la page du filter
        public function afficherfirstPage(){
            $controll = new Controller;
            ?>
            <form class="logIn" method="POST">
                <h1>Ajouter une nouvelle recette</h1>
                <div class="row">
                    <div class="column">
                        <label>Nom de la recette</label>
                        <input type="text" name="name" placeholder="Inserz le nom de la recette" required />
                    </div>
                    <div class="column">
                        <label>Temp de preparation
                        </label>
                        <input type="time" name="prepare" required />
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Temp de cuisson</label>
                        <input type="time" name="coocking" required />
                    </div>
                    <div class="column">
                        <label>Temp de repos</label>
                        <input type="time" name="rest" required />
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label>Video sur la recette</label>
                        <input type="file" name="video"  placeholder="Inserez une video"/>
                    </div>
                    <div class="column">
                        <label>Photo de la recette</label>
                        <input type="file" name="pic" placeholder="Inserez une photo" required/>
                    </div>
                </div>    
                <div class="row">
                    <div class="column">
                        <label>Difficulte</label>
                        <input type="number" name="Difficulte" max='10' placeholder="Inserez la difficulte sur 10" required />
                    </div>
                    <div class="column" >
                        <label>Categorie de la recette</label>
                        <select name="categori" required>
                            <option disabled selected>selectionner une categorie</option>
                            <?php
                               $categories = $controll->getCategoriesController();
                               foreach($categories as $categorie){
                                echo "<option value='$categorie[categorieNom]'>$categorie[categorieNom]</option>";
                               }
                            ?>                    
                        </select>
                    </div>
                </div>  
                <label>Selectioner le(s) region(s)</label>
                <div class="row">
                    <?php
                        $regions = $controll->getRegionsController();
                        foreach($regions as $region){
                            echo "<input type='checkbox' name='Region[]' value='$region[regionId]'/>$region[regionNom]";
                        }
                    ?>
                </div> 
                <div class="row">
                    <div class="column">
                        <label>Description de la recette</label>
                        <input type="text" name="description" placeholder="Ajouter une description" id="description" required/>
                    </div>
                </div>    
                <input class="loginButton" type="submit" name="AddRecipe" value="Suivant"/>

            </form>
            <?php
        }
        public function afficherSecondPage(){
            ?>
            <form class="addStep" method="POST">
                <h1>Ajouter une etape</h1>
                <input type="text" name="step" placeholder="Inserer une etap"/>
                <input type="submit" name="addStep" value="Ajouter"/>
                <input type="submit" name="AddRecipe" value="Suivant"/>
            </form>
            <table>
                <tr>
                    <th>Etap</th><th>supprimer</th></tr>
                <tr>
                <?php
                if(isset($_SESSION['steps'])){
                    foreach($_SESSION['steps'] as $step){
                        echo "<tr>
                                <td><form method='post'><input class='inputstep' type='text' name='step' value='$step'/></td>
                                <td><input type='submit' name='suppSte' value='supprimer cette etape'/></form></td>
                            </tr>";
                    }
                }   
            ?>
            </table>
        <?php
        }
        public function afficherThirdPage(){
            $controll = new Controller;
            $ingredients = $controll->getIngredientsController();
            ?>
            <form class="addStep addIngredient" method="POST">
               <h1>Ajouter un ingrdient</h1>
               <select name="ingrdient">
               <option disabled selected>selectionner un ingredient</option>
            <?php
            foreach($ingredients as $ingredient){
                echo "  <option value='$ingredient[IngredientName]|$ingredient[IngredientID]|$ingredient[Calorie]'>$ingredient[IngredientName]</option>";
            }
                   
            ?>
               </select>
               <input type="number" name="quantite" placeholder="Inserer la quantite"/>
               <input type="text" name="uniteQuantite" placeholder="Inserer unite de quantite"/>
               <input type="text" name="methodCoocking" placeholder="Inserer la method de cuisson"/>
               <input type="submit" name="addIngredient" value="Ajouter Ingredient"/>
               <input type="submit" name="addRecipe" value="Ajouter la recette"/>
           </form>
           <table>
                <tr>
                    <th>ingredient</th><th>quntite</th><th>supprimer</th></tr>
                <tr>
            <?php
            if(isset($_SESSION['ings'])){
                foreach($_SESSION['ings'] as $ingredient){
                    echo "<tr>
                            <td><form method='post'><input class='inputstep' type='text' class='inputstep' name='ingredientName' value='$ingredient[ing]'/>
                                                    <input class='inputstep' type='hidden' class='inputstep' name='ingredientId' value='$ingredient[id]'/></td>
                            <td><input class='inputstep' type='text' class='inputstep' name='ingredientQuantite' value='$ingredient[qunt]'/>
                                <input class='inputstep' type='hidden' class='inputstep' name='uniteQuantite' value='$ingredient[unite]'/>
                                <input class='inputstep' type='hidden' class='inputstep' name='methodCoocking' value='$ingredient[method]'/>
                                <input class='inputstep' type='hidden' class='inputstep' name='calorie' value='$ingredient[calorie]'/></td>
                            <td><input type='submit' name='suprIng' value='supprimer ingredient'/></form></td>
                        </tr>";
                }
            }
            
            ?>
            </table>
           <?php
        }

        
        // afficher la page ajouter recettte
        public function afficherSite()
        {
            $controllerRecipe = new ControllerRecipe;
            $controllerRecipe->creerRecette();
            if(isset($_SESSION['pageAjouter'])){
                switch($_SESSION['pageAjouter']){
                    case 1:
                        $this->afficherfirstPage();
                        break;
                    case 2:
                        $controllerRecipe->addStep();
                        $controllerRecipe->removeStep();
                        $this->afficherSecondPage();
                        break;
                    case 3:
                        $controllerRecipe->addIngredient();
                        $controllerRecipe->removeIngredient();
                        $this->afficherThirdPage();
                        break;
                }
            }else{
                $this->afficherfirstPage();
                $_SESSION['pageAjouter'] = 1;
            }
            
        }
        
}
?>
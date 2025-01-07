<?php
require_once('..\Controllers/Conroller.php');
class ViewRecipe extends View{

    public function addRecipeForm(){
        $controll = new Controller;
        $controll->addRecipeForm();
        $controll->addStep();
        $controll->removeStep();
        $controll->addIngredient();
        $controll->removeIngredient();
        $controll->creerRecette();
        $controll->modifyRecipe();
        $ingredients = $controll->getIngredientsController();
        ?>
            <form method="post">
                <div class="recipe">


                    <h1>Ajouter une nouvelle recette</h1>
                    <div class="row">
                        <div class="column">
                            <label>Nom de la recette</label>
                            <?php
                            if(isset($_SESSION['name'])){
                                echo "<input type='text' value='$_SESSION[name]' name='name' placeholder='Inserz le nom de la recette' />";
                            }else{
                                echo "<input type='text' name='name' placeholder='Inserz le nom de la recette' />";
                            }
                            ?>
                            
                        </div>
                        <div class="column">
                            <label>Temp de preparation
                            </label>
                            <?php
                            if(isset($_SESSION['prepare'])){
                                echo "<input type='time' name='prepare' value='$_SESSION[prepare]' />";
                            }else{
                                echo "<input type='time' name='prepare' />";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <label>Temp de cuisson</label>
                            <?php
                            if(isset($_SESSION['coocking'])){
                                echo "<input type='time' name='coocking' value='$_SESSION[coocking]' />";
                            }else{
                                echo "<input type='time' name='coocking' />";
                            }
                            ?>
                        </div>
                        <div class="column">
                            <label>Temp de repos</label>
                            <?php
                            if(isset($_SESSION['rest'])){
                                echo "<input type='time' name='rest' value='$_SESSION[rest]' />";
                            }else{
                                echo "<input type='time' name='rest' />";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <label>Video sur la recette</label>
                            <?php
                            if(isset($_SESSION['video'])){
                                echo "<input type='file' name='video'  placeholder='Inserez une video' value='$_SESSION[video]' />";
                            }else{
                                echo "<input type='file' name='video'  placeholder='Inserez une video' />";
                            }
                            ?>
                        </div>
                        <div class="column">
                            <label>Photo de la recette</label>
                            <?php
                            if(isset($_SESSION['pic'])){
                                echo "<input type='file' name='pic'  placeholder='Inserez une photo' value='$_SESSION[pic]' />";
                            }else{
                                echo "<input type='file' name='pic'  placeholder='Inserez une photo' />";
                            }
                            ?>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="column">
                            <label>Difficulte</label>
                            <?php
                                if(isset($_SESSION['Difficulte'])){
                                    echo "<input type='number' name='Difficulte' max='10' placeholder='Inserez la difficulte sur 10' value='$_SESSION[Difficulte]' required />";
                                }else{
                                    echo "<input type='number' name='Difficulte' max='10' placeholder='Inserez la difficulte sur 10' required />";
                                }
                            ?>
                        </div>
                        <div class="column">
                            <label>Categorie de la recette</label>
                            <select name="categorie" required>
                                <option disabled selected>selectionner une categorie</option>
                                <?php
                                $categories = $controll->getCategoriesController();
                                foreach($categories as $categorie){
                                    if(isset($_SESSION['categorie'])){
                                        if($_SESSION['categorie'] == $categorie['categorieNom']){
                                            echo "<option value='$categorie[categorieNom]' selected>$categorie[categorieNom]</option>";
                                        }else{
                                            echo "<option value='$categorie[categorieNom]'>$categorie[categorieNom]</option>";
                                        }
                                    }else{
                                        echo "<option value='$categorie[categorieNom]'>$categorie[categorieNom]</option>";
                                    }
                                   
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
                            <?php
                            if(isset($_SESSION['description'])){
                                echo "<input type='text' name='description' placeholder='Ajouter une description' id='description' value='$_SESSION[description]' />";
                            }else{
                                echo "<input type='text' name='description' placeholder='Ajouter une description' id='description' />";
                            }
                            ?>
                        </div>
                    </div>   
                </div>


                <div class="step">


                    <h1>Ajouter une etape</h1>
                    <input type="text" class="stepInput" name="Step" placeholder="Inserer une etap"/>
                    <input type="submit" class="submit" name="AddStep" value="Ajouter"/>                  
                    <table>
                        <thead>
                            <tr>
                                <th>Etap</th><th>supprimer</th></tr>
                            <tr>
                        </thead>
                        <tbody>
                        <?php
                        if(!empty($_SESSION['Steps'])){
                            foreach($_SESSION['Steps'] as $step){
                                echo "<tr>
                                        <td>$step<input class='inputstep' type='hidden' name='stepSup' value='$step'/></td>
                                        <td><input type='submit' name='SuppSte' value='supprimer cette etape'/></td>
                                    </tr>";
                            }
                        }   
                    ?>
                        </tbody>
                    </table>
                </div>


                <div class="step ingredient">


                        <h1>Ajouter un ingrdient</h1>
                        <select name="ingrdient">
                        <option disabled selected>selectionner un ingredient</option>
                        <?php
                        foreach($ingredients as $ingredient){
                            echo "  <option value='$ingredient[IngredientName]|$ingredient[IngredientID]|$ingredient[Calorie]'>$ingredient[IngredientName]</option>";
                        }
                            
                        ?>
                        </select>
                        <input type="number" class="stepInput" name="quantite" placeholder="Inserer la quantite"/>
                        <input type="text" class="stepInput" name="UnitQuantite" placeholder="Inserer unite de quantite"/>
                        <input type="text" class="stepInput" name="MethoCoocking" placeholder="Inserer la method de cuisson"/>
                        <input type="submit" class="submit" name="addIngredient" value="Ajouter Ingredient"/>
                    <table>
                        <thead>
                            <tr>
                                <th>ingredient</th><th>quntite</th><th>unite</th><th>method de cuisson</th><th>supprimer</th></tr>
                            <tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($_SESSION['Ings'])){
                            foreach($_SESSION['Ings'] as $ingredient){
                                echo "<tr>
                                        <td>$ingredient[ing]<input class='inputstep' type='hidden' class='inputstep' name='ingredientName' value='$ingredient[ing]'/>
                                                                <input class='inputstep' type='hidden' class='inputstep' name='ingredientId' value='$ingredient[id]'/></td>
                                        <td>$ingredient[qunt]<input class='inputstep' type='hidden' class='inputstep' name='ingredientQuantite' value='$ingredient[qunt]'/></td>
                                        <td>$ingredient[unite]<input class='inputstep' type='hidden' class='inputstep' name='uniteQuantite' value='$ingredient[unite]'/></td>
                                        <td>$ingredient[method]<input class='inputstep' type='hidden' class='inputstep' name='methodCoocking' value='$ingredient[method]'/>
                                            <input class='inputstep' type='hidden' class='inputstep' name='calorie' value='$ingredient[calorie]'/></td>
                                        <td><input type='submit' name='suprIng' value='supprimer ingredient'/></td>
                                    </tr>";
                            }
                        }
                        
                        ?>
                        </tbody>
                    </table>
                        <?php
                            if(isset($_POST['modifyRecipe'])){
                                echo "<input type='submit' class='submit' name='updateRecipe' value='Modifer la recette'/>";
                            }else{
                                echo " <input type='submit' class='submit' name='addRecipe' value='Ajouter la recette'/>";
                            }
                        ?>
                       
                            </div>
            </form>
        <?php

    }
    public function body(){
        $this->addRecipeForm();
        $controll = new Controller;
        $controll->changeRecipeStatus();
        $controll->deletRecipe();
        ?>
            <table>
                <thead>
                    <th>id recette</th>
                    <th>Nom recette</th>
                    <th>image recette</th>
                    <th>Etat</th>
                    <th>Supprimer</th>
                </thead>
                <tbody id="Tbody">
                        <?php /*
                    <script>
                        function getRecipes()
                        {
                        $("#Tbody").load("../php/loadRecipes.php");
                        }

                        setInterval('getRecipes()', 5000);
                    </script>
                        */?>
                    <?php
                        $controlleur = new Controller;
                        $recipes = $controlleur->getRecipesController();
                        foreach($recipes as $recipe){
                            $imageSrc='../../ProjetWeb/'.$recipe['Image'] ;
                            echo "
                            <tr><form method=POST>
                                <td>$recipe[RecipeID]<input type='hidden' name='RecipeID' value='$recipe[RecipeID]'/></td>
                                <td>$recipe[RecipeNom]</td>
                                <td><img src='$imageSrc'/ class='image'></td>";
                            if($recipe['confirmed'] == 0){
                                echo "<td><input type='submit' name='state' value='Accepter'/>
                                <input type='hidden' name='confirmed' value='$recipe[confirmed]'/></td>";
                            }else{
                                echo "<td><input type='submit' name='state' value='Refuser'/>
                                <input type='hidden' name='confirmed' value='$recipe[confirmed]'/></td>";
                            }   
                             echo "<td><input type='submit' name='modifyRecipe' value='modifier'/></td>
                                    <td><input type='submit' name='deletRecipe' value='supprimer'/></td>
                            </form></tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        <?php
    }
    public function afficherSite(){
        $this->headPage();
        $this->body();
        $this->footer();
    }
}
?>
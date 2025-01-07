<?php
require_once('..\Controllers/Conroller.php');
class ViewNutrition extends View{


    public function body(){
        $controoller = new Controller;
        $controoller->addIngredientAdmin();
        $controoller->updateIngredient();
        $controoller->deleteIngredient();
        $ingredients = $controoller->getIngredientsController();
        ?>
        <input type="button"  id="ajouterNew" value="+ Ajouter un ingredient"/>
        <form class="new" method="POST" style="display: none;">
            <input type="button" id="fermerForm" value="X" />
            <input type="text" name="IngredientName" placeholder="Inserer le nom de l'ingredient" required/>
            <input type="number" name="Calories" placeholder="Inserer le nombre de Calories" required/>
            <input type="number" name="Glucide" placeholder="Inserer le nombre de Glucides" required/>
            <input type="number" name="Lipide" placeholder="Inserer le nombre de Lipides" required/>
            <input type="number" name="Proteine" placeholder="Inserer le nombre de Proteines" required/>
            <input type="number" name="Vitamine" placeholder="Inserer le nombre de Vitamines" required/>
            <input type="number" name="Halthy" max='10' placeholder="Inserer la proportion du healthy sur 10" required/>
            <label>La saison de l'ingredient :</label>
            <div class="saison">
                <input type="checkbox" class="saisonItem" name="saison[]" value="printemps"/>Printemps
                <input type="checkbox" class="saisonItem" name="saison[]" value="etes"/>Etes
                <input type="checkbox" class="saisonItem" name="saison[]" value="automne"/>Automne
                <input type="checkbox" class="saisonItem" name="saison[]" value="hiver"/>Hiver
            </div>           
            <label>Ajouter une image</label>
            <input type="file" name="ImageIngredient" placeholder="Inserer un photo du news" required/>
            <input type="submit" name="addIngredient" value="Ajouter ingredient"/>
        </form>
            <table class="tableNews">
                <thead>
                    <th>L'ingredient</th>
                    <th>Saison</th>
                    <th>Portion de healthy</th>
                    <th>Calories</th>
                    <th>Glucides</th>
                    <th>Lipides</th>
                    <th>Proteines</th>
                    <th>Vitamines</th>
                    <th>Image</th>
                    <th>Modifer</th>                    
                    <th>Supprimer</th>
                </thead>
                <tbody>
                <?php
                    foreach($ingredients as $ingredient){
                        $photoDeIngredient = '../../ProjetWeb/'.$ingredient['ImageIngredient'];
                        echo "
                        <tr><form method='POST'>
                            <td><input type='text' name='IngredientName' class='ingredientInputLarge' value='$ingredient[IngredientName]'/></td>
                            <td><input type='text' name='Saison' class='ingredientInputLarge' value='$ingredient[Saison]'/></td>
                            <td><input type='text' name='Halthy' class='ingredientInput' value='$ingredient[Halthy]'/></td>
                            <td><input type='text' name='Calorie' class='ingredientInput' value='$ingredient[Calorie]'/></td>
                            <td><input type='text' name='Glucide' class='ingredientInput' value='$ingredient[Glucide]'/></td>
                            <td><input type='text' name='Lipide' class='ingredientInput' value='$ingredient[Lipide]'/></td>
                            <td><input type='text' name='Proteine' class='ingredientInput' value='$ingredient[Proteine]'/></td>
                            <td><input type='text' name='Vitamine' class='ingredientInput' value='$ingredient[Vitamine]'/></td>
                            <td><img src='$photoDeIngredient' class='image'/></td>
                            <td><input type='submit' name='modifyIngredient' value='modifier'/>
                                <input type='hidden' name='ingredientId' value='$ingredient[IngredientID]'/></td>
                            <td><input type='submit' name='deletIngredient' value='supprimer'/>
                                <input type='hidden' name='ingredientId' value='$ingredient[IngredientID]'/></td>
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
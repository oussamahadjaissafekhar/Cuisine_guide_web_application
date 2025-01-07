<?php
require_once('..\Controllers/Conroller.php');

    $controlleur = new Controller;
    $controlleur->changeRecipeStatus();
    $controlleur->deletRecipe();
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
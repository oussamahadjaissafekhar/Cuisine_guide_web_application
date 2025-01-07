<?php
require_once('..\Controllers/Conroller.php');
class ViewParametre extends View{


    public function body(){
        $controoller = new Controller;
        $controoller->deleteDiapo();
        $controoller->addDiapo();
        $controoller->addParametres();
        $controoller->updateParametres();
        $controoller->deleteParametres();
        $recipes = $controoller->getRecipesController();
        $news = $controoller->getNewsController();
        $parametres = $controoller->getParametres();
        $slides = $controoller->getDiaposController();
        ?>
        <input type="button"  id="ajouterNew" value="+ Ajouter une diapo"/>
        <input type="button"  id="ajouterParam" value="modifier d'autre parametre"/>
        <form class="parametre" method="POST" style="display: none;">
            <input type="button" id="fermerForm" value="X" />
            <table >
                    <thead>
                        <th>Nom de Parametre</th>
                        <th>Valeur</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </thead>
                    <tbody>
                    <?php
                        foreach($parametres as $parametre){
                            echo "
                            <tr>
                                <td><input type='text' class='paramInput' name='parametreNomtable' value='$parametre[parametreNom]'/></td>
                                <td><input type='text' class='paramInput' name='parametreValuetable' value='$parametre[parametreValue]'/></</td>
                                <td><input type='submit' name='updateParam' value='modifier'/>
                                    <input type='hidden' name='parametreId' value='$parametre[parametreId]'/></td>
                                <td><input type='submit' name='deletParam' value='supprimer'/>
                                    <input type='hidden' name='parametreId' value='$parametre[parametreId]'/></td>
                            </tr>";
                        }
                    ?>
                    </tbody>
                </table>
                <input type="text" name="parametreNom" placeholder="inserer le nom du parametre" />
                <input type="number" name="parametreValue" placeholder="inserer la valeur du parametre" />
                <input type="submit" name="addParametre" value="Ajouter diapo"/>
        </form>
        <form class="new" method="POST" style="display: none;">
            <input type="button" id="fermerForm" value="X" />
                <select name="type" id="typeSelect" required>
                    <option disabled selected>Le type du diapo</option>
                    <option value="recipe">Recette</option>
                    <option value="new">News</option>
                </select>
                <select name="recette" id="recetteSelect"  style="display: none;">
                    <option disabled selected>Selectionne une recette</option>
                    <?php
                        foreach($recipes as $recipe){
                            echo "<option value='$recipe[RecipeID]'>$recipe[RecipeNom]</option>";
                        }
                    ?>
                </select>
                <select name="new" id="newSelect"  style="display: none;">
                    <option disabled selected>Selectionne une news</option>
                    <?php
                        foreach($news as $new){
                            echo "<option value='$new[NewID]'>$new[NewTitle]</option>";
                        }
                    ?>
                </select>
                <input type="submit" name="addDiapo" value="Ajouter diapo"/>
        </form>
            <table class="tableNews">
                <thead>
                    <th>Diapo Id</th>
                    <th>Type</th>
                    <th>Titre</th>
                    <th>Image</th>
                    <th>Supprimer</th>
                </thead>
                <tbody>
                <?php
                    foreach($slides as $slide){
                        echo "<tr><form method='POST'>
                                <td>$slide[diaporamaId]</td>
                                <td>$slide[type]</td>";
                        if($slide['type']=='new'){
                            $new = $controoller->getNewByIdController($slide['id'])->fetch();
                            $photoDeNews = '../../ProjetWeb/'.$new['ImageNew'];
                            echo "
                                <td>$new[NewTitle]</td>
                                <td><img src='$photoDeNews' class='image'/></td>
                                <td><input type='submit' name='deletDiapo' value='supprimer'/>
                                    <input type='hidden' name='diapoId' value='$slide[diaporamaId]'/></td>
                            </form></tr> ";
                        }else{
                            $recipe = $controoller->getRecipeByIdController($slide['id'])->fetch();
                            $photoDeRecipe = '../../ProjetWeb/'.$recipe['Image'];
                            echo "
                                <td>$recipe[RecipeNom]</td>
                                <td><img src='$photoDeRecipe' class='image'/></td>
                                <td><input type='submit' name='deletDiapo' value='supprimer'/>
                                    <input type='hidden' name='diapoId' value='$slide[diaporamaId]'/></td>
                            </form></tr> ";
                        }

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
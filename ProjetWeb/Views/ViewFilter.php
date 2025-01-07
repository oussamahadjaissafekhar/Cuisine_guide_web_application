<?php
require_once('Controllers/Conroller.php');
class ViewFilter extends View{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/Filter.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            <script src="JavaScript/Filter.js"></script>
        <?php
    }


    // Afficher le filter
    public function afficherFilterBar(){
        ?>
            <div class="filter">
                <div class="rechercheBar">
                <label>
                    <input class="filterSelect" id="recherchBar" name="recherchBar" type="text" placeholder="Rechercher une recette "/>
                    <img src="Images/loop.png"/>
                </label>
                </div>
                <form class="filterBar" method="POST" action="">
                    <h1 id="filterTitle">Filtrer par </h1>
                    <div class="filtercaracter">
                        <select class="filterSelect" id="Region" name="Region">
                            <option value="" disabled selected>Region</option>
                            <option value="tous">Tous</option>
                            <?php     
                            $regions = $this->getRegionsView();
                            foreach($regions as $region){
                                if(ISSET($_POST['Region'])){
                                    if($_POST['Region'] == $region['regionNom']){
                                        echo "<option value='$region[regionNom]' selected>$region[regionNom]</option>";
                                    }else{
                                        echo "<option value='$region[regionNom]'>$region[regionNom]</option>";
                                    }
                                }else{
                                    echo "<option value='$region[regionNom]'>$region[regionNom]</option>";
                                }        
                            }
                            ?>
                        </select>
                        <select class="filterSelect" id="Saison" name="Saison">
                            <option value="" disabled selected>Saison</option>
                            <option value="tous">Tous</option>
                            <option value="printemps">Printemps</option>
                            <option value="etes">Etes</option>
                            <option value="automne">Automne</option>
                            <option value="hiver">Hiver</option>
                        </select>
                        <select class="filterSelect" id="Fete" name="Fete">
                            <option value="" disabled selected>Fetes</option>
                            <option value="tous">Tous</option>
                            <?php
                            $holidays = $this->getHolidaysView();
                            foreach($holidays as $holiday){
                                if(ISSET($_POST['Fete'])){
                                    if($_POST['Fete'] == $holiday['Holiday']){
                                        echo "<option value='$holiday[Holiday]' selected>$holiday[Holiday]</option>";
                                    }else{
                                        echo "<option value='$holiday[Holiday]'>$holiday[Holiday]</option>";
                                    }
                                }else{
                                    echo "<option value='$holiday[Holiday]'>$holiday[Holiday]</option>";
                                }
                                
                            }
                            ?>
                        </select>
                        <select name="categorie" class="filterSelect" id="Categorie" >
                            <option value="" disabled selected>Categorie</option>
                            <option value="tous">Tous</option>
                            <?php
                            $categories = $this->getCategoriesView();
                            foreach($categories as $categorie){
                                if(ISSET($_POST['categorie'])){
                                    if($_POST['categorie'] == $categorie['categorieNom']){
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
                    <div class="timeFilter">
                        <div>
                            <label for="time">Temps de preparation</label>   
                            <input type="time" name="timePrepare" id="timeZone"/> 
                        </div>
                        <div>
                            <label for="time">Temps de cuisson</label>   
                            <input type="time" name="timeCuisson" id="timeZone"/> 
                        </div>
                        <div>
                            <label for="time">Temps total</label>   
                            <input type="time" name="timeTotal" id="timeZone"/> 
                        </div>
                        <input type="text" name="nbrCalorie" placeholder="nombre des calories"/>
                        <input type="number" name="notation" placeholder="la notation"/>
                        
                    </div>
                    <div id="filterButton">
                        <input type="submit" name="Sign" value="Filtrer"/>
                    </div>
                </form>
            </div>
        <?php
    }

    // recuperer les regions 
    public function getRegionsView(){
        $controller = new Controller;
        return $controller->getRegionsController();
    }


    // filterer les recettes 
    public function filterRecipes(){
        $controller = new Controller;
            if(ISSET($_POST['categorie'])){
                if(ISSET($_SESSION['categorieNom'])){
                    if($_POST['categorie'] != $_SESSION['categorieNom']){
                        if($_POST['categorie'] != "tous"){
                            $_SESSION['RecipesFilter'] = $this->getRecipeByCategorieView($_POST['categorie'])->fetchAll(); 
                        }else{
                            $_SESSION['RecipesFilter'] =$controller->getRecipesController()->fetchAll(); 
                        }
                         
                    }else{
                            foreach($_SESSION['RecipesFilter'] as $recipe){
                                if(!(gettype(strpos($recipe['Categorie'],$_POST['categorie'])) == "integer")){
                                    if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                                        unset($_SESSION['RecipesFilter'][$key]);
                                    }
                                } 
                            } 
                    }
                }else{
                    if($_POST['categorie'] != "tous"){
                        foreach($_SESSION['RecipesFilter'] as $recipe){
                            if(!(gettype(strpos($recipe['Categorie'],$_POST['categorie'])) == "integer")){
                                if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                                    unset($_SESSION['RecipesFilter'][$key]);
                                }
                            } 
                        }
                    }                   
                }
            }
            if(ISSET($_POST['Region'])){  
                if($_POST['Region'] != "tous"){
                    foreach($_SESSION['RecipesFilter'] as $recipe){
                        $regionsRecipe = $this->getRegionRecipeView($recipe['RecipeID']);
                        $find = false;
                        foreach($regionsRecipe as $regionRecipe){
                            if($this->getRegionByIdView($regionRecipe['regionId'])->fetch()['regionNom']==$_POST['Region']){
                                $find = true;
                                break;
                            }
                        }
                        if($find == false){
                            if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                                unset($_SESSION['RecipesFilter'][$key]);
                            }
                        }
                    }
                }
            }
            if(ISSET($_POST['Saison'])){
                if($_POST['Saison']!="tous"){
                    foreach($_SESSION['RecipesFilter'] as $recipe){
                        if($this->verifySaisonView($recipe['RecipeID'],$_POST['Saison'])==0){
                            if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                                unset($_SESSION['RecipesFilter'][$key]);
                            }
                        }
                    }
                }
            }
            if(ISSET($_POST['Fete'])){
                if($_POST['Fete']!="tous"){
                    foreach($_SESSION['RecipesFilter'] as $recipe){
                        $holidaysRecipe = $this->getHolidayRecipeView($recipe['RecipeID']);
                        $find = false;
                        foreach($holidaysRecipe as $holidayRecipe){
                            if($this->getHolidayByIdView($holidayRecipe['HolidayID'])->fetch()['Holiday']==$_POST['Fete']){
                                $find = true;
                                break;
                            }
                        }
                        if($find == false){
                            if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                                unset($_SESSION['RecipesFilter'][$key]);
                            }
                        }
                    }  
                }  
            }
            if($_POST['timePrepare'] != ""){
                foreach($_SESSION['RecipesFilter'] as $recipe){
                    if(!($recipe['PrepareTime'] == $_POST['timePrepare'])){
                        if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                            unset($_SESSION['RecipesFilter'][$key]);
                        }
                    } 
                } 
            }
            if($_POST['timeCuisson'] != ""){
                foreach($_SESSION['RecipesFilter'] as $recipe){
                    if(!($recipe['CookingTime'] == $_POST['timeCuisson'])){
                        if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                            unset($_SESSION['RecipesFilter'][$key]);
                        }
                    } 
                } 
            }
            if($_POST['timeTotal'] != ""){
                foreach($_SESSION['RecipesFilter'] as $recipe){
                    if(!($recipe['TotalTime'] == $_POST['timeTotal'])){
                        if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                            unset($_SESSION['RecipesFilter'][$key]);
                        }
                    } 
                } 
            }
            if($_POST['nbrCalorie'] != ""){
                foreach($_SESSION['RecipesFilter'] as $recipe){        
                    if(!($recipe['calorieTotal'] == $_POST['nbrCalorie'])){
                        if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                            unset($_SESSION['RecipesFilter'][$key]);
                        }
                    } 
                } 
            }
            if($_POST['notation'] != ""){
                foreach($_SESSION['RecipesFilter'] as $recipe){
                    if(!($recipe['noteTotal'] == $_POST['notation'])){
                        if (($key = array_search($recipe,$_SESSION['RecipesFilter'])) !== false){
                            unset($_SESSION['RecipesFilter'][$key]);
                        }
                    } 
                } 
            }
            $_SESSION['Recipes'] = $_SESSION['RecipesFilter'];
            
    }
        // verifier une recette a une saison donnee
    public function verifySaisonView($recipeId,$Saison){
        $controller = new Controller;
        return $controller->verifySaisonController($recipeId,$Saison);
    }
        // Afficher la page du filter
        public function afficherSite(){
            $this->afficherFilterBar();
            ?>
                <div class="filterResult">
            <?php
                if(!empty($_SESSION['recipesIdea'])){
                    $_SESSION['Recipes'] = $_SESSION['recipesIdea'];
                    $_SESSION['RecipesSauvgarde'] = $_SESSION['Recipes'];
                    $_SESSION['categorieNom'] = null;
                    $_SESSION['recipesIdea'] = [];
                }else{
                    if(!empty($_SESSION['recipesCategorie'])){
                        $_SESSION['Recipes'] = $_SESSION['recipesCategorie']; 
                        $_SESSION['RecipesSauvgarde'] = $_SESSION['Recipes'];
                        $_SESSION['recipesCategorie'] = [];      
                    }else{
                        if(!empty($_SESSION['RecipesHealthy'])){
                            $_SESSION['Recipes'] = $_SESSION['RecipesHealthy']; 
                            $_SESSION['RecipesSauvgarde'] = $_SESSION['Recipes'];
                            $_SESSION['categorieNom'] = null;
                            $_SESSION['RecipesHealthy'] = [];  
                        }
                    }
                }
                
                foreach($_SESSION['Recipes'] as $recipe){
                    parent::afficherRecette($recipe);
                }
            ?>
                </div>
            <?php
        }
}
?>
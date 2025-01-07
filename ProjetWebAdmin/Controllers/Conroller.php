<?php 
require_once('../Models/Model.php');
require_once('../Views/View.php');
require_once('../Views/ViewRecipe.php');
require_once('../Views/ViewUser.php');
require_once('../Views/ViewNews.php');
require_once('../Views/ViewNutrition.php');
require_once('../Views/ViewParametre.php');
class Controller{
    // recuperer les diapos a afficher
    public function getDiaposController(){
        $modele = new Model();
        return $modele->getDiapos();
    }
    // recuperer les recettes par categorie
    public function getRecipeByCategorieController($categorie){
        $modele = new Model();
        return $modele->getRecipeByCategorie($categorie);
    }
     // recuperer les recettes par holiday
     public function getRecipeByHolidayController($holidayNom){
        $modele = new Model();
        $holidayId = $modele->getHolidayByName($holidayNom)->fetch()['HolidayID'];
        $holidays = $modele->getHolidaysById($holidayId);
        $recipes = [];
        foreach($holidays as $holiday){
            array_push($recipes,$modele->getRecipeById($holiday['RecipeID'])->fetch());
        }
        return $recipes;
    }
    // recuperer toutes les recettes
    public function getHealthyRecipesController(){
        $modele = new Model();
        return $modele->getHealthyRecipes();
    }
    // recuperer une recette by id
    public function getRecipeByIdController($recipId){
        $modele = new Model();
        return $modele->getRecipeById($recipId);
    }
    // recuperer une recette by id
    public function getAnyRecipeByIdController($recipId){
        $modele = new Model();
        return $modele->getAnyRecipeById($recipId);
    }
    // recuperer une news par id
    public function getNewByIdController($newId){
        $modele = new Model();
        return $modele->getNewById($newId);
    }
    // recuperer les news
    public function getNewsController(){
        $modele = new Model();
        return $modele->getNews();
    }
    // recuperer l'ingredient 
    public function getIngredientByIdController($ingredientId){
        $modele = new Model();
        return $modele->getIngredientById($ingredientId);
    }
    // recuperer les Etapes
    public function getStepsController($recipeId){
        $modele = new Model();
        return $modele->getSteps($recipeId);
    }
    // Verifier les cordonnes d'admin 
    public function verifyLogInContoller ($username , $motdepass){
        $modele = new Model();
        return $modele->verifyLogIn($username , $motdepass);
    }
    // Verifier les cordonnes d'admin 
    public function verifyLogInAdminContoller ($username , $motdepass){
        $modele = new Model();
        return $modele->verifyLogInAdmin($username , $motdepass);
    }
    // Creer un utilisateur 
    public function creatUserController($username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage){
        $modele = new Model();
        $modele->creatUser($username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage);
    }
    // modifier un utilisateur 
    public function updateUserController($userId,$username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage){
        $modele = new Model();
        $modele->updateUser($userId,$username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage);
    }
    // Recuperer les ingredients d'une recette
    public function getIngredientsRecipeController($recipId){
        $modele = new Model();
        return $modele->getIngredientsRecipe($recipId);
    }
    //Recuperer tous les ingredients 
    public function getIngredientsController(){
        $modele = new Model();
        return $modele->getIngredients();
    }
    // Recuperer menu
    public function getMenuController(){
        $modele = new Model();
        return $modele->getMenu();
    }
    // recuperer le pourcentage des ingredients pour satisfaire la recherch
    public function getPourcentageController(){
        $modele = new Model();
        return $modele->getPourcentage();
    } 
    // recuperer les regions 
    public function getRegionsController(){
        $modele = new Model();
        return $modele->getRegions();
    }
    // recuperer les fetes
    public function getHolidaysController(){
        $modele = new Model();
        return $modele->getHolidays();
    }
    // recuperer les categories
    public function getCategoriesController(){
        $modele = new Model();
        return $modele->getCategories();
    }
    // recuperer une region par id
    public function getRegionByIdController($regionId){
        $modele = new Model();
        return $modele->getRegionById($regionId);
        }
    // recuperer la region d'une recette
    public function getRegionRecipeController($recipeId){
    $modele = new Model();
    return $modele->getRegionRecipe($recipeId);
    }
    // recuperer une fete par id
    public function getHolidayByIdController($holidayId){
        $modele = new Model();
        return $modele->getHolidayById($holidayId);
        }
    // recuperer la region d'une recette
    public function getHolidayRecipeController($recipeId){
        $modele = new Model();
        return $modele->getHolidayRecipe($recipeId);
        }
    // verifier une recette a une saison donnee
    public function verifySaisonController($recipeId,$Saison){
        $modele = new Model();
        return $modele->verifySaison($recipeId,$Saison);
    }
    // recupere les recettes par saison
    public function getRecipeSaisonController($Saison){
        $modele = new Model();
        return $modele->getRecipeSaison($Saison);
    }
    // remove save 
    public function removeSave($recipeId,$userId){
        $modele = new Model();
        return $modele->removeSave($recipeId,$userId);
    }
    // add save 
    public function addSave($recipeId,$userId){
        $modele = new Model();
        return $modele->addSave($recipeId,$userId);
    }
    // get save 
    public function getSave($recipeId,$userId){
        $modele = new Model();
        return $modele->getSave($recipeId,$userId);
    }
    // get save 
    public function getSaves($userId){
        $modele = new Model();
        return $modele->getSaves($userId);
    }
    // remove Like 
    public function removeLike($recipeId,$userId){
        $modele = new Model();
        return $modele->removeLike($recipeId,$userId);
    }
    // add Like 
    public function addLike($recipeId,$userId){
        $modele = new Model();
        return $modele->addLike($recipeId,$userId);
    }
    // get Like 
    public function getLike($recipeId,$userId){
        $modele = new Model();
        return $modele->getLike($recipeId,$userId);
    }
    // get Likes 
    public function getLikes($userId){
        $modele = new Model();
        return $modele->getLikes($userId);
    }

    public function creatStepController($recipeId,$step,$i){
        $modele= new Model();
        return $modele->creatStep($recipeId,$step,$i);
    }
    public function creatIngredientRecipeController($recipeId,$ingredientid,$ingredientQuant,$ingredientUnite,$ingredientMethod){
        $modele= new Model();
        return $modele->creatIngredientRecipe($recipeId,$ingredientid,$ingredientQuant,$ingredientUnite,$ingredientMethod);
    }
    public function getNumRow($table,$column){
        $modele = new Model();
        return $modele->getNumRow($table,$column);
    }
    // creer une recette 
    public function creatRecipe($recipeId,$recipeImage,$adminId,$userId,$difficult,$preparTime,$restTime,$coockingTime,$TotalTime,$video,$recipeName,$recipeDescription,$categorie,$note,$Saison,$calorieTotal,$confirmed){
        $modele = new Model();
        return $modele->creatRecipe($recipeId,$recipeImage,$adminId,$userId,$difficult,$preparTime,$restTime,$coockingTime,$TotalTime,$video,$recipeName,$recipeDescription,$categorie,$note,$Saison,$calorieTotal,$confirmed);
    }

    // recuperer toutes les recettes
    public function getRecipesController(){
        $modele = new Model();
        return $modele->getRecipes()->fetchAll();
    }
    // ajouter une recette a une region
    public function addRegionRecipe($recipeId,$regionId){
        $modele = new Model();
        return $modele->addRegionRecipe($recipeId,$regionId);
    }
    // manage add recipe form
    public function addRecipeForm(){
        if(isset($_POST['addRecipe']) or isset($_POST['AddStep']) or isset($_POST['SuppSte'])){
            if(isset($_POST['name'])){
                $_SESSION['name']=$_POST['name'];
            }
            if(isset($_POST['prepare'])){
                $_SESSION['prepare']=$_POST['prepare'];
            }
            if(isset($_POST['coocking'])){
                $_SESSION['coocking']=$_POST['coocking'];
            }
            if(isset($_POST['rest'])){
                $_SESSION['rest']=$_POST['rest'];
            }
            if(isset($_POST['video'])){
                $_SESSION['video']=$_POST['video'];
            }
            if(isset($_POST['pic'])){
                $_SESSION['pic']=$_POST['pic'];
            }
            if(isset($_POST['Region'])){
                $_SESSION['Region']=$_POST['Region'];
            }
            if(isset($_POST['categorie'])){
                $_SESSION['categorie']=$_POST['categorie'];
            }
            if(isset($_POST['description'])){
                $_SESSION['description']=$_POST['description'];
            }
            if(isset($_POST['Region'])){
                $_SESSION['Region']=$_POST['Region'];
            }
            if(isset($_POST['Difficulte'])){
                $_SESSION['Difficulte']=$_POST['Difficulte'];
            }
            

        }
    }
    // ajouter une etape
    public function addStep(){
        if(isset($_POST['AddStep'])){
            if($_POST['Step'] != ""){
                if(isset($_SESSION['Steps'])){
                    array_push($_SESSION['Steps'],$_POST['Step']); 
                    $_SESSION['Steps'] = array_unique($_SESSION['Steps']);
                }else{
                    $_SESSION['Steps'] = [$_POST['Step']];
                }
            }else{
                echo "<script>alert('veuillez remplier le champ etap svp !')</script>";
            }

            
        }
    }
    // supprimer une etape
    public function removeStep(){
        if(isset($_POST['SuppSte'])){
            if (($key = array_search($_POST['stepSup'],$_SESSION['Steps'])) !== false){
                unset($_SESSION['Steps'][$key]);
            }
            
        }
    }
    // ajouter un ingredient
    public function addIngredient(){
        if(isset($_POST['addIngredient'])){
           // echo "<script>alert('')</script>";
            if($_POST['quantite']!="" and $_POST['UnitQuantite']!="" and $_POST['MethoCoocking']!="" and $_POST['ingrdient']!=""){
                $arrayIngredient= explode("|", $_POST['ingrdient'] );
                $ingredientId = $arrayIngredient[1];
                $ingredientName = $arrayIngredient[0];
                $calorie = $arrayIngredient[2];
                $arr = ['id'=>$ingredientId,
                        'ing'=>$ingredientName,
                        'qunt'=>$_POST['quantite'],
                        'unite'=>$_POST['UnitQuantite'],
                        'method'=>$_POST['MethoCoocking'],
                        'calorie'=>$calorie];
                if(isset($_SESSION['Ings'])){
                    array_push($_SESSION['Ings'],$arr); 
                }else{
                    $_SESSION['Ings'] = [$arr];
                }
            }else{
                echo "<script>alert('veuillez remplier touts les champs !')</script>";
            }
            
        }
    }
    // supprimer un ingredient
    public function removeIngredient(){
        if(isset($_POST['suprIng'])){
            $arr = ['id'=>$_POST['ingredientId'],
                    'ing'=>$_POST['ingredientName'],
                    'qunt'=>$_POST['ingredientQuantite'],
                    'unite'=>$_POST['uniteQuantite'],
                    'method'=>$_POST['methodCoocking'],
                    'calorie'=>$_POST['calorie']];
            if (($key = array_search($arr,$_SESSION['Ings'])) !== false){
                unset($_SESSION['Ings'][$key]);
            }
            
        }
    }
    // liberer les variables contenant les infos du recette
    public function clearSession(){
        $_SESSION['name']= null;
        $_SESSION['prepare']= null;
        $_SESSION['coocking']= null;
        $_SESSION['rest']= null;
        $_SESSION['video']= null;
        $_SESSION['pic']= null;
        $_SESSION['Region']= null;
        $_SESSION['categorie']= null;
        $_SESSION['description']= null;
        $_SESSION['Difficulte']= null;
        $_SESSION['Ings'] = [];
        $_SESSION['Steps'] = [];
    } 
    // recuperer la recette
    public function creerRecette(){
        $model = new Model;
        if(isset($_POST['addRecipe'])){
            $recipeId = $this->getNumRow('recipe','RecipeID')+1;
            $i=1;
            $calorieTotal = 0;
            //$controll->creatRecipeController();
            foreach($_SESSION['Steps'] as $step){
                $this->creatStepController($recipeId,$step,$i);
                $i++;
            }
            foreach($_SESSION['Ings'] as $ingredient){
                $calorieTotal = $calorieTotal +$ingredient['calorie'];
                $this->creatIngredientRecipeController($recipeId,$ingredient['id'],$ingredient['qunt'],$ingredient['unite'],$ingredient['method']);
            }

            $hp =intval(substr($_SESSION['prepare'],0,1));
            $hc =intval(substr($_SESSION['coocking'],0,1));
            $hr =intval(substr($_SESSION['rest'],0,1));
            $ht = $hp + $hc + $hr;
            $mp =intval(substr($_SESSION['prepare'],3));
            $mc =intval(substr($_SESSION['coocking'],3));
            $mr =intval(substr($_SESSION['rest'],3));
            $mt = $mp + $mc + $mr;
            $TotalTime = "$ht:$mt";
            $this->creatRecipe($recipeId,$_SESSION['pic'],null,null,1,$_SESSION['prepare'],$_SESSION['rest'],$_SESSION['coocking'],$TotalTime,$_SESSION['video'],"Images/recipeImages/".$_SESSION['name'],$_SESSION['description'],$_SESSION['categorie'],0,"printemps",$calorieTotal,1);
            foreach($_SESSION['Region'] as $region){
                $model->addRegionRecipe($recipeId,$region);
            }
            $this->clearSession();
        }
    }
    // controller l'etat de la recette
    public function changeRecipeStatus(){
        $model = new Model;
        if(isset($_POST['state'])){
            $model->updateRecipeState($_POST['RecipeID']);
        }
    }
    // Supprimer la recette
    public function deletRecipe(){
        $model = new Model;
        if(isset($_POST['deletRecipe'])){
            $model->deleteRecipe($_POST['RecipeID']);
        }
    }
    // modifier la recette
    public function modifyRecipe(){
        $model = new Model;
        if(isset($_POST['modifyRecipe'])){
            $recipe = $this->getAnyRecipeByIdController($_POST['RecipeID'])->fetch();
            $_SESSION['RecipeID']=$_POST['RecipeID'];
            $_SESSION['name']= $recipe['RecipeNom'];
            $_SESSION['prepare']= $recipe['PrepareTime'];
            $_SESSION['coocking']= $recipe['CookingTime'];
            $_SESSION['rest']= $recipe['RestTime'];
            $_SESSION['video']= $recipe['Video'];
            $_SESSION['pic']= $recipe['Image'];
            $_SESSION['categorie']= $recipe['Categorie'];
            $_SESSION['description']= $recipe['RecipeDescription'];
            $steps = $this->getStepsController($_POST['RecipeID']);
            foreach($steps as $step){
                array_push($_SESSION['Steps'],$step['StepDescription']);
            }
            $Ings = $this->getIngredientsRecipeController($_POST['RecipeID'])->fetchAll();
            foreach($Ings as $ing){
                $ingredient = $this->getIngredientByIdController($ing['IngredientID'])->fetch();
                $arr = ['id'=>$ingredient['IngredientID'],
                    'ing'=>$ingredient['IngredientName'],
                    'qunt'=>$ing['Quantite'],
                    'unite'=>$ing['UniteQuantite'],
                    'method'=>$ing['CoockingMethod'],
                    'calorie'=>$ingredient['Calorie']];
                    array_push($_SESSION['Ings'],$arr);
            }
            //$_SESSION['Ings'] = $this->getIngredientsRecipeController($_POST['RecipeID'])->fetchAll();
            //$_SESSION['steps'] = $this->getStepsController($_POST['RecipeID'])->fetchAll();
        }
        if(isset($_POST['updateRecipe'])){
            $recipe = $this->getAnyRecipeByIdController($_SESSION['RecipeID'])->fetch();
            $calorieTotal = 0;
            foreach($_SESSION['Ings'] as $ingredient){
                $calorieTotal = $calorieTotal +$ingredient['calorie'];
            }
            $hp =intval(substr($_SESSION['prepare'],0,1));
            $hc =intval(substr($_SESSION['coocking'],0,1));
            $hr =intval(substr($_SESSION['rest'],0,1));
            $ht = $hp + $hc + $hr;
            $mp =intval(substr($_SESSION['prepare'],3));
            $mc =intval(substr($_SESSION['coocking'],3));
            $mr =intval(substr($_SESSION['rest'],3));
            $mt = $mp + $mc + $mr;
            $TotalTime = "$ht:$mt";
            $model->updateRecipe($_SESSION['RecipeID'],$_POST['pic'],$recipe['AdminID'],$recipe['UserID'],$_POST['prepare'],
            $_POST['rest'], $_POST['coocking'],$TotalTime,$_POST['video'],$_POST['name'],$_POST['description'],$_POST['categorie'],$recipe['noteTotal'],$recipe['Saison'],$calorieTotal,$recipe['confirmed']);
            $this->clearSession();
        }
    }
    // supprimer un utilisateur
    public function deletUser(){
        $model = new Model;
        if(isset($_POST['deletUser'])){
            $model->deletUser($_POST['userId']);
        }
    }
    // valide l'inscription 
    public function updateUserState(){
        $model = new Model;
        if(isset($_POST['state'])){
            $model->updateUserState($_POST['userId']);
        }
    }
    // Recuperer les cordonnes de l'utilisateur pour Log-in 
    public function getUsers ($column){
        $model = new Model;
        return $model->getAllUsers($column);
    }
    // trier les utilisateurs
    public function filterUser(){
        if(isset($_POST['recherchColumn'])){
            return $this->getUsers($_POST['column']);
        }else{
            return $this->getUsers('UserID');
        }
    }
    // ajouter un news
    public function addNews(){
        $model = new Model;
        if(isset($_POST['addNew'])){
            if(isset($_SESSION['admin'])){
                $model->addNews("Images/newsImages/".$_POST['ImageNew'],$_SESSION['admin']['AdminID'],$_POST['NewTitle'],$_POST['Video'],$_POST['NewDescription']);

            }else{
                echo "<script>alert('tu dois etre authentifier pour ajouter une news, revenir au RouterPrincipal pour authentification')</script>";
            }
        }
    }
    // supprimer un news
    public function deleteNews(){
        $model = new Model;
        if(isset($_POST['deletNew'])){
            $model->deletNews($_POST['newId']);
        }
    }
        // Ajouter un ingredient
    public function addIngredientAdmin(){
        $model = new Model;
        if(isset($_POST['addIngredient'])){
            $saison="";
            foreach($_POST['saison'] as $s){
                $saison = $saison.$s." ";
            }
            $model->addIngredientAdmin($_POST['IngredientName'],$saison,$_POST['Halthy'],$_POST['ImageIngredient']
            ,$_POST['Calories'],$_POST['Glucide'],$_POST['Lipide'],$_POST['Proteine'],$_POST['Vitamine']);
        }
    }
    // supprimer un ingredient
    public function deleteIngredient(){
        $model = new Model;
        if(isset($_POST['deletIngredient'])){
            $model->deleteIngredient($_POST['ingredientId']);
        }
    }
    // modifier un ingredient
    public function updateIngredient(){
        $model = new Model;
        if(isset($_POST['modifyIngredient'])){
            $model->updateIngredient($_POST['ingredientId'],$_POST['IngredientName'],$_POST['Saison'],$_POST['Halthy'],
            $_POST['Calorie'],$_POST['Glucide'],$_POST['Lipide'],$_POST['Proteine'],$_POST['Vitamine']);
        }
    }
   // supprimer une diapo
   public function deleteDiapo(){
        $model = new Model;
        if(isset($_POST['deletDiapo'])){
            $model->deleteDiapo($_POST['diapoId']);
        }
    }
       // ajouter une diapo
   public function addDiapo(){
        $model = new Model;
        if(isset($_POST['addDiapo'])){
            if($_POST['type']=="recipe"){
                if($_POST['recette']!=""){
                    $model->addDiapo($_POST['type'],$_POST['recette']);
                }else{
                    echo "<script>alert('Veuillez choissir une recette')</script>";
                }
            }else{
                if($_POST['new']!=""){
                    $model->addDiapo($_POST['type'],$_POST['new']);
                }else{
                    echo "<script>alert('Veuillez choissir une news')</script>";
                }
            }
        }
    }
    // recuperer les parametres
    public function getParametres(){
        $model = new Model;
        return $model->getParametres();
    }
    // recuperer les parametres
    public function addParametres(){
        $model = new Model;
        if(isset($_POST['addParametre'])){
            if($_POST['parametreNom']!="" and $_POST['parametreValue']!=""){

            }
            $model->addParametres($_POST['parametreNom'],$_POST['parametreValue']);
        }
    }
    // recuperer les parametres
    public function updateParametres(){
        $model = new Model;
        if(isset($_POST['updateParam'])){
            $model->updateParametres($_POST['parametreId'],$_POST['parametreNomtable'],$_POST['parametreValuetable']);
        }
    }
    // recuperer les parametres
    public function deleteParametres(){
        $model = new Model;
        if(isset($_POST['deletParam'])){
            $model->deleteParametres($_POST['parametreId']);
        }
        return $model->getParametres();
    }
        // Afficher le site
    public function affichereSite(){
        $vue= new View();
        $vue->afficherSite();
    }
    // afficher la page gestion des recttes
    public function affichereRecipe(){
        $vueRecipe= new ViewRecipe();
        $vueRecipe->afficherSite();
    }
    // afficher la page gestion des utilisateurs
    public function affichereUser(){
        $vueUser= new ViewUser();
        $vueUser->afficherSite();
    }
    // afficher la page gestion des news
    public function affichereNews(){
        $vueNews= new ViewNews();
        $vueNews->afficherSite();
    }
    // afficher la page gestion des nutritions
    public function affichereNutrition(){
        $vueNutrition= new ViewNutrition();
        $vueNutrition->afficherSite();
    }
    // afficher la page gestion des nutritions
    public function affichereParametre(){
        $vueParametre= new ViewParametre();
        $vueParametre->afficherSite();
    }

}
?>
<?php 
require_once('Models/Model.php');
require_once('Views/View.php');
require_once('Views/ViewProfil.php');
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
    public function getRecipesController(){
        $modele = new Model();
        return $modele->getRecipes();
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
    // Verifier les cordonnes d'utilisateur 
    public function verifyLogInContoller ($username , $motdepass){
        $modele = new Model();
        return $modele->verifyLogIn($username , $motdepass);
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
    public function reaction(){
        $controlleur = new Controller;
        if(ISSET($_POST['save'])){
                if($controlleur->getSave($_SESSION['recipe'],$_SESSION['user']['UserID'])>0){
                    $controlleur->removeSave($_SESSION['recipe'],$_SESSION['user']['UserID']);
                }else{
                    $controlleur->addSave($_SESSION['recipe'],$_SESSION['user']['UserID']);
                }
        }
        if(ISSET($_POST['like'])){
                if($controlleur->getLike($_SESSION['recipe'],$_SESSION['user']['UserID'])>0){
                    $controlleur->removeLike($_SESSION['recipe'],$_SESSION['user']['UserID']);
                }else{
                    $controlleur->addLike($_SESSION['recipe'],$_SESSION['user']['UserID']);
                }        
        }
    }
    // get mark 
    public function getMark($userId , $recipeID){
        $modele = new Model();
        return $modele->getMark($userId , $recipeID);
    }
    // add mark
    public function addMark(){
        $model = new Model;
            $noteId = $_SESSION['user'];
            if(isset($_POST['noteSubmit'])){
                if($model->getMark($noteId['UserID'],$_SESSION['recipe'])->rowCount() == 0){
                    $model->addMark($noteId['UserID'],$_SESSION['recipe'],$_POST['note']);
                }else{
                    $noteId = $model->getMark($noteId['UserID'],$_SESSION['recipe'])->fetch()['NoteID'];
                    $model->modifierMark($noteId,$_POST['note']);
                }
            }
    }
    // add mark
    public function modifierMark($noteId , $note){
        $modele = new Model();
        return $modele->modifierMark($noteId , $note);
    }
    // Afficher le site
    public function affichereSite(){
        $vue= new View();
        $vue->afficherSite();
    }
    // Afficher le site
    public function affichereSiteProfile(){
        $vueProfil= new ViewProfil();
        $vueProfil->afficherSite();
    }
    

}
?>
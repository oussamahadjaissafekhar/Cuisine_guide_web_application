<?php
require_once('Controllers/Conroller.php');
require_once('Views/ViewLogIn.php');
require_once("Views/ViewSingUp.php");
require_once("Views/ViewAcceuil.php");
require_once("Views/ViewRecipeIdea.php");
require_once("Views/ViewFilter.php");
require_once("Views/ViewSaison.php");
require_once("Views/ViewFete.php");
require_once("Views/ViewNews.php");
require_once("Views/ViewRecipe.php");
require_once("Views/ViewNutrition.php");
require_once('Views/ViewNew.php');
require_once('Views/ViewAllNews.php');

class View{

    // Crer l'entet du page
    public function headHtml (){
        
        ?>
        <!DOCTYPE html>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="Css/css.css">
            
            
        <?php
            if(isset($_SESSION['page'])){
                switch($_SESSION['page']){
                    case "LogIn":
                        $viewLogIn = new ViewLogIn;
                        $viewLogIn->headHtml();
                        break;
                    case "SignUp":
                        $viewSingUp = new ViewSingUp;
                        $viewSingUp->headHtml();
                        break;
                    case "Acceuil":
                        $viewAcceuil = new ViewAcceuil;
                        $viewAcceuil->headHtml();
                        break;
                    case "RecetteIdee":
                        $viewRecetteIdee = new ViewRecipeIdea;
                        $viewRecetteIdee->headHtml();
                        break;
                    case "Filter":
                        $viewFilter = new ViewFilter;
                        $viewFilter->headHtml();
                        break;
                    case "Healthy":
                        $viewFilter = new ViewFilter;
                        $viewFilter->headHtml();
                        break;
                    case "Saison":
                        $viewSaison = new ViewSaison;
                        $viewSaison->headHtml();
                        break;
                    case "Fete":
                        $viewFete = new ViewFete;
                        $viewFete->headHtml();
                        break;
                    case "News" :
                        $viewNews = new ViewNews;
                        $viewNews->headHtml();
                        break;
                    case "New":
                        $viewNew = new ViewNew;
                        $viewNew->headHtml();
                        break;
                    case "AllNews":
                        $viewAllNews = new ViewAllNews;
                        $viewAllNews->headHtml();
                        break;
                    case "Recipe":
                        $viewRecipe = new ViewRecipe;
                        $viewRecipe->headHtml();
                        break;
                    case "Nutrition":
                        $viewNutrition = new ViewNutrition;
                        $viewNutrition->headHtml();
                        break;
                    
                }
            }else{
                $viewAcceuil = new ViewAcceuil;
                $viewAcceuil->headHtml();
            }
        ?>
            </head>
        <?php
    }

    public function headerPage(){
        ?>
        <body>
            <div class="header">
                <div class="headerTop">
                    <img class="logo" src="Images/logo"/>
                    <img class="contact" src="Images/contact"/>
                </div>
                <div class="headerBottom">
                    <ul class="menu">
                        <?php
                            $controlleur = new Controller;
                            $menu = $controlleur->getMenuController();
                            $i = 1;
                            foreach($menu as $menuElement){
                                echo"<li class='menuItem'><a href='router.php?link=$i' name='link'>$menuElement[MenuElement]</a></li>";
                                $i++;
                            }
                        ?>
                    </ul>
                    <img id="profilIcon" src="Images/profileImages/profilIcon"/>
                </div>
            </div>
        <?php
            if(!isset($_SESSION['user'])){
                $_SESSION['user'] = "";
                $_SESSION['connected'] = false;
            }
            $this->comptePopUp($_SESSION['user']);
    }
    public function footerPage(){
        ?>
                <div class="footer">
                    <ul class="menuFooter">
                        <?php
                        $controlleur = new Controller;
                        $menu = $controlleur->getMenuController();
                        $i = 1;
                        foreach($menu as $menuElement){
                            echo"<li class='menuItemFooter'><a href='router.php?link=$i' name='link'>$menuElement[MenuElement]</a></li>";
                            $i++;
                        }
                        ?>
                    </ul>
                </div>
            </body>
        <?php
    }
// Set le variable globale $_SESSION['page'] pour afficher la page choissi
    public function setPage()
    {
        $controller = new Controller;
        if(isset($_GET['link'])){
            switch($_GET['link']){
                case '1':
                    $_SESSION['page'] = 'Acceuil';
                    break;
                case '2':
                    $_SESSION['page'] = 'RecetteIdee';
                    unset($_GET['link']);
                    break;  
                case '3':
                    $_SESSION['page'] = 'News';
                    unset($_GET['link']);
                    break;               
                case '4':
                    $_SESSION['RecipesHealthy'] = $controller->getHealthyRecipesController()->fetchAll();
                    $_SESSION['page'] = 'Filter';
                    unset($_GET['link']);
                    break;      
                case '5':
                    $_SESSION['page'] = 'Saison';
                    unset($_GET['link']);
                    break;
                case '6':
                    $_SESSION['page'] = 'Fete';
                    unset($_GET['link']);
                    break;
                case '7':
                    $_SESSION['page'] = 'Nutrition';
                    unset($_GET['link']);
                    break;
                case '9':
                    $_SESSION['page'] = 'AllNews';
                    unset($_GET['link']);
                    break;
                default :
                    switch($_GET['link'][0]){
                        case 'r':
                            $_SESSION['recipe'] = substr($_GET['link'],1);
                            $_SESSION['page'] = 'Recipe';
                            break;
                        case 'n':
                            $_SESSION['new'] = substr($_GET['link'],1);
                            $_SESSION['page'] = 'New';
                            break;
                        case 'g':
                            $_SESSION['categorieNom'] = substr($_GET['link'],1);
                            $_SESSION['recipesCategorie']= $this->getRecipeByCategorieView($_SESSION['categorieNom'])->fetchAll();            
                            $_SESSION['page'] = 'Filter';
                            break;
                    }
                    break;
            }
            header ("location:./router.php");
            exit;
        }
        if(isset($_POST['Sign'])){
            switch($_POST['Sign']){
                case "Sign-in":
                    $_SESSION['page'] = 'LogIn';
                    unset($_POST['Sign']);
                    break;
                case "Sign-up":
                    $_SESSION['page'] = 'SignUp';
                    unset($_POST['Sign']);
                    break;
                case "Deconnexion":
                    unset($_SESSION['user']);
                    $_SESSION['connected'] = false;
                    $_SESSION['page'] = 'Acceuil';
                    break;
                case "Rechercher":
                    $viewRecetteIdee = new ViewRecipeIdea;
                    $viewRecetteIdee->rechercher();
                    $_SESSION['page'] = 'Filter';
                    unset($_POST['Sign']);
                    break;
                case "Filtrer":
                    $_SESSION['RecipesFilter'] = $_SESSION['RecipesSauvgarde'];
                    $viewFilter = new ViewFilter;
                    $viewFilter->filterRecipes();
                    break;
                case "Profil":
                    header ("location:./routerProfil.php");
                    break;
            }
            }
    }

    public function afficherSite(){
        $this->setPage();
        $this->headHtml();
        $this->headerPage();
        if(isset($_SESSION['page'])){
            switch($_SESSION['page']){
                case "LogIn":
                    $viewLogIn = new ViewLogIn;
                    $viewLogIn->afficherSite();
                    $viewLogIn->verifyLogInView();
                    break;
                case "SignUp":
                    $viewSingUp = new ViewSingUp;
                    $viewSingUp->afficherSite();
                    $viewSingUp->creatUserView();
                    break;
                case "Acceuil":
                    $viewAcceuil = new ViewAcceuil;
                    $viewAcceuil->afficherSite();
                    break;
                case "RecetteIdee":
                    $viewRecetteIdee = new ViewRecipeIdea;
                    $viewRecetteIdee->afficherSite();
                    break;
                case "Filter":
                    $viewFilter = new ViewFilter;
                    $viewFilter->afficherSite();
                    break;
                case "Saison":
                    $viewSaison = new ViewSaison;
                    $viewSaison->afficherSite();
                    break;
                case "Fete":
                    $viewFete = new ViewFete;
                    $viewFete->afficherSite();
                    break;
                case "News":
                    $viewNews = new ViewNews;
                    $viewNews->afficherSite();
                    break;
                case "New":
                    $viewNew = new ViewNew;
                    $viewNew->afficherSite();
                    break;
                case "Recipe":
                    $viewRecipe = new ViewRecipe;
                    $viewRecipe->afficherSite();
                    break;
                case "Nutrition":
                    $viewNutrition = new ViewNutrition;
                    $viewNutrition->afficherSite();
                    break;
                case "AllNews":
                    $viewAllNews = new ViewAllNews;
                    $viewAllNews->afficherSite();
                    break;
                
            }
        }else{
            $viewAcceuil = new ViewAcceuil;
            $viewAcceuil->afficherSite();  
        }
        $this->footerPage();
    }








        // Afficher une recette 
        public function afficherRecette($recipe){

            echo "  <div class='carte'>
                        <img class='carteImage' src='$recipe[Image]'/>
                        <div id='carteDescription'>
                            <h2 class='carteTitle'>$recipe[RecipeNom]</h2>
                            <p class='carteParagraphe'>$recipe[RecipeDescription]</p>
                        </div>
                        <div class='carteBottom'>
                            <a class='carteLink' href='router.php?link=r$recipe[RecipeID]' name='link'>afficher la suite</a>";
                            if(isset($_SESSION['connected'])){
                                if($_SESSION['connected']==true){
                                    $this->afficherNotation($recipe);
                                }
                                
                            }
            echo "      </div>
                    </div>" ;
        }
        // afficher new
        public function afficherNew($new){

            echo "  <div class='carte'>
                        <img class='carteImage' src='$new[ImageNew]'/>
                        <div id='carteDescription'>
                            <h2 class='carteTitle'>$new[NewTitle]</h2>
                            <p class='carteParagraphe'>$new[NewDescription]</p>
                        </div>
                        <div class='carteBottom'>
                            <a class='carteLink' href='router.php?link=n$new[NewID]' name='link'>afficher la suite</a>";
            echo "      </div>
                    </div>" ;
        }
        // afficher rating 
        public function afficherNotation($recipe){
            echo "<div class='rating'>";
            for($i=0; $i<$recipe['noteTotal'];$i++){
                echo "  <img class='ratingStar' src='Images/star.png'/>";
            }
            echo "</div>";
        }

        // aficher pop up du connexion
        public function comptePopUp($user){
            if($_SESSION['connected']){
                echo "  <form id='comptePopUp' style='display: none;' method='POST'>
                                        <img src='$user[ProfilPicture]'/>
                                        <h2>$user[Nom] $user[Prenom]</h2>
                                        <h3>$user[Mail]</h3>
                                        <input type='submit' value='Deconnexion' name='Sign'/>
                                        <input type='submit' value='Profil' name='Sign'/>
                                    </form>";
            }else {
                echo "  <form id='comptePopUp' style='display: none;' method='POST'>
                            <img src='Images/profileImages/profilIcon'/>
                            <h2>Guest User</h2>
                            <input type='submit' value='Sign-in' name='Sign'/>
                            <input type='submit' value='Sign-up' name='Sign'/>
                        </form>";
            }
            
        }

        // afficher diaporama
    public function diaporama(){
        ?>
            <div class="diaporama">
                <div class="buttonSlide" id="buttonSlidePrevious">
                    <img src="Images/previous.png"/>
                </div>
                <div class="slideShow">
                    <?php
                        $controller = new Controller;
                        $news = $controller->getNewsController();
                        $slides = $controller->getDiaposController();
                        foreach($slides as $slide){
                            $this->slideDiaporama($slide);
                        }                    
                    ?>
                </div>
                <div class="buttonSlide" id="buttonSlideNext">
                    <img src="Images/next.png"/>
                </div>
            </div>
        <?php
    }
    // afficher un new dans diaporama
    public function slideDiaporama($slide){
        $controller = new Controller;
        if($slide['type']=='new'){
            $new = $controller->getNewByIdController($slide['id'])->fetch();
            echo "  <div class='slide'>
                        <a href='router.php?link=n$new[NewID]' name='link'><img  src='$new[ImageNew]'/></a>
                    </div>";
        }else{
            $recipe = $controller->getRecipeByIdController($slide['id'])->fetch();
            echo "  <div class='slide'>
                        <a href='router.php?link=r$recipe[RecipeID]' name='link'><img  src='$recipe[Image]'/></a>
                    </div>";
        }

    }
    // recuperer les recettes par categories 
    public function getRecipeByCategorieView($categorieNom){
        $controlleur = new Controller();
        return $controlleur->getRecipeByCategorieController($categorieNom);
    }
    // recuperer les categories 
    public function getCategoriesView(){
        $controller = new Controller;
        return $controller->getCategoriesController();
    }
    // recuperer la region d'une recette
    public function getRegionByIdView($regionId){
        $controller = new Controller;
        return $controller->getRegionByIdController($regionId);
    }
    // recuperer la region d'une recette
    public function getRegionRecipeView($recipeId){
        $controller = new Controller;
        return $controller->getRegionRecipeController($recipeId);
    }
    // recuperer la region d'une recette
    public function getHolidayByIdView($holidayId){
        $controller = new Controller;
        return $controller->getHolidayByIdController($holidayId);
    }
    // recuperer la region d'une recette
    public function getHolidayRecipeView($recipeId){
        $controller = new Controller;
        return $controller->getHolidayRecipeController($recipeId);
    }
    // recuperer les fetes 
    public function getHolidaysView(){
        $controller = new Controller;
        return $controller->getHolidaysController();
    }
    // recuperer les ingridients
    public function getIngredientsView(){
        $controller = new Controller;
        return $controller->getIngredientsController();
    }

}
?>
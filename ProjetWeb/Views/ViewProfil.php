<?php
require_once('Controllers/Conroller.php');
require_once('Views/ViewInformation.php');
require_once('Views/ViewAimer.php');
require_once('Views/ViewSauvgarder.php');
require_once('Views/ViewAddRecipeUser.php');

class ViewProfil{

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
                    case "Information":
                        $viewInfo = new ViewInformation;
                        $viewInfo->headHtml();
                        break;
                    case "Aimer":
                        $viewAimer = new ViewAimer;
                        $viewAimer->headHtml();
                        break;
                    case "Sauvgarder":
                        $viewSauv = new ViewSauvgarder;
                        $viewSauv->headHtml();
                        break;  
                    case "newRecipe":
                        $viewAdd = new ViewAddRecipeUser;
                        $viewAdd->headHtml();
                        break;    
                }
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
                        <li class="menuItem"><a href='router.php?link=1' name='link'>Acceuil</a></li>
                        <li class="menuItem"><a href='?link=1' name='link'>Information personnel</a></li>
                        <li class="menuItem"><a href='?link=2' name='link'>Aimees</a></li>
                        <li class="menuItem"><a href='?link=3' name='link'>Sauvgardees</a></li>
                        <li class="menuItem"><a href='?link=4' name='link'>Creer recettes</a></li>
                    </ul>
                    <img id="profilIcon" src="Images/profileImages/profilIcon"/>
                </div>
            </div>
        <?php
            if(!isset($_SESSION['connected'])){
                $_SESSION['user'] = "";
                $_SESSION['connected'] = false;
            }
            $this->comptePopUp($_SESSION['user']);
    }
    public function footerPage(){
        ?>
                <div class="footer">
                    <ul class="menuFooter">
                        <li class='menuItemFooter'><a href='router.php?link=1' name='link'>Acceuil</a></li>
                        <li class='menuItemFooter'><a href='?link=1' name='link'>Information personnel</a></li>
                        <li class='menuItemFooter'><a href='?link=2' name='link'>Aimer</a></li>
                        <li class='menuItemFooter'><a href='?link=3' name='link'>Sauvgarder</a></li>    
                        <li class="menuItemFooter"><a href='?link=4' name='link'>Creer recettes</a></li>
                    </ul>
                </div>
            </body>
        <?php
    }
// Set le variable globale $_SESSION['page'] pour afficher la page choissi
    public function setPage()
    {
        $cont = new Controller;
        if(isset($_GET['link'])){
            switch($_GET['link']){
                case '1':
                    $_SESSION['page'] = 'Information';
                    break;
                case '2':
                    $_SESSION['page'] = 'Aimer';
                    break;
                case '3':
                    $_SESSION['page'] = 'Sauvgarder';
                    break;
                case '4':
                    $_SESSION['page'] = 'newRecipe';
                    break;
            }
            header ("location:./routerProfil.php");
            exit;
        }
        if(isset($_POST['AddRecipe'])){
            switch($_POST['AddRecipe']){
                case 'Suivant':
                    $this->verifyStepNum();
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
                case "Information":
                    $viewInfo = new ViewInformation;
                    $viewInfo->afficherSite();
                    break;
                case "Aimer":
                    $viewAimer = new ViewAimer;
                    $viewAimer->afficherSite();
                    break;
                case "Sauvgarder":
                    $viewSauv = new ViewSauvgarder;
                    $viewSauv->afficherSite();
                    break;
                case "newRecipe":
                    $viewAdd = new ViewAddRecipeUser;
                    $viewAdd->afficherSite();
                    break;
                    
                
            }
        }else{
            $viewInfo = new ViewInformation;
            $viewInfo->afficherSite();
        }
        $this->footerPage();
    }


        // sauvgarde infos recette
        public function sauvgardInfoRecipe(){
            if(isset($_POST['AddRecipe'])){
                $_SESSION['name']= $_POST['name'];
                $_SESSION['prepare']= $_POST['prepare'];
                $_SESSION['coocking']= $_POST['coocking'];
                $_SESSION['rest']= $_POST['rest'];
                $_SESSION['pic']= $_POST['pic'];
                $_SESSION['video']= $_POST['video'];
                $_SESSION['region']= $_POST['Region'];
                $_SESSION['categori']= $_POST['categori'];               
                $_SESSION['description']= $_POST['description'];
                $_SESSION['Difficulte']= $_POST['Difficulte'];
            }
        }
        // verifier numero des etapes
        public function verifyStepNum(){
                if($_SESSION['pageAjouter']==2){
                    $row = count($_SESSION['steps']);
                    if($row>=3){
                        $_SESSION['pageAjouter'] = $_SESSION['pageAjouter']+1;
                    }
                    else{
                        echo "<script>alert('veuillez insirer au minimum 3 etaps !')</script>"; 
                    }
                }else{
                    $this->sauvgardInfoRecipe();
                    $_SESSION['pageAjouter'] = $_SESSION['pageAjouter']+1;
                }
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
                                        <input type='submit' value='Profile' name='Sign'/>
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

}
?>
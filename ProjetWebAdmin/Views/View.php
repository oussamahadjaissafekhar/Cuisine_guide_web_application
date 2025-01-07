<?php
require_once('..\Controllers/Conroller.php');
class View{


    public function verifyLogInView(){
        if(ISSET($_POST['login'])){
                $control = new Controller();
                $logIn= $control->verifyLogInAdminContoller($_POST['username'],$_POST['password']);
                if($logIn != false){
                    $_SESSION['page'] = 'Acceuil';
                    $_SESSION['connected'] = true;
                    $_SESSION['admin'] = $logIn;
                    header ("location:./RouterRecipe.php");
                }else {
                    echo "
                        <script>alert('Invalid username or password')</script>
                    ";
                }
        }
    }
    public function headPage(){
        ?>
        <!DOCTYPE html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="../Css/principal.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  
                <script src="../JavaScript/AddRecipe.js"></script> 
            </head>
            <body>
                <div class="header">
                        <ul class="menu">
                            <li class="menuItem"><div><a href="../../ProjetWeb/router.php">Acceuil</a></div></li>
                            <li class="menuItem"><div><a href="../Routers/RouterRecipe.php">Gestion Recettes</a></div></li>
                            <li class="menuItem"><div><a href="../Routers/RouterUser.php">Gestion Utilisateurs</a></div></li>
                            <li class="menuItem"><div><a href="../Routers/RouterNutrition.php">Gestion Nutririon</a></div></li>
                            <li class="menuItem"><div><a href="../Routers/RouterNews.php">Gestion News</a></div></li>
                            <li class="menuItem"><div><a href="../Routers/RouterParametre.php">Paramètres</a></div></li>
                        </ul>
                </div>
        <?php
    }
    public function headPageLogIn(){
        ?>
        <!DOCTYPE html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="../Css/principal.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            </head>
        <?php
    }

    public function footer(){
        ?>
                <div class="footer">
                    <ul class="menuFooter">
                        <li class="menuItemFooter"><div><a href="../../ProjetWeb/router.php">Acceuil</a></div></li>
                        <li class="menuItemFooter"><div><a href="../Routers/RouterRecipe.php">Gestion Recettes</a></div></li>
                        <li class="menuItemFooter"><div><a href="../Routers/RouterUser.php">Gestion Utilisateurs</a></div></li>
                        <li class="menuItemFooter"><div><a href="../Routers/RouterNutrition.php">Gestion Nutririon</a></div></li>
                        <li class="menuItemFooter"><div><a href="../Routers/RouterNews.php">Gestion News</a></div></li>
                        <li class="menuItemFooter"><div><a href="../Routers/RouterParametre.php">Paramètres</a></div></li>
                    </ul>
                </div>
            </body>
        <?php
    }

    public function afficherSite(){
        $this->verifyLogInView();
        $this->headPageLogIn();
        ?>
            <form class="logIn" method="POST">
                <h1>Log In</h1>
                <label>nom d’utilisateur</label>
                <input type="text" name="username" placeholder="Inserz votre nom d’utilisateur" required/>
                <label>Mote de pass</label>
                <input type="password" name="password" placeholder="Inserez votre Mot de pass" required/>
                <div>
                    <a href="">Cree un nouveau compte</a>
                    <a href="">Mote de pass oubliee ?</a>
                </div>
                <input class="loginButton" type="submit" name="login" value="connecter">
            </form>
        <?php
    }
}
?>
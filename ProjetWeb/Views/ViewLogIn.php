<?php
require_once('Controllers/Conroller.php');
class ViewLogIn extends View{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/logIn.css">
            
        <?php
    }


    public function afficherSite(){
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

    public function verifyLogInView(){
        if(ISSET($_POST['login'])){
                $control = new Controller();
                $logIn= $control->verifyLogInContoller($_POST['username'],$_POST['password']);
                if($logIn != false){
                    $_SESSION['page'] = 'Acceuil';
                    $_SESSION['connected'] = true;
                    $_SESSION['user'] = $logIn;
                    header ("location:./router.php");
                }else {
                    echo "
                        <script>alert('Invalid username or password')</script>
                    ";
                }
        }
    }
}
?>
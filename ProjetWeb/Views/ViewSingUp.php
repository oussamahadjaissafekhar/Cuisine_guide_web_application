<?php
require_once('Controllers/Conroller.php');
class ViewSingUp extends View{


    
    // Crer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/signup.css">
            
        <?php
    }


    public function afficherSite(){
        ?>
            <form class="singUp" method="POST">
                <h1>Cree un nouveau compte</h1>
                <div>
                    <input type="text" name="nom" placeholder="Nom*" required/>
                    <input type="text" name="prenom" placeholder="Prenom*" required/>
                </div>
                <div>
                    <input type="text" name="username" placeholder="Username*" required/>
                    <input type="password" name="motdepass" placeholder="Mot de pass*" required/>
                </div>
                <div>
                    <input type="text" name="mail" placeholder="Adresse mail*" required/>
                </div>
                <div>
                    <select name="sexe">
                        <option value="" disabled selected>Sexe*</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <input type="date" name="naissance" placeholder="Date de Naissance*" required/>
                </div>
                <div>
                    <label>
                        Photo de profile
                    </label>
                    <label class="label">
                        <input type="file" name="profileImage"/>
                        <span>Select a file</span>
                    </label>
                </div>
                <div>
                    <a>log in!</a>
                    <input class="singUpButton" name="signup" type="submit" value="Creer">
                </div>
                

            </form>
        <?php
    }

    public function creatUserView(){
        if(ISSET($_POST['signup'])){
            $username = $_POST['username'];
            $password = $_POST['motdepass'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $mail = $_POST['mail'];
            $sexe = $_POST['sexe'];
            $naissance = $_POST['naissance'];
            $profilImage = $_POST['profileImage'];
            $control = new Controller();
            $control->creatUserController($username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage);
            $_SESSION['page'] = 'LogIn';
            header ("location:./router.php");          
        }
    }
}
?>
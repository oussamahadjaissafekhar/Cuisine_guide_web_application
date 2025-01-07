<?php
require_once('Controllers/Conroller.php');
class ViewInformation extends ViewProfil{


    
    // Creer l'entet du page
    public function headHtml(){
        ?>
            <link rel="stylesheet" href="Css/cadre.css">
            <link rel="stylesheet" href="Css/profile.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>   
            <script src="JavaScript/profile.js"></script>
        <?php
    }

    // sauvgarder les changement 
    public function sauvgarder($user){
        if(isset($_POST['Modifier'])){
            if($_POST['username'] != "" && $_POST['username']!= $user['UserName']){
                $user['UserName'] = $_POST['username'];
            }
            if($_POST['password'] != "" && $_POST['password']!= $user['Password']){
                $user['Password'] = $_POST['password'];
            }
            if($_POST['nom'] != "" && $_POST['nom']!= $user['Nom']){
                $user['Nom'] = $_POST['nom'];
            }
            if($_POST['prenom'] != "" && $_POST['prenom']!= $user['Prenom']){
                $user['Prenom'] = $_POST['prenom'];
            }
            if($_POST['mail'] != "" && $_POST['mail']!= $user['Mail']){
                $user['Mail'] = $_POST['mail'];
            }
            if($_POST['birthday'] != "" && $_POST['birthday']!= $user['Birthday']){
                $user['Birthday'] = $_POST['birthday'];
            }
            $controller = new Controller;
            $controller->updateUserController($user['UserID'],$user['UserName'],$user['Password'],$user['Nom'],
            $user['Prenom'],$user['Mail'],$user['Sexe'],$user['Birthday'],$user['ProfilPicture']);
            echo "<script>alert('Votre donnnes sont ete suvgarder avec succes')</script>";
            $_SESSION['user'] = $user;
        }
        
    }

    

        // Afficher la page du filter
        public function afficherSite(){
            $this->sauvgarder($_SESSION['user']);
            $user = $_SESSION['user'];
            echo "
            <form class='logIn' method='POST'>
                <h1>Les information personelles</h1>
                <img id='profileImage' src='$user[ProfilPicture]'/>
                <div class='row'>
                    <div class='column'>
                        <label>nom d’utilisateur</label>
                        <input type='text' value='$user[UserName]' name='username'/>
                    </div>
                    <div class='column'>
                        <label>Mote de pass</label>
                        <input type='password' value='$user[Password]' name='password'/>
                    </div>
                </div>
                <div class='row'>
                    <div class='column'>
                        <label>Nom</label>
                        <input type='text' value='$user[Nom]' name='nom'/>
                    </div>
                    <div class='column'>
                        <label>Prenom</label>
                        <input type='text' value='$user[Prenom]' name='prenom'/>
                    </div>
                </div>
                <div class='row'>
                    <div class='column'>
                        <label>mail</label>
                        <input type='mail' value='$user[Mail]' name='mail'/>
                    </div>
                    <div class='column'>
                        <label>birthday</label>
                        <input type='date' value='$user[Birthday]' name='birthday'/>
                    </div>
                </div>     
                <input class='loginButton' type='submit' name='Modifier' value='modifier'/>
            </form>
            ";
        }
}
?>
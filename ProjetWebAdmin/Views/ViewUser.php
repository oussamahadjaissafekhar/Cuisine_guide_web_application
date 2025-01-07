<?php
require_once('..\Controllers/Conroller.php');
class ViewUser extends View{


    public function body(){
        $controoller = new Controller;
        $controoller->deletUser();
        $controoller->updateUserState();
        $users = $controoller->filterUser();
        ?>
        <form method="POST">
            <select name="column">
                <option value="UserID">User id</option>
                <option value="UserName">nom d'utilisateur</option>
                <option value="Nom">Nom</option>
                <option value="Prenom">Prenom</option>
                <option value="Sexe">Sexe</option>
                <option value="Birthday">Date de naissance</option>
                <option value="valider">validation</option>
            </select>
            <input type="submit" name="recherchColumn" value="rechercher"/>
        </form>
            <table>
                <thead>
                    <th>nom d'utilisateur</th>
                    <th>Nom / Prenom</th>
                    <th>Mail</th>
                    <th>Photo de profile</th>
                    <th>Sexe</th>
                    <th>Date de naissance</th>
                    <th>Validation</th>
                    <th>Supprimer</th>
                </thead>
                <tbody id="Tbody">
                        <?php /*
                    <script>
                        function getUsers()
                        {
                        $("#Tbody").load("../php/loadUsers.php");
                        }

                        setInterval('getUsers()', 5000);
                    </script>
                        */?>
                <?php
                    foreach($users as $user){
                        $photoDeProfil = '../../ProjetWeb/'.$user['ProfilPicture'];
                        echo "
                        <tr><form method='POST'>
                            <td>$user[UserName]</td>
                            <td>$user[Nom] / $user[Prenom]</</td>
                            <td>$user[Mail]</td>
                            <td><img src='$photoDeProfil' class='image'/></td>
                            <td>$user[Sexe]</td>
                            <td>$user[Birthday]</td>";
                            if($user['valider'] == 0){
                                echo "<td><input type='submit' name='state' value='Accepter'/>
                                <input type='hidden' name='valider' value='$user[valider]'/></td>";
                            }else{
                                echo "<td><input type='submit' name='state' value='Refuser'/>
                                <input type='hidden' name='userId' value='$user[UserID]'/></td>";
                            }   
                            echo"<td><input type='submit' name='deletUser' value='supprimer'/>
                                                    <input type='hidden' name='userId' value='$user[UserID]'/></td>
                        </form></tr>";
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
<?php
require_once('..\Controllers/Conroller.php');
    $controlleur = new Controller;
    $users = $controlleur->filterUser();
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
        </form></tr>
        
        ";
    }
?>
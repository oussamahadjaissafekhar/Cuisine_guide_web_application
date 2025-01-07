<?php
require_once('..\Controllers/Conroller.php');
class ViewNews extends View{


    public function body(){
        $controoller = new Controller;
        $controoller->addNews();
        $controoller->deleteNews();
        $news = $controoller->getNewsController();
        ?>
        <input type="button"  id="ajouterNew" value="+ Ajouter un news"/>
        <form class="new" method="POST" style="display: none;">
        <input type="button" id="fermerForm" value="X" />
            <label>Ajouter un titre</label>
            <input type="text" name="NewTitle" placeholder="Inserer le tite du news" required/>
            <label>Ajouter une description</label>
            <input type="text" name="NewDescription" placeholder="Inserer la description du news" required/>
            <label>Ajouter une image</label>
            <input type="file" name="ImageNew" placeholder="Inserer un photo du news" required/>
            <label>Ajouter une video</label>
            <input type="file" name="Video" placeholder="Inserer un video du news"/>
            <input type="submit" name="addNew" value="Ajouter news"/>
        </form>
            <table class="tableNews">
                <thead>
                    <th>Titre de news</th>
                    <th>Discription</th>
                    <th>Image de news</th>
                    <th>Supprimer</th>
                </thead>
                <tbody>
                <?php
                    foreach($news as $new){
                        $photoDeNews = '../../ProjetWeb/'.$new['ImageNew'];
                        echo "
                        <tr><form method='POST'>
                            <td>$new[NewTitle]</td>
                            <td>$new[NewDescription]</</td>
                            <td><img src='$photoDeNews' class='image'/></td>
                            <td><input type='submit' name='deletNew' value='supprimer'/>
                                <input type='hidden' name='newId' value='$new[NewID]'/></td>
                        </form></tr>
                        
                        ";
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
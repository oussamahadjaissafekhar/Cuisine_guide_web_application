<?php 
require_once('Controllers/Conroller.php');
class Model{
    private $dbName ="projetweb" ;
    private $host ="localhost" ;
    private $user ="root" ;
    private $password ="" ;


        // Connexion a la base de donnee
    private function connexion ($host , $dbName , $user , $password){
        try{
            $connect = new PDO("mysql:host=$host; dbname=$dbName", $user, $password); 
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $ex){
            printf("erreur de connexion à la base de donnée", $ex->getMessage());
        exit();
        }
        return $connect ;
    }

        // Deconnexion du base de donnee
    private function deconnexion ($connect) {
            $connect = null ;
        }
    // creer un ingredient
    public function addIngredientAdmin($IngredientName ,$Saison ,$Halthy ,$ImageIngredient ,$Calorie ,$Glucide ,$Lipide ,$Proteine ,$Vitamine){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $IngredientID = $this->getNumRow('ingredient','IngredientID')+1;
        $sql = "INSERT INTO `ingredient`(`IngredientID`, `IngredientName`, `Saison`, `Halthy`, `ImageIngredient`, `Calorie`, `Glucide`, `Lipide`, `Proteine`, `Vitamine`) 
        VALUES (?,?,?,?,?,?,?,?,?,?)";
        $query = $this->requete($connect,$sql,[$IngredientID ,$IngredientName ,$Saison ,$Halthy ,$ImageIngredient ,$Calorie ,$Glucide ,$Lipide ,$Proteine ,$Vitamine]);
        $this->deconnexion($connect);
        return $query;
    }
        // Traitement des requetes
    private function requete ($connect , $sql,$array){
        $query = $connect->prepare($sql);
        $query->execute($array);
        return $query;
    }
        // returner le nombre de ligne dans une table de BDD
    public function getNumRow($table,$column) {
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT MAX(`$column`) FROM `$table`";
        $query = $this->requete($connect , $sql,[]);
        $type = gettype($query);
        $result = $query->fetch()[0];
        $this->deconnexion($connect);
        return $result;
    }
            // recuperer les diapos a afficher
    public function getDiapos(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `diaporama`";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }
            // recuperer toutes les recettes
    public function getRecipes(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `recipe` WHERE `confirmed` = '1'";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }

        // Recuperer les cordonnes de l'utilisateur pour Log-in 
    private function getLogInUsers ($username , $motdepass){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `user` WHERE `UserName`=? AND `Password`=? ";
        $query = $this->requete($connect,$sql,[$username , $motdepass]);
        $this->deconnexion($connect);
        return $query;
    }

        // Verfier les coordonnes 
    public function verifyLogIn ($username , $motdepass){
        $query = $this->getLogInUsers($username, $motdepass);
        $row = $query->rowCount();
        $fetch = $query->fetch();
        if($row > 0) {
            return $fetch;
        } else {
            return false;
        }

    }

    // Creer un utilisateur 
    public function creatUser($username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $userId = $this->getNumRow('user','UserID')+1;
        $sql = "INSERT INTO `user`(`UserID`, `UserName`, `Password`, `Nom`, `Prenom`, `Mail`, `Sexe`, `Birthday`, `ProfilPicture`)
        VALUES (?,?,?,?,?,?,?,?,?)";
        $query = $this->requete($connect,$sql,[$userId,$username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage]);
        $this->deconnexion($connect);
        return $query;
    }
    // modifier un utilisateur 
    public function updateUser($userId,$username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "UPDATE `user` SET `UserName`=?,`Password`=?,`Nom`=?,`Prenom`=?
        ,`Mail`=?,`Sexe`=?,`Birthday`=?,`ProfilPicture`=? WHERE `UserID` =? ";
        $query = $connect->prepare($sql);
        $query->execute([$username,$password,$nom,$prenom,$mail,$sexe,$naissance,$profilImage,$userId]);
        $this->deconnexion($connect);
        return $query;
    }

    // recupere une recette par categorie
    public function getRecipeByCategorie($categorie){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `recipe` WHERE `Categorie`=? AND `confirmed` = '1'";
        $query = $this->requete($connect,$sql,[$categorie]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer une recette par id
    public function getRecipeById($recipeId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `recipe` WHERE `RecipeID`=? AND `confirmed` = '1'";
        $query = $this->requete($connect,$sql,[$recipeId]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer toutes les recettes
    public function getHealthyRecipes(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `parametres` WHERE `parametreNom` = 'calorieSeuil'";
        $seuil = $query = $this->requete($connect,$sql,[])->fetch()['parametreValue'];
        $sql = "SELECT * FROM `recipe` WHERE `calorieTotal` <= ? AND `confirmed` = '1' ";
        $query = $connect->prepare($sql);
        $query->execute([$seuil]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer une new par id
    public function getNewById($newId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `new` WHERE `NewID` = ? ";
        $query = $this->requete($connect,$sql,[$newId]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer les news 
    public function getNews(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `new` ORDER BY `NewID` DESC";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }

    // recuperer l'ingredient 
    public function getIngredientById($ingredientId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `ingredient` WHERE `IngredientID`=?";
        $query = $this->requete($connect,$sql,[$ingredientId]);
        $this->deconnexion($connect);
        return $query;
    }


        // Recuperer les ingredients d'une recette
    public function getIngredientsRecipe($recipeId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `ingredientrecette` WHERE `RecipeID`=?";
        $query = $this->requete($connect,$sql,[$recipeId]);
        $this->deconnexion($connect);
        return $query;
    }

        // Recuperer touts les ingredients 
    public function getIngredients(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `ingredient`";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }

        // recuperer les etapes d'une recette
    public function getSteps($recipeId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `step` WHERE `RecipeID`=?";
        $query = $this->requete($connect,$sql,[$recipeId]);
        $this->deconnexion($connect);
        return $query;
    }
        // recuperer les etapes d'une recette
        public function getStepByRecipeId($recipeId,$order){
            $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
            $sql = "SELECT * FROM `step` WHERE `RecipeID`=? And `StepNumber` =?";
            $query = $this->requete($connect,$sql,[$recipeId,$order]);
            $this->deconnexion($connect);
            return $query->rowCount();
        }

        // Recuperer le menu 
    public function getMenu(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `menu`";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }

        // recuperer le pourcentage des ingredients pour satisfaire la recherch
    public function getPourcentage(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `parametres` WHERE `parametreNom` = 'ingredientPourcentage'";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query->fetch();
    } 
    // ajouter une region a une recette
    public function addRegionRecipe($recipeId, $regionId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $regionRecipeId = $this->getNumRow('regionrecipe','regionRecipeId')+1;
        $sql = "INSERT INTO `regionrecipe`(`regionRecipeId`, `recipeId`, `regionId`) VALUES (?,?,?)";
        $query = $this->requete($connect,$sql,[$regionRecipeId,$recipeId,$regionId]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer les regions
    public function getRegions(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `region`";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }
        // recuperer les fetes
    public function getHolidays(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `holiday`";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer les categories
    public function getCategories(){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `categorie`";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer une region par id
    public function getRegionById($regionId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `region` WHERE `regionId`=?";
        $query = $this->requete($connect,$sql,[$regionId]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer la region d'une categorie
    public function getRegionRecipe($recipeId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `regionrecipe` WHERE `recipeId`=?";
        $query = $this->requete($connect,$sql,[$recipeId]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer une fete par id
    public function getHolidayById($holidayId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `holiday` WHERE `HolidayID`=?";
        $query = $this->requete($connect,$sql,[$holidayId]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer une fete par nom
    public function getHolidayByName($holidayNom){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `holiday` WHERE `Holiday`=?";
        $query = $this->requete($connect,$sql,[$holidayNom]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer les holidayRecipes par holiday id
    public function getHolidaysById($holidayId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `holidayrecipe` WHERE `HolidayID`=?";
        $query = $this->requete($connect,$sql,[$holidayId]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer les holidays d'une recette
    public function getHolidayRecipe($recipeId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `holidayrecipe` WHERE `RecipeID`=?";
        $query = $this->requete($connect,$sql,[$recipeId]);
        $this->deconnexion($connect);
        return $query;
    }
    // verifier une recette a une saison donnee
    public function verifySaison($recipeId,$Saison){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `recipe` WHERE `RecipeID` = ?  and `Saison` LIKE '%$Saison%' and `confirmed` = '1'";
        $query = $this->requete($connect,$sql,[$recipeId]);
        $this->deconnexion($connect);
        return $query->rowCount();
    }
    // recupere les recettes par saison
    public function getRecipeSaison($Saison){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `recipe` WHERE `Saison` LIKE '%$Saison%' AND `confirmed` = '1'";
        $query = $this->requete($connect,$sql,[]);
        $this->deconnexion($connect);
        return $query;
    }
    // remove save 
    public function removeSave($recipeId,$userId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "DELETE FROM `save` WHERE `RecipeID`=? AND `UserID`=?";
        $query = $this->requete($connect,$sql,[$recipeId,$userId]);
        $this->deconnexion($connect);
        return $query;
    }
    // add save
    public function addSave($recipeId,$userId){
        $saveId = $this->getNumRow('save','SaveID')+1;
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        if($this->getSave($recipeId,$userId)==0){
            $sql = "INSERT INTO `save`(`SaveID`, `RecipeID`, `UserID`) VALUES (?,?,?)";
            $query =$this->requete($connect,$sql,[$saveId,$recipeId,$userId]);
            $this->deconnexion($connect);
            return $query;
        }else{return false;}
        
    }
    // get save
    public function getSave($recipeId,$userId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `save` WHERE `RecipeID`=? AND `UserID`=?";
        $query = $this->requete($connect,$sql,[$recipeId,$userId]);
        $this->deconnexion($connect);
        return $query->rowCount();
    } 
    // get saves
    public function getSaves($userId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `save` WHERE `UserID`=?";
        $query = $this->requete($connect,$sql,[$userId]);
        $this->deconnexion($connect);
        return $query;
    } 
    // remove Like 
    public function removeLike($recipeId,$userId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "DELETE FROM `like` WHERE `RecipeID`=? AND `UserID`=?";
        $query = $this->requete($connect,$sql,[$recipeId,$userId]);
        $this->deconnexion($connect);
        return $query;
    }
    // add like
    public function addLike($recipeId,$userId){
        $LikeId = $this->getNumRow('like','LikeID')+1;
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        if($this->getLike($recipeId,$userId) == 0){
            $sql = "INSERT INTO `like`(`LikeID`, `RecipeID`, `UserID`) VALUES (?,?,?)";
            $query = $this->requete($connect,$sql,[$LikeId,$recipeId,$userId]);
            $this->deconnexion($connect);
            return $query;
        }else{return false;}
    }
    // get like
    public function getLike($recipeId,$userId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `like` WHERE `RecipeID`=? AND `UserID`=?";
        $query = $this->requete($connect,$sql,[$recipeId,$userId]);
        $this->deconnexion($connect);
        return $query->rowCount();
    }
    // mettre a jour la note de la recette 
    public function updateRecipeMark($recipeId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `mark` WHERE `RecipeID` = ?";
        $query = $this->requete($connect,$sql,[$recipeId]);
        $noteTotal = 0;
        $i=0;
        foreach($query as $note){
            $noteTotal = $noteTotal + $note['Note'];
            $i++;
        }
        $noteTotal = $noteTotal/$i;
        $sql = "UPDATE `recipe` SET `noteTotal`= ?  WHERE `RecipeID`= ? ";
        $query = $this->requete($connect,$sql,[$noteTotal,$recipeId]);
        $this->deconnexion($connect);
        return $query;
    }
    // ajouter un note
    public function addMark($userId , $recipeID , $note){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $NoteID = $this->getNumRow('mark','NoteID')+1;
        $sql = "INSERT INTO `mark`(`NoteID`, `Note`, `UserID`, `RecipeID`) VALUES (?,?,?,?)";
        $query = $this->requete($connect,$sql,[$NoteID, $note, $userId , $recipeID ]);
        $this->deconnexion($connect);
        $this->updateRecipeMark($recipeID);
        return $query;
    }
    // recuperer la note
    public function getMark($recipeId,$userId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `mark` WHERE `UserID`=? AND `RecipeID`=?";
        $query = $this->requete($connect,$sql,[$recipeId,$userId]);
        $this->deconnexion($connect);
        return $query;
    }
    // recuperer la note
    public function getMarkById($noteId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `mark` WHERE `NoteID`=?";
        $query = $this->requete($connect,$sql,[$noteId]);
        $this->deconnexion($connect);
        return $query;
    }
    // modifier la note
    public function modifierMark($noteId , $note){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "UPDATE `mark` SET `Note`=? WHERE `NoteID`=?";
        $query = $this->requete($connect,$sql,[$note ,$noteId]);
        $this->deconnexion($connect);
        $mark = $this->getMarkById($noteId)->fetch();
        $recipeID = $mark['RecipeID'];
        $this->updateRecipeMark($recipeID);
        return $query;
        
    }
    // get likes
    public function getLikes($userId){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `like` WHERE `UserID`=?";
        $query = $this->requete($connect,$sql,[$userId]);
        $this->deconnexion($connect);
        return $query;
    }
    public function getRecipeByNom($nom){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `recipe` WHERE `RecipeNom`=?";
        $query = $this->requete($connect,$sql,[$nom]);
        $this->deconnexion($connect);
        return $query->fetch();
    }
    public function getIngredientByNom($nom){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "SELECT * FROM `ingredient` WHERE `IngredientName` = ?";
        $query = $this->requete($connect,$sql,[$nom]);
        $this->deconnexion($connect);
        return $query->fetch();
    }
    // create etape
    public function creatStep($recipeId,$step,$i){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $stepId = $this->getNumRow('step','StepID')+1;
        $sql = "INSERT INTO `step`(`StepID`, `StepNumber`, `RecipeID`, `StepDescription`) VALUES (?,?,?,?)";
        $query = $this->requete($connect,$sql,[$stepId,$i,$recipeId,$step]);
        $this->deconnexion($connect);
        return $query;
    }
    // create ingredient 
    public function creatIngredientRecipe($recipeId,$ingredientid,$ingredientQuant,$ingredientUnite,$ingredientMethod){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $ingId = $this->getNumRow('ingredientrecette','IngredientRecette')+1;
        $sql = "INSERT INTO `ingredientrecette`(`IngredientRecette`, `RecipeID`, `IngredientID`, `Quantite`, `UniteQuantite`, `CoockingMethod`) VALUES (?,?,?,?,?,?)";
        $query = $this->requete($connect,$sql,[$ingId,$recipeId,$ingredientid,$ingredientQuant,$ingredientUnite,$ingredientMethod]);
        $this->deconnexion($connect);
        return $query;
    }
    // create ingredient 
    public function creatRecipe($recipeId,$recipeImage,$adminId,$userId,$Difficult,$preparTime,$restTime,$coockingTime,$TotalTime,$video,$recipeName,$recipeDescription,$categorie,$note,$Saison,$calorieTotal,$confirmed){
        $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
        $sql = "INSERT INTO `recipe`(`RecipeID`, `Image`, `AdminID`, `UserID`, `Difficult` , `PrepareTime`, `RestTime`, `CookingTime`, `TotalTime`, `Video`, `RecipeNom`, `RecipeDescription`, `Categorie`, `noteTotal`, `Saison`, `calorieTotal`, `confirmed`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = $this->requete($connect,$sql,[$recipeId,$recipeImage,$adminId,$userId,$Difficult,$preparTime,$restTime,$coockingTime,$TotalTime,$video,$recipeName,$recipeDescription,$categorie,$note,$Saison,$calorieTotal,$confirmed]);
        $this->deconnexion($connect);
        return $query;
    }

}


?>
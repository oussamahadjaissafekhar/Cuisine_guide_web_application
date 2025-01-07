<?php
require_once('Models/Model.php');
class script{
    private $dbName ="sql" ;
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
        // Traitement des requetes
        private function requete ($connect , $sql,$array){
            $query = $connect->prepare($sql);
            $query->execute($array);
            return $query;
        }
        public function getRecipes(){
            $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
            $sql = "SELECT * FROM `recette`";
            $query = $this->requete($connect,$sql,[]);
            $this->deconnexion($connect);
            return $query;
        }
        public function getIngs(){
            $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
            $sql = "SELECT * FROM `ingredient`";
            $query = $this->requete($connect,$sql,[]);
            $this->deconnexion($connect);
            return $query;
        }
        public function getIngsRecipe(){
            $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
            $sql = "SELECT * FROM `composition`";
            $query = $this->requete($connect,$sql,[]);
            $this->deconnexion($connect);
            return $query;
        }
        public function getsteps(){
            $connect = $this->connexion($this->host , $this->dbName , $this->user , $this->password);
            $sql = "SELECT * FROM `etape`";
            $query = $this->requete($connect,$sql,[]);
            $this->deconnexion($connect);
            return $query;
        }
    public function addRecipes(){
        $model = new Model;
        $recipes = $this->getRecipes();    
        foreach($recipes as $recipe){
            $recipeId = $model->getNumRow('recipe')+1;
            $model->creatRecipe($recipeId,$recipe['image'],null,null,0,$recipe['tpreparation']
        ,$recipe['trepos'],$recipe['tcuisson'],"","",$recipe['titre'],$recipe['description'],$recipe['categorie'],0,"",$recipe['nbCalorie']
        ,0);
        }
    }
    public function addIngredients(){
        $model = new Model;
        $ings = $this->getIngs();    
        foreach($ings as $ing){
            $ingId = $model->getNumRow('ingredient')+1;
            $model->addIngredientAdmin($ing['nom'],$ing['saison'],5,"",$ing['calorie'],$ing['sucre'],0,$ing['protein']
        ,0);
            
        }
    }
    public function addIngredientRecipe(){
        $model = new Model;
        $ings = $this->getIngsRecipe(); 
        foreach($ings as $ing){
            if($ingredient = $model->getIngredientByNom($ing['nom']) != null and $recipeid=$model->getRecipeByNom($ing['titre'])['RecipeID']!=null){
                $recipeid=$model->getRecipeByNom($ing['titre'])['RecipeID'];
                $ingredient = $model->getIngredientByNom($ing['nom']);
                $ingreId = $ingredient['IngredientID'];
                $model->creatIngredientRecipe($recipeid,$ingreId,$ing['quantite'],$ing['unite'],"");
            }               
        }   
    }

    public function addSteps(){
        $model = new Model;
        $steps = $this->getsteps(); 
        foreach($steps as $step){
            $recipeId = $model->getRecipeByNom($step['titreRecette'])['RecipeID'];
            if($model->getStepByRecipeId($recipeId,$step['ordre']) == 0 and $recipeId != null){
                $model->creatStep($recipeId,$step['description'],$step['ordre']);
            }
        }   
    }
    }
?>
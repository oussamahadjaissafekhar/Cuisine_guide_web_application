<?php
require_once('Models/Model.php');
require_once('Controllers/Conroller.php');
class ControllerRecipe {
    // ajouter une etape
    public function addStep(){
        if(isset($_POST['addStep'])){
            if($_POST['step'] != ""){
                if(isset($_SESSION['steps'])){
                    array_push($_SESSION['steps'],$_POST['step']); 
                    $_SESSION['steps'] = array_unique($_SESSION['steps']);
                }else{
                    $_SESSION['steps'] = [];
                }
            }else{
                echo "<script>alert('veuillez remplier le champ etap svp !')</script>";
            }

            
        }
    }
    // supprimer une etape
    public function removeStep(){
        if(isset($_POST['suppSte'])){
            if (($key = array_search($_POST['step'],$_SESSION['steps'])) !== false){
                unset($_SESSION['steps'][$key]);
            }
            
        }
    }
    // ajouter un ingredient
    public function addIngredient(){
        if(isset($_POST['addIngredient'])){
           // echo "<script>alert('')</script>";
            $arrayIngredient= explode("|", $_POST['ingrdient'] );
            $ingredientId = $arrayIngredient[1];
            $ingredientName = $arrayIngredient[0];
            $calorie = $arrayIngredient[2];
            $arr = ['id'=>$ingredientId,
                    'ing'=>$ingredientName,
                    'qunt'=>$_POST['quantite'],
                    'unite'=>$_POST['uniteQuantite'],
                    'method'=>$_POST['methodCoocking'],
                    'calorie'=>$calorie];
            if(isset($_SESSION['ings'])){
                array_push($_SESSION['ings'],$arr); 
            }else{
                $_SESSION['ings'] = [$arr];
            }
            
        }
    }
    // supprimer un ingredient
    public function removeIngredient(){
        if(isset($_POST['suprIng'])){
            $arr = ['id'=>$_POST['ingredientId'],
                    'ing'=>$_POST['ingredientName'],
                    'qunt'=>$_POST['ingredientQuantite'],
                    'unite'=>$_POST['uniteQuantite'],
                    'method'=>$_POST['methodCoocking'],
                    'calorie'=>$_POST['calorie']];
            if (($key = array_search($arr,$_SESSION['ings'])) !== false){
                unset($_SESSION['ings'][$key]);
            }
            
        }
    }
    // recuperer la recette
    public function creerRecette(){
        $controll = new Controller;
        $model = new Model;
        if(isset($_POST['addRecipe'])){
            $_SESSION['pageAjouter'] = 1;
            $recipeId = $controll->getNumRow('recipe','RecipeID')+1;
            $i=1;
            $calorieTotal = 0;
            $arrSaison = ['printemps','etes','automne','hiver','Printemps','Etes','Automne','Hiver'];
            $saison ="";
            $saisonIngs ="";
            //$controll->creatRecipeController();
            foreach($_SESSION['steps'] as $step){
                $controll->creatStepController($recipeId,$step,$i);
                $i++;
            }
            foreach($_SESSION['ings'] as $ingredient){
                $calorieTotal = $calorieTotal +$ingredient['calorie'];
                $controll->creatIngredientRecipeController($recipeId,$ingredient['id'],$ingredient['qunt'],$ingredient['unite'],$ingredient['method']);
                $ing = $model->getIngredientById($ingredient['id'])->fetch();
                $saisonIngs = $saisonIngs." ".$ing['Saison'];
            }
            foreach($_SESSION['region'] as $region){
                $model->addRegionRecipe($recipeId,$region);
            }
            foreach($arrSaison as $s){
                if(strpos($saisonIngs,$s)!== false){
                    $saison = $saison." ".$s;
                }
            }
            $TotalTime = "";
            $model->creatRecipe($recipeId,$_SESSION['pic'],null,$_SESSION['user']['UserID'],$_SESSION['Difficulte'],$_SESSION['prepare'],$_SESSION['rest'],$_SESSION['coocking'],$TotalTime,$_SESSION['video'],"Images/recipeImages/".$_SESSION['name'],$_SESSION['description'],$_SESSION['categori'],0,$saison,$calorieTotal,0);
            $_SESSION['ings'] = [];
            $_SESSION['steps'] = [];
        }
    }
}




?>
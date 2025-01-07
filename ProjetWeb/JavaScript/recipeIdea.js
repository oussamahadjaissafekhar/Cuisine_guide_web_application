window.onload = function(){
    // fermer le form
    let fermerPopUp = $("#fermer");
    fermerPopUp.click(function(){
        $(".ingredientForm").hide();
    })
    // ouvrire le form
    let ajouteIngredient = $("#ajouterIngredient");
    ajouteIngredient.click(function(){
        $(".ingredientForm").show();
    })
    
    // rechercher des ingredients
    let rechercherBar = $("#recherch")
    let ingredientsDom = $(".ingredient")
    let ingredients = Array.from(ingredientsDom);
    rechercherBar.change(function(){
        ingredients.forEach(ingredient => {
            let index = ingredient.children[1].children[1].textContent.indexOf(rechercherBar.val());
                if(index !== -1){
                    ingredient.style.display="flex";
                }else{
                    ingredient.style.display="none";
                }
        });
    })
    // Manupiler pop up du compte
    let profileIcon = $("#profilIcon");
    let comptePopUp = $("#comptePopUp");
    let modalAlreadyShowed = false;
    profileIcon.click(function(){
        comptePopUp.show();
        modalAlreadyShowed = true
    })
    window.addEventListener('scroll', function(e) {
        if( modalAlreadyShowed ) {
        setTimeout( () => {
            comptePopUp.hide();
        }, 100 )
        modalAlreadyShowed = false
        }
    })
    }
window.onload = function(){
    // filtere les ingredients
        // declaration des elements
        let ingredientsDom = $(".ingredient");
        let ingredients = Array.from(ingredientsDom);
        let rechercherBar = $("#recherchBar") ;
        rechercherBar.change(function(){
            ingredients.forEach(ingredient => {
                let index = ingredient.children[1].textContent.indexOf(rechercherBar.val());
                if(index !== -1){
                    ingredient.style.display="inline";
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
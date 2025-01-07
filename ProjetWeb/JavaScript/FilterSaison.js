window.onload = function(){
    // filtere les recettes
        // declaration des elements
        let selects = $(".filterSelect")
        let recettesDom = $(".carte");
        let recettes ;
        let recettesFiltrer =[];
        let saisonFilter = $("#Saison");
        let rechercherBar = $("#recherchBar") ;
        console.log(rechercherBar.val())
        // fonction de filtrage
        selects.change(function(){
            recettes = Array.from(recettesDom);
            if(rechercherBar.val() != "" && rechercherBar[0]!=this){
                recettesFiltrer = [];
                recettes.forEach(recette => {
                    let index = recette.children[1].textContent.indexOf(rechercherBar.val());
                        if(index !== -1){
                            recette.style.display="inline";
                        }else{
                            recette.style.display="none";
                        }
                });
                recettes = recettesFiltrer;
            }
            switch(this.name){
                case "recherchBar":
                    recettes.forEach(recette => {
                        let index = recette.children[1].textContent.indexOf(rechercherBar.val());
                        if(index !== -1){
                            recette.style.display="inline";
                        }else{
                            recette.style.display="none";
                        }
                    });
                    break;
            }            
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
window.onload = function(){
    // filtere les recettes
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
window.onload = function(){
    let inputs = $(".exemp");
    inputs.click(function(){
        switch(this.id){
            case "like":
                this.id = "unlike";
                break;
            case "unlike":
                this.id = "like";
                break;
            case "save":
                this.id = "unsave";
                break;
            case "unsave":
                this.id = "save";
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
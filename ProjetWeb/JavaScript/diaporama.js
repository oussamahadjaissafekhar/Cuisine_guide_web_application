function getTranslateX(myElement) {
    let string = myElement.css("translate");
    let ptranslat =  parseInt(string.substring(0,string.length-2))
    return ptranslat;
  }

async function translateDiapo(myElement,value,button){
    let ntranslat = getTranslateX(myElement) + value;
    if(ntranslat <= 0 && ntranslat >=(-2*3*295)){
        myElement.animate({translate: ntranslat+"px"},"slow");
        await new Promise(r => setTimeout(r, 450));
        
    }
    if(ntranslat == 0){
        button.style.visibility="hidden";
    }
      

}
window.onload = function(){
    // Les buttons du next et previous
    let buttonSlidePrevious = $("#buttonSlidePrevious");
    let buttonSlideNext = $("#buttonSlideNext");
    // Tableau contenant tous les images
    let range = [];
    let slides = $('.slide');
    console.log(slides.length)
    for(let i=0;i<slides.length;i++){
        let nbr = i+1;
        let string = ".slideShow div:nth-child("+nbr+")";
        let slide = $(string);
        range.push(slide);
    }

    // les indices des blocs iteratives 
    let i;
    let j;
    let carte ;
    // Les buttons du next et previous
    let buttonSlidePreviousCartes = $(".buttonPrevious");
    let buttonSlideNextCartes = $(".buttonNext");
    //cles cartes du
    let firstDiapoCarte = $("body > div.cadres > div:nth-child(1) > div > div > div");
    let secondDiapoCarte =$("body > div.cadres > div:nth-child(2) > div > div > div") ; 
    let thirdDiapoCarte =$("body > div.cadres > div:nth-child(3) > div > div > div") ;
    let fourthDiapoCarte =$("body > div.cadres > div:nth-child(4) > div > div > div") ;

    setInterval(function(){ 
        for( i=0;i<range.length;i++){
            if(!range[i].is(":hidden")){
                range[i].hide();
                if(i != range.length-1){break;}
            }
            if(i==range.length-1){
                for( j=0;j<range.length;j++){
                    range[j].show();
                }
            }
        }  
    }, 5000);

    buttonSlideNext.click(function(){
        for( i=0;i<range.length;i++){
            if(!range[i].is(":hidden")){
                range[i].hide();
                if(i != range.length-1){break;}
            }
            if(i==range.length-1){
                for( j=0;j<range.length;j++){
                    range[j].show();
                }
            }
        }
    })

    buttonSlidePrevious.click(function(){
        for( i=0;i<range.length;i++){
            if(!range[i].is(":hidden")){
                if(i==0){
                    for( j=0;j<range.length-1;j++){
                        range[j].hide();
                    }
                    break
                }else{
                    if(range[i-1].is(":hidden")){
                        range[i-1].show();
                        break;
                    } 
                }                      
            }
        }
    })

    buttonSlidePreviousCartes.css({"visibility" : "hidden"})
    buttonSlideNextCartes.click(async function(){
    
    switch (this) {
        case buttonSlideNextCartes[0]:
            buttonSlidePreviousCartes[0].style.visibility="visible";
            carte = firstDiapoCarte;
            break;
        case buttonSlideNextCartes[1]:
            buttonSlidePreviousCartes[1].style.visibility="visible";
            carte = secondDiapoCarte;
            break;
        case buttonSlideNextCartes[2]:
            buttonSlidePreviousCartes[2].style.visibility="visible";
            carte = thirdDiapoCarte;
            break;
        case buttonSlideNextCartes[3]:
            buttonSlidePreviousCartes[3].style.visibility="visible";
            carte = fourthDiapoCarte;
            break;
    }
        translateDiapo(carte,-3*295);
   })
   buttonSlidePreviousCartes.click(async function(){
    switch (this) {
        case buttonSlidePreviousCartes[0]:
            carte = firstDiapoCarte;
            break;
        case buttonSlidePreviousCartes[1]:
            carte = secondDiapoCarte;
            break;
        case buttonSlidePreviousCartes[2]:
            carte = thirdDiapoCarte;
            break;
        case buttonSlidePreviousCartes[3]:
            carte = fourthDiapoCarte;
            break;
    }
        translateDiapo(carte,3*295,this);
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

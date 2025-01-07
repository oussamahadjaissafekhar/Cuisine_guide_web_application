window.onload = function (){
let ajouterNew = $('#ajouterNew');
let ajouterParam = $('#ajouterParam');
let fermerForm = $('#fermerForm')
let paramForm = $('.parametre')
let newForm = $('.new');
let tableNews = $('.tableNews')
ajouterNew.click(function(){
    newForm.show();
    ajouterParam.show();
    paramForm.hide();
    tableNews.hide();
    ajouterNew.hide();
})
ajouterParam.click(function(){
    paramForm.show();
    newForm.hide();
    tableNews.hide();
    ajouterNew.show();
    ajouterParam.hide();
})
fermerForm.click(function(){
    ajouterNew.show();
    ajouterParam.show();
    newForm.hide();
    paramForm.hide();
    tableNews.show();
})

////////////////////////////////////////////////////

let typeSelect = $('#typeSelect');
let recetteSelect = $('#recetteSelect');
let newSelect = $('#newSelect');
typeSelect.change(function(){
    if(typeSelect.val() == 'new'){
        newSelect.show();
        recetteSelect.hide();
    }else{
        newSelect.hide();
        recetteSelect.show();
    }
})
}
const nouveauPassword = document.querySelector("#nouveauPassword");
const confirmNouveauPassword = document.querySelector("#confirmNouveauPassword");
 //lorsque l'on relache la touche clavier, on lance la vérification
 nouveauPassword.addEventListener("keyup",function(){
    verificationPassword();
 })
//lorsque l'on relache la touche clavier, on lance la vérification
confirmNouveauPassword.addEventListener("keyup",function(){
    verificationPassword();
 })

 //function de verification qui compare les deux mots de passe
 //puis affiche le bouton si c'est bon sinon un message d'erreur

 function verificationPassword(){
    if(nouveauPassword.value===confirmNouveauPassword.value){
        document.querySelector("#btnValidation").disabled=false;
        document.querySelector("#erreur").classList.add("d-none");
    }else{
        document.querySelector("#btnValidation").disabled=true;
        document.querySelector("#erreur").classList.remove("d-none");
    }
 }
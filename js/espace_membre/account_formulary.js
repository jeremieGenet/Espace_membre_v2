
function initHtml(balise, id="", textContent, methodForm, name="", typeInput, placeholder){
    balise = document.createElement(balise);
    balise.id = id;
    balise.classList.add();
    //divPassword_confirm.classList.add("form-group");
    balise.textContent = textContent;
    balise.method = methodForm;
    balise.name = name;
    balise.type = typeInput;
    balise.placeholder = placeholder;

    return balise;
}


function insert(parent, enfant){
    //PARENT.AjouteEnfant(ENFANT)
    parent.appendChild(enfant);
    // divFormulary.appendChild(formPassword);
}

function getEltById(elt){
    return document.getElementById(elt);
}
  

// On récup les liens via leurs id
const lienPassword = document.getElementById('changePassword'); // On récupère l'élément sur lequel on veut détecter le clic
const lienAvatar = document.getElementById('avatar'); // On récup le lien id = avatar

// Création de compteur de formulaire (pour éviter qu'ils se répètent)
var countFormPass = 0; 
var countFormAvatar = 0;

// Si on clic sur le lien id = changePassword alors...
if(lienPassword.addEventListener('click', function(event) {
    event.preventDefault(); // On supprime le fonctionnement par défaut
     
    // ON SUPPRIME LE FORMULAIRE AVATAR S'IL EST PRESENT
    if(countFormAvatar >= 1){
        document.getElementById("formulary").removeChild(document.getElementById("formAvatar"));
        //console.log("formulaire password = " + formPass); 
        countFormAvatar = 0;
        //console.log(countFormPass);
    }

    // S'il n'y a pas de formulaire password déjà présent alors...
    if(countFormPass == 0){
        // ON CREE LE FORMULAIRE PASSWORD
        formPass = initHtml("form", "formId", "", "POST");
        divPass = initHtml("div", "divPass")
        divPass.classList.add("form-group");
        labelPass = initHtml("label", "", "Changer de mot de passe");
        inputPass = initHtml("input", "", "", "", "mdp", "password", "Nouveau mot de passe");
        inputPass.classList.add("form-control");

        divPass_confirm = initHtml("div", "divPass_confirm")
        divPass_confirm.classList.add("form-group");
        labelPass_confirm = initHtml("label", "", "Confirmer le nouveau mot de passe");
        inputPass_confirm = initHtml("input", "", "", "", "mdp2", "password", "Confirmation de mot de passe");
        inputPass_confirm.classList.add("form-control");

        buttonPass = initHtml("button", "", "Enregistrer les modifications", "", "buttonPassword", "submit");
        buttonPass.classList.add("btn");
        buttonPass.classList.add("btn-primary");

        insert(divPass, labelPass);
        insert(divPass, inputPass);
        
        insert(formPass , divPass);

        insert(divPass_confirm, labelPass_confirm);
        insert(divPass_confirm, inputPass_confirm);
        insert(formPass , divPass_confirm);
        insert(formPass, buttonPass);
        
        formulary = getEltById("formulary");
        insert(formulary, formPass);

        // On incrément le compteur de formulaire de changement de mot de passe
        countFormPass ++;
    }

})){
// Sinon si on click sur le lien id = avatar alors...
}else if (lienAvatar.addEventListener('click', function(event){
    event.preventDefault();

    // ON SUPPRIME LE FORMULAIRE PASSWORD S'IL EST PRESENT
    if(countFormPass >= 1){
        document.getElementById("formulary").removeChild(document.getElementById("formId"));
        countFormPass = 0;
    }
    
    // S'il n'y a pas de formulaire avatar déjà présent alors...
    if(countFormAvatar == 0){
        // ON CREE LE FORMULAIRE AVATAR
        const formAvatar = document.createElement("form"); // Création d'une balise form
        formAvatar.method = "POST"; // On lui donne la méthode POST
        formAvatar.id = "formAvatar";

        const divAvatar = document.createElement("div");
        divAvatar.classList.add("form-group");
        divAvatar.id = "divAvatar";
        const labelAvatar = document.createElement("label");
        labelAvatar.textContent = "Ajouter/modifier photo de profil";
        const inputAvatar = document.createElement("input");
        inputAvatar.type = "url";
        inputAvatar.name = "avatar";
        inputAvatar.classList.add("form-control");
        inputAvatar.placeholder = "Entrer l'url de votre photo de profil";

        const buttonAvatar = document.createElement("button");
        buttonAvatar.type = "submit";
        buttonAvatar.name = "buttonAvatar";
        buttonAvatar.classList.add("btn");
        buttonAvatar.classList.add("btn-primary");
        buttonAvatar.textContent = "Ajouter/modifier ma photo de profil";

        document.getElementById('formulary').appendChild(formAvatar); // On insère le formulaire de changement de password dans la div id = formulary
        
        document.getElementById('formAvatar').appendChild(divAvatar);
        document.getElementById('divAvatar').appendChild(labelAvatar);
        document.getElementById('divAvatar').appendChild(inputAvatar);

        document.getElementById('formAvatar').appendChild(buttonAvatar);

        // Incrémentation de compteur de formulaire avatar
        countFormAvatar++;
    }

})){
};





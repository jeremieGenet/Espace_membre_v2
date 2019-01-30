
console.log('Est-ce que cela fonctionne?');


var isValidUrl = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.​\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[​6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1​,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00​a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u​00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;

//var url1 = "http://randomuser.me/api/portraits/men/1.jpg";
var url1 = "www.jeremie-genet.fr";

console.log(isValidUrl.test(url1)) //=> true/false


var urlFormat = new RegExp(
    "^" +
      // protocol identifier (optional)
      // short syntax // still required
      "(?:(?:(?:https?|ftp):)?\\/\\/)" +
      // user:pass BasicAuth (optional)
      "(?:\\S+(?::\\S*)?@)?" +
      "(?:" +
        // IP address exclusion
        // private & local networks
        "(?!(?:10|127)(?:\\.\\d{1,3}){3})" +
        "(?!(?:169\\.254|192\\.168)(?:\\.\\d{1,3}){2})" +
        "(?!172\\.(?:1[6-9]|2\\d|3[0-1])(?:\\.\\d{1,3}){2})" +
        // IP address dotted notation octets
        // excludes loopback network 0.0.0.0
        // excludes reserved space >= 224.0.0.0
        // excludes network & broacast addresses
        // (first & last IP address of each class)
        "(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])" +
        "(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}" +
        "(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))" +
      "|" +
        // host & domain names, may end with dot
        // can be replaced by a shortest alternative
        // (?![-_])(?:[-\\w\\u00a1-\\uffff]{0,63}[^-_]\\.)+
        "(?:" +
          "(?:" +
            "[a-z0-9\\u00a1-\\uffff]" +
            "[a-z0-9\\u00a1-\\uffff_-]{0,62}" +
          ")?" +
          "[a-z0-9\\u00a1-\\uffff]\\." +
        ")+" +
        // TLD identifier name, may end with dot
        "(?:[a-z\\u00a1-\\uffff]{2,}\\.?)" +
      ")" +
      // port number (optional)
      "(?::\\d{2,5})?" +
      // resource path (optional)
      "(?:[/?#]\\S*)?" +
    "$", "i"
  );

var url = "http://espacemembre_v2/index.phpespacemembreaccount";

console.log(urlFormat.test(url)) //=> true/false


const lienPassword = document.getElementById('changePassword'); // On récupère l'élément sur lequel on veut détecter le clic
const lienAvatar = document.getElementById('avatar'); // On récup le lien id = avatar

// Si on clic sur le lien id = changePassword alors...
if(lienPassword.addEventListener('click', function(event) {
    event.preventDefault();
    // C'est ici que ça se passe
    //console.log('on est dans la fonction du click sur changePassword !');

})){
    // Ici il ne se passe rien !
    //console.log('on est dans la Condition du click sur changePassword !');
// Sinon si on click sur le lien id = avatar alors...
}else if (lienAvatar.addEventListener('click', function(event){
    event.preventDefault();
    // C'est ici que ça se passe
    //console.log('on est dans la fonction du click sur avatar !');

})){
    // Ici il ne se passe rien !
    //console.log('on est dans la Condition du click sur avatar !');
};

// lienPassword.addEventListener('click', function(event) {   // On écoute l'événement click, notre callback prend un paramètre que nous avons appelé event ici
//     event.preventDefault();
    
//     if(lienPassword.innerHTML === "C'est cliqué !"){
//         lienPassword.innerHTML = "Un lien ramdom";
//         //event.preventDefault();
//     }else{
//         lienPassword.innerHTML = "C'est cliqué !";
//         //event.preventDefault();   
//     }
               
// });



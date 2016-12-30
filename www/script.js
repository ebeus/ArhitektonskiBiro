
window.onload = function() {
   
};

function spremi_podatke() {
    if(document.kontaktforma != 'undefined') {
    var forma = document.kontaktforma;
    if(typeof(Storage) !== "undefined") {
        localStorage.setItem("ime_i_prezime",forma.Ime.value);
        localStorage.setItem("email",forma.email.value);
        localStorage.setItem("tema",forma.tema.value);
    } else {
        alert("Nije podrzano");
    }
}
}

document.kontaktforma.addEventListner("onload",restore_podataka());
function restore_podataka() {
    if(document.kontaktforma != 'undefined') {
    var forma = document.kontaktforma
     if(typeof(Storage) !== "undefined") {
        forma.Ime.value = localStorage.getItem("ime_i_prezime");
        forma.email.value = localStorage.getItem("email");
        forma.tema.value = localStorage.getItem("tema");
    } else {
        alert("Nije podrzano");
    }
}
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function validateContactForm() {
    var error_message = document.getElementById('error_msg');
    var forma = document.kontakt_forma;
    error_message.style.color = "red";
    error_message.style.fontWeight = "bold";
    error_message.style.background = "#FFE5E5";
    if(forma.Ime.value == "") {
        error_message.innerHTML = "Ime nije upisano";
        return false;
    }
    
    if(forma.Ime.value.length < 6 || forma.Ime.value.length > 49) {
        error_message.innerHTML = "Prekratko ili predugačko ime";
        return false;
    }
    
    if(!validateEmail(forma.email.value)) {
        error_message.innerHTML = "E-mail nije validan";
        return false;
    }
    
    if(forma.tema.value == "") {
        error_message.innerHTML = "Tema nije upisana";
        return false;
    }
    
    if(forma.poruka.value == "") {
        error_message.innerHTML = "Poruka nije unesena";
        return false;
    }
    
    if(document.getElementById('pitanje').value == "") {
        error_message.innerHTML = "Poruka nije unesena";
        return false;
    }
    
    error_message.innerHTML ="";
    return true;
    
}

function validateUslugeForm() {
    var error_message = document.getElementById('error_msg');
    var forma = document.usluge_form;
    error_message.style.color = "red";
    error_message.style.fontWeight = "bold";
    error_message.style.background = "#FFE5E5";
    
    if(forma.Ime.value == "") {
        error_message.innerHTML = "Ime nije upisano";
        return false;
    }
    
    if(forma.Ime.value.length < 6 || forma.Ime.value.length > 49) {
        error_message.innerHTML = "Prekratko ili predugačko ime";
        return false;
    }
    
     if(!validateEmail(forma.email.value)) {
        error_message.innerHTML = "E-mail nije validan";
        return false;
    }
    
    if(forma.kvadratura.value < 5 || forma.kvadratura.value > 20000) {
        error_message.innerHTML = "Neodgovarajuća kvadratura";
        return false;
    }
    
    if(document.getElementById('poruka').value == "") {
        error_message.innerHTML = "Poruka nije unesena";
        return false;
    }
    
    return true;
}

function validateSearch() {
    var error_message = document.getElementById('error_msg_pretraga');
    var forma = document.search_form;
    error_message.style.color = "red";
    error_message.style.fontWeight = "bold";
    error_message.style.background = "#FFE5E5";
    
    if(forma.termin.value == "") {
        error_message.innerHTML="Prazno polje";
        return false;
    }
    return true;
}


function validateLogin() {
        var error_message = document.getElementById('error_msg');
        var forma = document.login_form;
        error_message.style.color = "red";
        error_message.style.fontWeight = "bold";
        error_message.style.background = "#FFE5E5";
        
        if(forma.username.value == "") {
            error_message.innerHTML = "Unesite username";
            return false;
        }
        
        if(forma.password.value == "") {
            error_message.innerHTML = "Unesite password";
            return false;
        }
}

function validateEdit() {
    var error_message = document.getElementById('error_msg');
    var forma = document.edit_forma;

    error_message.style.color = "red";
    error_message.style.fontWeight = "bold";
    error_message.style.background = "#FFE5E5";

    
}


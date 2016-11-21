var trenutnaSlika = 1;

function iduci(n) {
  prikazi(trenutnaSlika += n);
}

function trenutni(n) {
  prikazi(trenutnaSlika = n);
}

function prikazi(n) {
    var i;
    var slike = document.getElementsByClassName("prikaz_slike");
    var tacke = document.getElementsByClassName("dot");
    
    if(n > slike.length) {
        trenutnaSlika = 1;
    }
    
    if(n < 1) {
        trenutnaSlika = slike.length;
    }
    
    for(i = 0; i < slike.length; i++) {
        slike[i].style.display = "none";
    }
    
    for(i = 0; i < tacke.length; i++) {
        tacke[i].className = tacke[i].className.replace("active", "");
    }

    slike[trenutnaSlika - 1].style.display = "block";
    tacke[trenutnaSlika - 1].className += " active";
}

document.getElementsByClassName("prezentacija")[0].addEventListner("onload",prikazi(1));
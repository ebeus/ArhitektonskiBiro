# Arhitektonski Biro

#####**Student:** Beus Ervin
#####**Broj indexa:** 16430
####Projektni zadatak iz predmeta Web tehnologije.
-------------
###Opis teme
Pružanje usluga projektovanja, uređenja interijera i *consultinga*. Naručivanje i izrada projekta, pitanja i savjeti. 

Spirala 1:

I  - Šta je urađeno?

    +Dodate skice
    +Napisan HTML i CSS
    +Layouti stranica
    +Media queries za manje ekrane
    +HTML Forme
    +Meni
    
II  - Šta nije urađeno?

    +Nisam dodao stranicu za administratora
    
III - Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)

    +Forma za pretragu na stranici pitanja prelazi širinu wrapera na malim ekranima
        +Rješenje je podesiti širinu.
    +Nestabilan layout u projektima kad nedostaje opis
        +Rješenje je podesiti margine i širinu.
        
IV  - Bug-ovi koje ste primijetili ali ne znate rješenje

V  - Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi

        index.html  -   početna stranica
        projekti.html - stranica sa projektima
        login.html  -   forma za prijavu na stranicu
        about.html  -   o kompaniji
        contact.html    -   kontakt forma
        pitanja.html    -   lista prethodnih pitanja i odgovora, forma za postavljanje pitanja
        projekt-detalji.html    -   detaljne informacije o projektu
        projektx.jpg    -   testne slike
        logo.png    -logo
        skice
        
Spirala 2:

    1. Šta je urađeno
        1. Validacija formi
        2. Carousel 
        3. Localstorage
        4. Podstranice se učitavaju pomoću ajaxa
        5. Manje ispravke u dizajnu od prethodne spirale
    2. Šta nije urađeno
    3. Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)
    4. Bug-ovi koje ste primijetili ali ne znate rješenje
    5. Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi
        1. **galerija.js** skripta za carousel
        2. **subPageLoad.js** funkcije za učitavanje podstranica
        3. **script.js** funkcije validacije i funkcije localstorage-a
        4. **stil.css** CSS stranice
        5. **index.html** - početna stranica
        6. **pocetna.html** - prva podstranica koja se učitava u stranicu koristeci AJAX
        7. **projekti.html** - podstranica za prikaz projekata
        8. **projekt_detalji.html** - podstranica za prikaz detalja o projektu
        9. **pitanja.html** - podstranica za postavljanje pitanja
        10. **contact.html** - podstranica za kontakt
        11. **about.html** - podstranica koja prikazuje detalje o kompaniji
        12. **login.html** - login podstranica
        
Spirala 3:
    Username: admin Password: pass
    1. Šta je urađeno
        1. Unos, brisanje i editovanje XML fajlova  (admin može i editovati i brisati)
        2. Generisanje i download CSV fajla iz XML-a. Samo za admina.
        3. Generisanje i prikaz PDF-a iz XML-a. Samo za admina.
        4. Pretraga. Korisnik dobije sugestije za pretragu na osnovu XML fajla, prilikom klika na dugme traži izvršava se pretraga po tri polja (naslov, pitanje, odgovor na pitanje).
    2. Šta nije urađeno
        5. Deployment na OpenShift. Nije potvrđena registracija.
    3. Bug-ovi koje ste primijetili ali niste stigli ispraviti, a znate rješenje (opis rješenja)
    4. Bug-ovi koje ste primijetili ali ne znate rješenje
    5. Lista fajlova u formatu NAZIVFAJLA - Opis u vidu jedne rečenice šta se u fajlu nalazi
        1. add.php - dodaje se novi projekat
        2. remove.php - brisanje projekta
        3. admin.php - admin stranica (odogovori na pitanja, generisanje pdf i csv fajlova)
        4. edit.php - editovanje projektovanja
        5. search.js - javascript sa AJAX-om koja omogućava live search
        6. livesearch.php - php skripta, pretraga xml fajla
        7. search.php - stranica na kojoj se prikazuju rezultati pretrage
        8. spremi_odgovor.php - spremanje odgovora na pitanje (admin)
        9. send_contact.php - spremanje podatak iz kontakt forme
        10. Ostali php fajlovi vezani za rad stranice
        
Spirala 4:
    Stranica: http://arhbiro-arhitektonski-biro.44fs.preview.openshiftapps.com/
    Urađeno:
        1. **Napravljena MySQL baza sa tabelama **
        2. **Napisana skripta za prebacivanje podataka iz XML fajlova u bazu**
        3. **Sa podacima se radi kroz bazu umjesto XML **
        4. ** Hosting napravljen **
        5. ** Napravljena REST metoda za čitanje iz baze i vraćanje podataka u JSON formatu. **
        6. ** Web servis testiran**
    Nije urađeno:
        -
    Lista fajlova:
    
        ** Fajlovi su ostali uglavnom isti, izmjenjen je način pristupa podacima (XML->MySQL). **
        
        ** Dodana su dva nova fajla u odnosu na prethodnu spiralu: **
        
        **  rest.php -> web servis (prima HTTP zahtjeve i šalje odgovor) **
          
        **   baza.php -> razne funkcije za rad s bazom (čitanje, pisanje, brisanje) **
        
    Na screen shotovima se vidi GET request prema serveru, šalje se id, u tabeli se traži odgovarajući unos i vraća u JSON formatu.
    


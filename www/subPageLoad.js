function changesubPage(page) {
    var ajax = new XMLHttpRequest();
    
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 404)
            document.getElementById("sadrzaj").innerHTML = "Error 404 - Not Found";
            
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById("sadrzaj").innerHTML = ajax.responseText;
            history.pushState(page, "", window.location.href);
        
            if(page == 'pocetna.php' || page == 'pocetna.html') {
                var script = document.createElement('script');
                script.src = 'galerija.js';
                script.onload = function(){};
                document.head.appendChild(script);
            } else {
                var script = document.createElement('script');
                script.src = 'script.js';
                script.onload = function(){};
                document.head.appendChild(script);
            }

        }
    }
    ajax.open("GET", page, true);
    ajax.send();
}

window.onpopstate = function(event) {
    returnOnSubPage(event.state);
}

function returnOnSubPage(previousPage) {
    var ajax = new XMLHttpRequest();
    
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 404)
            document.getElementById("sadrzaj").innerHTML = "Error 404 - Not Found";
            
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.getElementById("sadrzaj").innerHTML = ajax.responseText;
            
            if(previousPage == 'pocetna.html') {
                var script = document.createElement('script');
                script.src = 'galerija.js';
                script.onload = function(){};
                document.head.appendChild(script);
            } else {
                var script = document.createElement('script');
                script.src = 'script.js';
                script.onload = function(){};
                document.head.appendChild(script);
            }
        }
    }
    ajax.open("GET", previousPage, true);
    ajax.send();
}

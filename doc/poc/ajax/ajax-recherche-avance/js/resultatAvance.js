function resulatVoitureAvance() {
    var xhttp;
    
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        
        if (this.responseText != ""){
            
            document.getElementById("listeDeVoiture").innerHTML = this.responseText;

        }
      }
    };
    var min;
    var max;

    switch(document.getElementById("annee").value)
        {
        case "1970-et-moin" :
            min = 1;
            max = 1970;
        break;
        case "1970-a-1979" :
            min = 1970;
            max = 1979;
        break;
        case "1980-a-1989" :
            min = 1980;
            max = 1989;
        break;
        case "1990-a-1999" :
            min = 1990;
            max = 1999;
        break;
        case "2000-a-2009" :
            min = 2000;
            max = 2009;
        break;
        case "2009-a-2019" :
            min = 2009;
            max = 2019;
        break;
        case "2019-et-plus" :
            min = 2019;
            max = 2100;
        break;
        }
    xhttp.open("GET", "resultatAvance.php?marque="+ document.getElementById("marque").value+"&modele="+ document.getElementById("modele").value +"&prix="+ document.getElementById("prix").value +"&kilometrage="+ document.getElementById("kilometrages").value +"&min="+ min +"&max="+ max +"&lang=fr", true);
    xhttp.send();   
  }
function showErreurPseudo(pseudo, pseudoSession) {
  var xhttp;
  if (pseudo.length == 0) { 
    document.getElementById("txtErreur").innerHTML = "";
    document.getElementById("txtErreur").classList.remove("msgErreur");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText != "" && pseudo != pseudoSession){
        document.getElementById("txtErreur").innerHTML = this.responseText;
        document.getElementById("inputModifierInfos").setAttribute("disabled","disabled");
        document.getElementById("txtErreur").classList.add("msgErreur");
      }else{
        document.getElementById("txtErreur").innerHTML = "";
        document.getElementById("inputModifierInfos").removeAttribute("disabled");
        document.getElementById("txtErreur").classList.remove("msgErreur");
      }
    }
  };
  xhttp.open("GET", "getErreur.php?p="+pseudo+"&c=", true);
  xhttp.send();   
}

function showErreurCourriel(courriel, courrielSession) {
  var xhttp;
  if (courriel.length == 0) { 
    document.getElementById("txtErreur").innerHTML = "";
    document.getElementById("txtErreur").classList.remove("msgErreur");
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText != "" && courriel != courrielSession){
        document.getElementById("txtErreur").innerHTML = this.responseText;
        document.getElementById("inputModifierInfos").setAttribute("disabled","disabled");
        document.getElementById("txtErreur").classList.add("msgErreur");
      }else{
        document.getElementById("txtErreur").innerHTML = "";
        document.getElementById("inputModifierInfos").removeAttribute("disabled");
        document.getElementById("txtErreur").classList.remove("msgErreur");
      }
    }
  };
  xhttp.open("GET", "getErreur.php?p="+"&c="+courriel, true);
  xhttp.send();
}
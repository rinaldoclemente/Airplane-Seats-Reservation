
function verificaIscrizioneJS() {
  var username = document.getElementById("Username").value;
  var psw = document.getElementById("PassIscriviti").value;
  var ripetiPsw = document.getElementById("RipetiPassword").value;
  var regolePsw = false;

  if(psw.match(/[a-z]+/)){
    if(psw.match(/[A-Z0-9]+/))
      var regolePsw = true;
  }

  if ((username === "") || (psw === "") || (ripetiPsw === "")) {
    window.alert("Compila tutti i campi per poter iscriverti!");
    return false;
  }
  else {
    if (verificaPassword() && regolePsw)
      return true;
    else {
      if (!regolePsw) {
        window.alert("Password non valida, controllare la NOTA!");
      } else {
        window.alert("Le due password devono coincidere!");
      }
      return false;
    }
  }
}

function verificaAccessoJS() {
  var username = document.getElementById("Username").value;
  var psw = document.getElementById("PassAccedi").value;

  if ((username === "") || (psw === "")) {
    window.alert("Compila tutti i campi!");
    return false;
  } else
    return true;
}


function verificaPassword() {
  var psw1 = document.getElementById("PassIscriviti").value;
  var psw2 = document.getElementById("RipetiPassword").value;
  var text = document.getElementById("testoPsw");

  var ret;
  if (psw1 === psw2) {
    text.innerHTML = "Le password corrispondono!"
    ret = true;
  } else {
    text.innerHTML = "Le password non corrispondono!";
    ret = false;
  }
  text.style.visibility = "visible";
  return ret;
}

function verificaPrenotazioneJS(posto){
  var classe = document.getElementById(posto).className;
    $.ajax({type:'POST', url: "php/prenotazione.php", data: {posto: posto, classe: classe}, success: function(result){
      switch (result) {

        case "acquistato":
        document.getElementById(posto).className = "item_grid_red";
        window.alert("Il posto "+posto+" è stato già acquistato!");
          break;
        case "prenotaInsert":
        document.getElementById(posto).className = "item_grid_yellow";
          break;
        case "prenotaUpdate":
        document.getElementById(posto).className = "item_grid_yellow";
          break;
        case "ritornaVerde":
        document.getElementById(posto).className = "item_grid_green";
          break;
        case "diventaArancione":
        document.getElementById(posto).className = "item_grid_orange";
          break;
        default:
          window.alert("Tempo di inattività maggiore di due minuti, per favore effettua di nuovo il login!");
          window.location.href = "accedi.php";
          break;
        }
      var qtY = document.getElementsByClassName("item_grid_yellow").length;
      var qtR = document.getElementsByClassName("item_grid_red").length;
      var qtO = document.getElementsByClassName("item_grid_orange").length;
      var qtG = document.getElementsByClassName("item_grid_green").length;
      document.getElementById('nPostiPrenUser').innerHTML = "Posti prenotati da te: "+qtY;
      document.getElementById('nPostiPrenAltri').innerHTML = "Posti prenotati da altri: "+qtO;
      document.getElementById('nPostiAcquistati').innerHTML = "Posti acquistati: "+qtR;
      document.getElementById('nPostiDisponibili').innerHTML = "Posti disponibili: "+qtG;
    }});
}

function verificaNumeroPostiGialli(){
  var nPostiGialli = document.getElementsByClassName("item_grid_yellow").length;
  $.ajax({type:'POST', url: "php/acquisto.php", data: {nPostiGialli: nPostiGialli}, success: function(result){
    switch (result) {
      case "no":
          window.alert("Non è possibile terminare l'acquisto, uno o più posti scelti sono stati prenotati dopo di lei!\n\nIl posto risulterà:\n-VERDE: se l'utente dopo di lei ha annullato la prenotazione.\n-ARANCIONE: se il posto è ancora prenotato per un altro utente.\n-ROSSO: se il posto è stato acquistato.");
          aggiorna();
        break;
      case "ok":
        window.alert("Acquisto effettuato con successo!");
        aggiorna();
        break;
      case "err":
        window.alert("Per acquistare un posto devi prima prenotarlo cliccandoci sopra!");
        break;
      default:
        window.alert("Tempo di inattività maggiore di due minuti, per favore effettua di nuovo il login!");
        window.location.href = "accedi.php";
        break;
    }
  }});
}

function aggiorna(){
    history.go(0);
}

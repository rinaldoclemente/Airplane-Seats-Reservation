# Airplane-Seats-Reservation
Simplified version of a website to manage airplane seat reservation

Si realizzi una versione semplificata di un sito web per gestire la prenotazione di posti su un aeroplano. Per semplicità si
considerino le prenotazioni per un solo aereo ed un solo viaggio. Si consideri una cabina con posti disposti secondo uno
schema rettangolare di dimensione nota (6 posti in larghezza x 10 posti in lunghezza). Tali valori devono essere
modificabili con semplicità tramite l’impostazione di due variabili in un’unica posizione nel codice PHP. I posti in una
fila sono indicati con una lettera a partire da A, le file con un numero a partire da 1. Il sito web deve avere le seguenti
caratteristiche:

1. Nella pagina iniziale del sito è possibile visionare liberamente la mappa dei posti che mostra, tramite colori
differenziati, i posti acquistati (rossi), quelli liberi (verdi) o quelli prenotati da un qualsiasi utente (arancione). La pagina
deve anche visualizzare il numero totale dei posti, il numero totale di quelli acquistati, di quelli prenotati, e di quelli
liberi.

2. L’operazione di prenotazione dei posti selezionati è possibile solamente tramite registrazione o autenticazione sul
sito. Ogni utente può registrarsi liberamente sul sito fornendo solamente uno username, che deve essere un'email valida,
ed una password che deve contenere almeno un carattere alfabetico minuscolo, ed almeno un altro carattere che sia
alfabetico maiuscolo oppure un carattere numerico. In caso contrario l'utente deve essere avvertito prima dell'invio della
password al server, e comunque la registrazione deve essere impedita.

3. Un utente autenticato vede, nella sua pagina personale, la mappa dei posti. In aggiunta, l’utente autenticato può
prenotare posti. Per prenotare un posto è possibile cliccare su un posto libero (verde) o anche prenotato da altri
(arancione). Senza ricaricare la pagina, deve essere interrogato il server per verificare che il posto non sia stato
acquistato nel frattempo. In tal caso, il posto viene visualizzato come prenotato (in giallo) e tale prenotazione è
memorizzata sul server. Se il posto nel frattempo fosse stato acquistato, il posto deve essere visualizzato di colore rosso,
e non deve ovviamente essere più selezionabile dall’utente. Se il posto fosse stato in precedenza prenotato (ma non
acquistato) da un altro utente, la prenotazione inserita da quell’utente viene rimossa e viene inserita, al suo posto, la
prenotazione fatta dall’ultimo utente. In ogni caso, a fronte di un click su un posto, deve essere mostrato un apposito
messaggio che indichi quanto successo e colori il posto coerentemente al suo stato. Un click su un proprio posto
prenotato (in giallo) deve liberarlo, senza ricaricare la pagina, ma comunicandolo al server.

4. La mappa dei posti viene completamente aggiornata solamente a fronte della pressione di un apposito bottone
“Aggiorna” utilizzabile da qualunque utente autenticato, o tramite l’operazione di acquisto. I posti prenotati da un altro
utente ma non acquistati devono essere mostrati in arancione.

5. Dopo aver effettuato la prenotazione di almeno un posto, deve essere possibile inviare al server, tramite un apposito
bottone “Acquista”, la richiesta di acquistare i posti (gialli) correntemente visualizzati sulla mappa. Tutti i posti devono
essere acquistati così come visualizzati. Se tale operazione non è possibile, l’utente deve essere informato, e tutti i posti
prenotati devono essere liberati, e verranno visualizzati sulla mappa in base al nuovo stato. Se l’acquisto ha successo, i
posti devono essere segnati tutti come acquistati e verranno visualizzati in rosso sulla mappa. In ogni caso, la pagina
viene ricaricata mostrando l’effettivo stato di tutti i posti così come conosciuto dal server, ed un apposito messaggio
deve indicare all’utente quanto successo o l’eventuale motivazione del fallimento dell’operazione.

6. Esempio:
Inizialmente non ci sono posti occupati.
L’utente u1@p.it clicca 3 volte, per prenotare i posti A1, A2, B2, che diventano gialli.
L’utente u2@p.it, essendo entrato nel sito quando la mappa di posti li mostrava tutti ancora liberi, clicca per prenotare il
posto B2. Il posto B2 è ora prenotato per l’utente u2@p.it. Ora compare in giallo. L’utente u1@p.it è ignaro di quanto
accaduto.
L’utente u1@p.it preme il bottone di acquisto, così inviando la richiesta di acquisto al server. Il server riconosce che il
posto B2, richiesto da u1@p.it, non è prenotato per lui, e quindi rifiuta la richiesta, liberando tutti i posti prenotati da
u1@p.it. Ora l’unico posto prenotato è B2 da u2@p.it. L’utente u1@p.it vede la mappa dei posti con B2 in arancione e
tutti gli altri in verde.
L’utente u2@p.it prenota il posto B3 e B4, e procede al loro acquisto. Il server conferma l’operazione e i posti B2 B3
B4 diventano acquistati (quindi rossi).
L’utente u1@p.it prenota il posto B4: senza ricaricare la pagina, l’utente u1@p.it viene notificato dell’impossibilità di
prenotare il posto B4 in quanto acquistato. La mappa visualizzata dall’utente u1@p.it è tutta verde, tranne B4 in rosso e
B2 in arancione.
L’utente u1@p.it prenota i posti A4 D4 F4, che compaiono per lui tutti in giallo
L’utente u2@p.it prenota il posto F4, che quindi gli comparirà in giallo.
L’utente u1@p.it preme il bottone aggiorna e vedrà una mappa in cui il posto F4 è diventato arancione.
Stato finale della mappa visualizzato in prima pagina: B2 B3 B4 rossi, A4 D4 F4 in arancione.

6. Nel progetto consegnato devono essere già presenti due utenti u1@p.it, u2@p.it, con password p1, p2, che si trovano
nella situazione al termine dell'esempio precedente.

7. L’autenticazione o registrazione attraverso username e password rimane valida finché l’utente non ha periodi di
inattività superiori a 2 minuti. Se un utente tenta di eseguire un'operazione che richiede registrazione o autenticazione
dopo che l'inattività è stata superiore a 2 minuti l'operazione non ha effetto e l’utente è costretto a ri-autenticarsi con
username e password. Deve essere imposto l'utilizzo del protocollo HTTPS per la registrazione e l'autenticazione ed in
ogni parte del sito che mostra informazioni relative ad un utente registrato o autenticato.

8. L’aspetto generale delle pagine web dovrà contenere: una intestazione nella parte superiore, una barra di navigazione
sul lato sinistro con i link o bottoni per poter effettuare le varie operazioni possibili, ed una parte centrale in cui avviene
l’operazione principale.

9. I cookies e il Javascript debbono essere abilitati, altrimenti il sito può non funzionare correttamente (in caso
contrario, per i cookies avvertire l’utente e impedire il funzionamento del sito, per il Javascript avvertire l'utente). I form
debbono prevedere brevi messaggi di spiegazione sul significato dei vari campi, che possono essere presenti all'interno
dei campi stessi o comparire nel momento in cui il puntatore si trova sopra il campo stesso.
10. Bisogna fare in modo che la visualizzazione, anche semplice, sia quanto più possibile uniforme al variare del
browser utilizzato.

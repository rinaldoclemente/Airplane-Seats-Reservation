<?php
session_start();

//require_once 'verificaRigheColonne.php'; //per resettare il DB

// Valori di righe e colonne modificabili tramite due variabili in php
$righe = 10; // Numero di righe
$col = 6; // Numero di colonne

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "s259536";

$SessionTime=120 ; // 2 minuti

// Se l'user è già loggato
if (isset($_SESSION['user259536'])) {
    $username = $_SESSION['user259536'];

    if (isset($_SESSION['time259536'])) {
        $diff = time() - $_SESSION['time259536'];
        if ($diff > $SessionTime) {
            $loggedIn = false;

            $_SESSION = array();

            if (session_id() != "" || isset($_COOKIE[session_name()]))
                setcookie(session_name(), '', time() - 2592000, '/');

            session_unset(); // libera le variabili di sessione
            session_destroy(); // ddistruggo la sessione

            header('HTTP/1.1 307 temporary redirect');
            if ($_SERVER["REQUEST_URI"] == "/~s259536/45ac14/index.php" || $_SERVER["REQUEST_URI"] == "/~s259536/45ac14/area.php" ||
            $_SERVER["REQUEST_URI"] == "/~s259536/45ac14/accedi.php" || $_SERVER["REQUEST_URI"] == "/~s259536/45ac14/iscriviti.php"){
              header('Location:accedi.php?msg=SessioneScaduta');
            }
            else if ($_SERVER["REQUEST_URI"] == "/~s259536/45ac14/php/prenotazione.php"){
              header('Location:prenotazione.php?msg=SessioneScaduta');
            }
            else if($_SERVER["REQUEST_URI"] == "/~s259536/45ac14/php/acquisto.php"){
              header('Location:acquisto.php?msg=SessioneScaduta');
            }
            else{
              header('Location:../accedi.php?msg=SessioneScaduta');
            }

            exit();
        }
    }

    $_SESSION['time259536'] = time();
    $loggedIn = true;
} else
    $loggedIn = false;
?>

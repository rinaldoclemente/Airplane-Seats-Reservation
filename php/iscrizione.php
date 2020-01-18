<?php
require_once 'sessione.php';
require_once 'controllaCookie.php';
require_once 'funzioni.php';
?>
<?php
if (count($_POST) === 0) {
    if (isset($loggedIn) && ($loggedIn)) {
        echo '<script type="text/javascript">window.alert("Sei già loggato");window.location.href = "../index.php";</script>';
    } else {
        echo '<script type="text/javascript">window.alert("Premere OK e compilare i campi!");window.location.href = "../iscriviti.php";</script>';
    }
} elseif (! verificaCampiIscrizione()) {
    echo '<script type="text/javascript">window.alert("Valori non validi!");window.location.href = "../iscriviti.php";</script>';
} else {

    $conn = connessioneDB($db_host, $db_user, $db_pass, $db_name);
    if ($conn !== false) {
        $user = sanitizeString($conn, $_POST['email']);
        $pass = hash('sha512', $_POST['password']); /* Hash della password */
        try {

            if (! verificaUsername($conn, "utenti", $user)) {
                echo $user;
                echo '<script type="text/javascript">window.alert("L\'username è già in uso!");window.location.href = "../iscriviti.php";</script>';
                exit();
            }

            if (! mysqli_autocommit($conn, false)) {
                throw new Exception("Impossibile settare l'autocommit a FALSE");
            }

            $res = mysqli_query($conn, "SELECT * FROM utenti FOR UPDATE"); // FOR UPDATE forza il lock sui dati letti dalla select (SLIDE)
            if (! $res) /* LOCK in SHARE MODE - lock per prevenire la concorrenza */ {
                throw new Exception("Query dalla tabella utenti non riuscita!");
            }

            mysqli_free_result($res);
            $res = mysqli_query($conn, "INSERT INTO utenti (email, password) VALUES ('$user', '$pass')");
            if (! $res) {
                throw new Exception("Inserimento nel database non riuscito!");
            }

            if (! mysqli_commit($conn)) {
                throw new Exception("Impossibile effettuare l'operazione!");
            }

            if (! mysqli_autocommit($conn, true)) {
                throw new Exception("Impossibile settare l'autocommit a TRUE");
            }
        } catch (Exception $e) {
            mysqli_rollback($conn);
            mysqli_autocommit($conn, true);
            echo $e->getMessage();
        }
        mysqli_close($conn);
        echo '<script type="text/javascript">window.alert(' . '"' . $user . ' registrato con successo!");window.location.href = "../accedi.php";</script>';
    }
}

?>
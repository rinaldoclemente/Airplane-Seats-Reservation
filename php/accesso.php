<?php
require_once 'sessione.php';
require_once 'controllaCookie.php';
require_once 'funzioni.php';

if (isset($loggedIn) && ($loggedIn))
    echo '<script type="text/javascript">window.alert("Sei già loggato!");window.location.href = "../index.php";</script>';
else {
    if (count($_POST) == 0)
        echo '<script type="text/javascript">window.alert("Premere OK e Accedi!");window.location.href = "../index.php";</script>';
    elseif (! verificaCampiAccesso())
        echo '<script type="text/javascript">window.alert("Mancano dei dati!");window.location.href = "../accedi.php";</script>';
    else {
        $conn = connessioneDB($db_host, $db_user, $db_pass, $db_name);
        if ($conn != false) {
            $user = sanitizeString($conn, $_POST['email']);
            $pass = hash('sha512', $_POST['password']); /* sha512 crea l'hash della password */

            if (verificaAccesso($conn, 'utenti', $user, $pass)) {
                $_SESSION['user259536'] = $user;
                $username = $user;
                $_SESSION['pass259536'] = $pass;
                $_SESSION['time259536'] = time();
                $loggedIn = true;
                echo '<script type="text/javascript">window.location.href = "../area.php";</script>';
            } else
                echo '<script type="text/javascript">window.alert("Email e/o password errati, premere OK e riprovare!");window.location.href = "../accedi.php";</script>';
            mysqli_close($conn);
        }
    }
}
?>
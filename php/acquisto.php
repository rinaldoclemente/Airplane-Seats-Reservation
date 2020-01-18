<?php
require_once 'sessione.php';
require_once 'funzioni.php';

if (count($_POST) == 0) {
    echo '<script type="text/javascript">window.alert("Errore nella prenotazione!");window.location.href = "../area.php";</script>';
}
else {

  $conn = connessioneDB($db_host, $db_user, $db_pass, $db_name);
  if ($conn == false) {
      echo "Connection Error (" . mysqli_connect_errno() . ")" . mysqli_connect_error();
      return false;
  }
  else {
    $nPostiGialli = $_POST['nPostiGialli'];
    $statoposto = 0;

    if($_SESSION['user259536'] == '' || !$loggedIn || !isset($_SESSION['user259536'])){
      echo '';
      exit();
    }

    $user = $_SESSION['user259536'];
    $count = 0;

    $res = mysqli_query($conn, "SELECT COUNT(*) as count FROM statoposti WHERE utente='$user' AND stato=1 FOR UPDATE"); // FOR UPDATE forza il lock sui dati letti dalla select (SLIDE)
    if (! $res) /* LOCK in SHARE MODE - lock per prevenire la concorrenza */ {
        throw new Exception("Query dalla tabella statoposti non riuscita!");
    } else {
        $row = mysqli_fetch_array($res, MYSQLI_BOTH);
        $count = $row['count'];
    }
  }
}
if ($count == $nPostiGialli) { // si può procedere con l'acquisto
  if ($count != 0) {
      try {

          if (! mysqli_autocommit($conn, false)) {
              throw new Exception("Impossibile settare l'autocommit a FALSE");
          }
          mysqli_free_result($res);
          $res = mysqli_query($conn, "UPDATE statoposti SET stato=2 WHERE utente='$user' AND stato=1");
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
      echo 'ok';
  } else {
      echo 'err';
  }
} else {
    try {

        if (! mysqli_autocommit($conn, false)) {
            throw new Exception("Impossibile settare l'autocommit a FALSE");
        }
        mysqli_free_result($res);
        $res = mysqli_query($conn, "DELETE FROM statoposti WHERE utente='$user' AND stato=1");
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
    echo 'no';
}
?>
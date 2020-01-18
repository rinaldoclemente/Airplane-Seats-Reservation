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
  else{
    $posto = $_POST['posto'];
    $classe = $_POST['classe'];
    $statoposto = 0;

    if($_SESSION['user259536'] == '' || !$loggedIn || !isset($_SESSION['user259536'])){
      echo '';
      exit();
    }

    $user = $_SESSION['user259536'];

    $res = mysqli_query($conn, "SELECT * FROM statoposti WHERE posto='$posto' FOR UPDATE"); //FOR UPDATE forza il lock sui dati letti dalla select (SLIDE)
    if (!$res) /* LOCK in SHARE MODE - lock per prevenire la concorrenza */ {
        throw new Exception("Query dalla tabella statoposti non riuscita!");
    }
    else{
      $row = mysqli_fetch_array($res, MYSQLI_BOTH);
      if ($row['posto']==$posto){
        if($row['stato'] == 2){
          $statoposto = "acquistato";
        }
        else{
          if($row['utente'] == $user){ //se lo vede giallo ed è suo
            $statoposto = "ritornaVerde";
          }
          else{
            if ($classe == "item_grid_yellow"){ //se lo vede giallo ma è stato prenotato
              $statoposto = "diventaArancione";
            }
            else{
            $statoposto = "prenotaUpdate";
            }
          }
        }
      }
      else{
        if ($classe == "item_grid_yellow"){ //se lo vede giallo ma è stato prenotato e l'altro utente ha annullato
          $statoposto = "ritornaVerde";
        }
        else{
          $statoposto = "prenotaInsert";
        }
      }
    }
  }
}

switch ($statoposto) {
  case "acquistato":
    echo $statoposto;
    break;
  case "diventaArancione":
    echo $statoposto;
    break;
  case "ritornaVerde":
    try {

      if (!mysqli_autocommit($conn, false)) {
        throw new Exception("Impossibile settare l'autocommit a FALSE");
      }
      mysqli_free_result($res);
      $res = mysqli_query($conn, "DELETE FROM statoposti WHERE posto='$posto'");
      if (!$res) {
          throw new Exception("Update nel database non riuscito!");
      }

      if (!mysqli_commit($conn)) {
          throw new Exception("Impossibile effettuare l'operazione!");
      }

      if (!mysqli_autocommit($conn, true)) {
          throw new Exception("Impossibile settare l'autocommit a TRUE");
      }


    } catch (Exception $e) {
      mysqli_rollback($conn);
      mysqli_autocommit($conn, true);
      echo $e->getMessage();
    }

    echo $statoposto;
    break;

  case "prenotaInsert":
    try {

      if (!mysqli_autocommit($conn, false)) {
          throw new Exception("Impossibile settare l'autocommit a FALSE");
      }

      mysqli_free_result($res);
      $res = mysqli_query($conn, "INSERT INTO statoposti (posto,utente,stato) VALUES ('$posto','$user', 1)");
      if (!$res) {
          throw new Exception("Inserimento nel database non riuscito!");
      }

      if (!mysqli_commit($conn)) {
          throw new Exception("Impossibile effettuare l'operazione!");
      }

      if (!mysqli_autocommit($conn, true)) {
          throw new Exception("Impossibile settare l'autocommit a TRUE");
      }

    } catch (Exception $e) {
      mysqli_rollback($conn);
      mysqli_autocommit($conn, true);
      echo $e->getMessage();
    }

    echo $statoposto;
    break;

    case "prenotaUpdate":
      try {

        if (!mysqli_autocommit($conn, false)) {
          throw new Exception("Impossibile settare l'autocommit a FALSE");
        }
        mysqli_free_result($res);
        $res = mysqli_query($conn, "UPDATE statoposti SET utente='$user' WHERE posto='$posto'");
        if (!$res) {
            throw new Exception("Update nel database non riuscito!");
        }

        if (!mysqli_commit($conn)) {
            throw new Exception("Impossibile effettuare l'operazione!");
        }

        if (!mysqli_autocommit($conn, true)) {
            throw new Exception("Impossibile settare l'autocommit a TRUE");
        }

      } catch (Exception $e) {
        mysqli_rollback($conn);
        mysqli_autocommit($conn, true);
        echo $e->getMessage();
      }

      echo $statoposto;
      break;
}
 ?>
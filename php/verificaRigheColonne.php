<?php
require_once 'funzioni.php';

$righe = 10; // Numero di righe
$col = 6; // Numero di colonne

$db_host = "localhost";
$db_user = "s259536";
$db_pass = "ariessss";
$db_name = "s259536";

$conn = connessioneDB($db_host, $db_user,$db_pass,$db_name);
if ($conn == false) {
  echo "Connection Error (" . mysqli_connect_errno() . ")" . mysqli_connect_error();
  return false;
}
else{
  $res = mysqli_query($conn, "SELECT COUNT(*) as count FROM infoDB WHERE righe='$righe' AND colonne='$col' FOR UPDATE"); //FOR UPDATE forza il lock sui dati letti dalla select (SLIDE)
  if (!$res) /* LOCK in SHARE MODE - lock per prevenire la concorrenza */ {
      throw new Exception("Query dalla tabella statoposti non riuscita!");
  }
  else{
    $row = mysqli_fetch_array($res, MYSQLI_BOTH);
    $count = $row['count'];
  }

  if($count == 0){
    try {

      if (!mysqli_autocommit($conn, false)) {
        throw new Exception("Impossibile settare l'autocommit a FALSE");
      }

      $res = mysqli_query($conn, "DELETE FROM statoposti");
      if (!$res) {
          throw new Exception("Update nel database non riuscito!");
      }

      if (!mysqli_commit($conn)) {
          throw new Exception("Impossibile effettuare l'operazione!");
      }

      if (!mysqli_autocommit($conn, true)) {
          throw new Exception("Impossibile settare l'autocommit a TRUE");
      }

      if (!mysqli_autocommit($conn, false)) {
        throw new Exception("Impossibile settare l'autocommit a FALSE");
      }

      $res = mysqli_query($conn, "DELETE FROM infodb");
      if (!$res) {
          throw new Exception("Update nel database non riuscito!");
      }

      if (!mysqli_commit($conn)) {
          throw new Exception("Impossibile effettuare l'operazione!");
      }

      if (!mysqli_autocommit($conn, true)) {
          throw new Exception("Impossibile settare l'autocommit a TRUE");
      }

      if (!mysqli_autocommit($conn, false)) {
        throw new Exception("Impossibile settare l'autocommit a FALSE");
      }

      $res = mysqli_query($conn, "INSERT INTO infodb (id,righe,colonne) VALUES (1,'$righe','$col')");
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
  }
  else{
    //righe e colonne sono le stesse
  }
}

 ?>

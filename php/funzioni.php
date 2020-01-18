<?php

function connessioneDB($server, $user, $pass, $database)
{
    $conn = mysqli_connect($server, $user, $pass, $database);
    if ($conn == false) {
        echo "Connection Error (" . mysqli_connect_errno() . ")" . mysqli_connect_error();
        return false;
    }
    if (! mysqli_set_charset($conn, "utf8")) {
        echo "Error loading set utf8:" . mysqli_error($conn);
        mysqli_close($conn);
        return false;
    }

    return $conn;
}

function verificaStatoPosti($conn, $table, $posto)
{
    $ret = 0;
    $res = mysqli_query($conn, "SELECT * FROM $table WHERE posto='$posto'");
    if ($res == false) {
        $ret = 0;
    } else {
        $row = mysqli_fetch_array($res, MYSQLI_BOTH);
        if ($row['posto'] == $posto) {
            $ret = $row['stato'];
        } else {
            $ret = 0;
        }
    }
    return $ret;
}

function verificaStatoPostiLoggato($conn, $table, $posto)
{
    $ret = 0;
    $res = mysqli_query($conn, "SELECT * FROM $table WHERE posto='$posto'");
    if ($res == false) {
        $ret = 0;
    } else {
        $row = mysqli_fetch_array($res, MYSQLI_BOTH);
        if ($row['posto'] == $posto) {
            if ($row['utente'] == $_SESSION['user259536'] && $row['stato'] == 1) {
                $ret = 3;
            } else {
                $ret = $row['stato'];
            }
        } else {
            $ret = 0;
        }
    }
    return $ret;
}

function verificaCampiIscrizione()
{
    $ret = true;
    if (empty($_POST['email'])) {
        echo "<script>Compila il campo username!</p>";
        $ret = false;
    }
    if (empty($_POST['password'])) {
        echo "<p>Compila il campo password!</p>";
        $ret = false;
    }
    if (empty($_POST['conf_password'])) {
        echo "<p>Compila il campo di conferma password!</p>";
        $ret = false;
    }
    if ($_POST['conf_password'] !== $_POST['password']) {
        echo "<p> Le due password devono coincidere!</p>";
        $ret = false;
    }
    return $ret;
}

function verificaCampiAccesso()
{
    $ret = true;
    if (empty($_POST['email'])) {
        $ret = false;
    }
    if (empty($_POST['email'])) {
        $ret = false;
    }
    return $ret;
}

function verificaUsername($conn, $table, $username)
{
    $ret = false;
    $res = mysqli_query($conn, "SELECT * FROM $table WHERE email='$username'");
    if (! $res)
        echo "<p>Errore durante la ricerca dell'username!</p>";
    else {
        $row = mysqli_fetch_array($res);
        if (empty($row['EMAIL']))
            $ret = true;
    }
    mysqli_free_result($res);
    return $ret;
}

function verificaAccesso($conn, $table, $username, $password)
{
    $ret = true;
    $res = mysqli_query($conn, "SELECT * FROM $table WHERE email='$username' AND password='$password'");
    if ($res == false) {
        echo "Errore nella ricerca dell'utente!";
        $ret = false;
    } else {
        $row = mysqli_fetch_array($res, MYSQLI_BOTH);
        if (($row['EMAIL']) == $username && ($row['PASSWORD']) == $password)
            $ret = true;
        else
            $ret = false;
    }
    return $ret;
}

function sanitizeString($conn, $var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    $var = mysqli_real_escape_string($conn, $var);
    return $var;
}

?>
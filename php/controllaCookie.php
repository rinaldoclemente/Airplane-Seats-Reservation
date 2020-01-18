<?php
function toHttps(){
	if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
		$location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $location);
		exit;
	}
}

if (! isset($_SERVER["HTTP_COOKIE"])) { // Se ho almeno un cookie salta l'if
    if (isset($_GET["ExistCookie"])) // Se ho un get ma non ho cookie, allora sono disabilitati
        die("<p style='color:red'> Il tuo browser <strong>non ha i cookie abilitati</strong>!<br>
				<strong>Senza cookie non puoi navigare sul sito!</strong>.<br>
				<a href='https://www.rivaluta.it/help/help_cookie.htm'>Qui</a> ci sono istruzioni su come abilitare i cookie sui browser più famosi.</p>
				<p>Dopo averli abilitati ricaricare la pagina!</p>");
    else { // Viene eseguito dopo il logout e alla prima visita sulla pagina
        if (isset($_GET["msg"]))
            header("Location:http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . "&ExistCookie=TestValue");
        else
            header("Location:http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . "?ExistCookie=TestValue");
        exit();
    }
}
?>
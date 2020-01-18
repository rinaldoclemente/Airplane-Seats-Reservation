<?php
require_once 'php/sessione.php';
require_once 'php/controllaCookie.php';
toHttps();
require_once 'php/funzioni.php';

if(isset($_GET['msg'])== "SessioneScaduta"){
  echo '<script type="text/javascript">window.alert("Tempo di inattività maggiore di due minuti, sei stato disconnesso!");</script>';
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8" />
<title>RC Iscriviti</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="library/css/bootstrap.css">

<link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />

</head>
<body>
	<noscript class="text-center">
		<p style="color: red">
			Il tuo browser <strong>non supporta Javascript</strong> e alcune
			funzionalità non sono supportate!<br> Per una migliore esperienza,
			<a href="http://www.enable-javascript.com/" target="_blank">qui </a>
			troverai alcune istruzioni su come abilitare JavaScript.
		</p>
	</noscript>

	<!-- Navbar content -->
	<nav class="navbar navbar-default">
		<div class="container-fluid">
						<?php if($loggedIn): ?>
						<script type="text/javascript">
								window.alert("Hai già effettuato l'accesso! Esci per creare un nuovo account!");
								location.href = "area.php";
						</script>
						<?php else: ?>
						<div class="row">
				<div class="col-md-12" style="margin: 0 auto;">
					<form role="form" method="POST" id="UserData"
						action="php/iscrizione.php">
						<h3 class="text-center">Iscriviti</h3>

						<div class="line"></div>

						<div class="form-group col-md-12">
							<label>Email</label> <input type="email" class="form-control"
								id="Username" name="email"
								placeholder="Inserisci una mail valida">
						</div>

						<div class="form-group col-md-6"
							oninput="return verificaPassword()">
							<label>Password</label> <input type="password"
								class="form-control" id="PassIscriviti" name="password"
								placeholder="Inserisci la password">
						</div>

						<div class="form-group col-md-6"
							oninput="return verificaPassword()">
							<label>Ripeti Password</label> <input type="password"
								class="form-control" name="conf_password" id="RipetiPassword"
								placeholder="Ripeti la password">
						</div>

						<div class="form-group col-md-12">
							<p>
								<strong>NOTA:</strong> La password deve contenere almeno un
								carattere alfabetico minuscolo, ed almeno un altro carattere che
								sia alfabetico maiuscolo oppure un carattere numerico
							</p>
						</div>

						<div class="form-group col-md-12">
							<p id="testoPsw" style="visibility: hidden;"></p>
						</div>

						<div class="form-group">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary"
									onclick="return verificaIscrizioneJS()">Iscriviti</button>
								<button type="reset" class="btn btn-primary"
									onclick="resetForm()">Reset</button>
								<a href="accedi.php">Hai già un account?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php endif ?>
		</div>

	</nav>

	<script src="js/verifiche.js"></script>
	<script type="text/javascript">

      		function resetForm() {
      			document.getElementById('UserData').reset();
				document.getElementById("testoPsw").innerHTML = "";
      		}

      </script>

</body>
</html>

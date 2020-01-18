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
<title>RC Accedi</title>
<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="library/css/bootstrap.css">

<link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />

</head>
<body>

	<noscript class="text-center">
		<p style="color: red">
			Il tuo browser <strong>non supporta Javascript</strong> e alcune
			funzionalità non sono supportate!<br> Per una migliore esperienza, <a
				href="http://www.enable-javascript.com/" target="_blank">qui </a>
			troverai alcune istruzioni su come abilitare JavaScript.
		</p>
	</noscript>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
          <?php if($loggedIn): ?>
          <script type="text/javascript">
              window.alert("Hai già effettuato l'accesso!");
              location.href = "area.php";
          </script>
          <?php else: ?>
						<div class="row">
				<div class="col-md-12" style="margin: 0 auto;">
					<form role="form" method="POST" id="UserData"
						action="php/accesso.php">
						<h3 class="text-center">Accedi</h3>

						<div class="line"></div>

						<div class="form-group col-md-12">
							<label>Email</label> <input type="email" class="form-control"
								id="Username" name="email" placeholder="Inserisci la tua mail">
						</div>
						<div class="form-group col-md-12"
							oninput="return verificaPassword()">
							<label>Password</label> <input type="password"
								class="form-control" id="PassAccedi" name="password"
								placeholder="Inserisci la password">
						</div>
						<div class="form-group col-md-12">
							<p id="testoPsw" style="visibility: hidden;"></p>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary"
									onclick="return verificaAccessoJS()">Accedi</button>
								<a href="iscriviti.php">Iscriviti</a>
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

        </script>
</body>
</html>

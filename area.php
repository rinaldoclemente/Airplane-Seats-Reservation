<?php
require_once 'php/sessione.php';
require_once 'php/controllaCookie.php';
toHttps();
require_once 'php/funzioni.php';

if(isset($_GET['msg'])== "SessioneScaduta"){
  echo '<script type="text/javascript">window.alert("Tempo di inattività maggiore di due minuti, sei stato disconnesso!");</script>';
}
if (!$loggedIn)
    echo '<script type="text/javascript">window.alert("Non sei loggato o è scaduta la sessione!");window.location.href = "accedi.php";</script>';
?>

<!DOCTYPE html>

<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>RC MyArea</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="library/css/bootstrap.css">
<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="css/styleMyArea.css">

<link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />

        <?php
        $colConCorridoio = $col + 1;
        // 65 perchè parte da A (codice ASCII)
        if ($col & 1) { // dispari
            $asciiColSx = 65 + ($col / 2);
            $asciiColDx = $asciiColSx + ($col / 2);
        } else { // pari
            $asciiColSx = 65 + ($col / 2) - 1;
            $asciiColDx = $asciiColSx + ($col / 2);
        }

        echo '<style>
        @media screen and (max-width: 480px) {
          .container-grid{
              display: grid;
              grid-template-columns: repeat(' . $colConCorridoio . ',5px);
              grid-template-rows: repeat(' . $righe . ', 30px);
              position:relative;
              grid-gap:24px;
          }
          .container-grid div{
            padding: 2px;
            text-align: center;
            border-radius: 1px;
            border: 1px solid #171717;
            width: 26px;
            height: 20px;
            text-decoration: none;
            font-size: 10px;
          }
          .container-grid input{
            margin-top: -3px;
            margin-left: -5px;
            background-color: transparent;
            border: none;
            width: 28px;
            height: 20px;
          }
        }

        @media screen and (min-width: 480px) {
          .container-grid{
            display: grid;
            grid-template-columns: repeat(' . $colConCorridoio . ',5px);
            grid-template-rows: repeat(' . $righe . ', 30px);
            position:relative;
            grid-gap:28px;
          }
          .container-grid div{
            padding: 2px;
            text-align: center;
            border-radius: 1px;
            border: 1px solid #171717;
            width: 28px;
            height: 22px;
            font-size: 12px;
          }
          .container-grid input{
            margin-top: -3px;
            margin-left: -5px;
            background-color: transparent;
            border: none;
            width: 30px;
            height: 22px;
          }
        }

        @media screen and (min-width: 720px) {
          .container-grid{
            display: grid;
            grid-template-columns: repeat(' . $colConCorridoio . ',5px);
            grid-template-rows: repeat(' . $righe . ', 30px);
            position:relative;
            grid-gap:28px;
          }
          .container-grid div{
            text-align:center;
            border-radius: 1px;
            border: 1px solid #171717;
            width: 28px;
            height: 25px;
            font-size: 12px;
          }
          .container-grid input{
            margin-top: -4px;
            margin-left: -5px;
            background-color: transparent;
            border: none;
            width: 30px;
            height: 25px;
          }
        }

        @media screen and (min-width: 1024px) {
          .container-grid{
            display: grid;
            grid-template-columns: repeat(' . $colConCorridoio . ',5px);
            grid-template-rows: repeat(' . $righe . ', 30px);
            position:relative;
            grid-gap: 35px;
          }
          .container-grid div{
            text-align: center;
            border-radius: 1px;
            border: 1px solid #171717;
            padding: 4px;
            width: 38px;
            height: 35px;
            font-size: 16px;
          }
          .container-grid input{
            margin-top: -5px;
            margin-left: -5px;
            background-color: transparent;
            border: none;
            width: 38px;
            height: 35px;
          }
        }

        @media screen and (min-width: 1200px) {
          .container-grid{
            display: grid;
            grid-template-columns: repeat(' . $colConCorridoio . ',5px);
            grid-template-rows: repeat(' . $righe . ', 30px);
            position:relative;
            grid-gap: 40px;
          }
          .container-grid div{
            text-align: center;
            border-radius: 1px;
            border: 1px solid #171717;
            padding: 6px;
            width: 44px;
            height: 40px;
            font-size: 18px;
          }

          .container-grid input{
            margin-top: -7px;
            margin-left: -7px;
            background-color: transparent;
            border: none;
            width: 44px;
            height: 40px;
          }
        }
        </style>';
        ?>

    </head>

<body>

	<noscript class="text-center">
		<p style="color: red">
			Il tuo browser <strong>non supporta Javascript</strong> e alcune
			funzionalità non sono supportate!<br> Per una migliore esperienza,
			<a href="https://www.enable-javascript.com/it/" target="_blank">qui </a>
			troverai alcune istruzioni su come abilitare JavaScript sui browser
			più famosi.
		</p>
	</noscript>

	<div class="wrapper">

		<nav class="sidebar">

			<div class="sidebar-header">
				<h2>
					<img src="img/logo.png" alt="" height=60 width=60>RC
					Flights
				</h2>

				<div class="line_sidebar"></div>

				<ul class="list-unstyled components">
					<li><a href="index.php"> <i class="glyphicon glyphicon-plane"></i>
							Home
					</a></li>
					<li><a href="area.php"> <i class="glyphicon glyphicon-user"></i>
							MyArea
					</a></li>
					<li><a onclick="esci()"> <i class="glyphicon glyphicon-log-out"></i>
							Esci
					</a></li>
				</ul>
			</div>

			<footer class="footer_main">
				<div class="line_sidebar"></div>
				<p>&copy; 2019 Rinaldo Clemente s259536


				<p>

			</footer>
		</nav>

		<div id="content">

			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">Home</a>
					</div>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="area.php">MyArea</a></li>
						<button id="'.$posto.'" onclick="esci()"
							class="btn btn-primary navbar-btn">Esci</button>
					</ul>
				</div>
			</nav>

			<nav class="center-block">
				<div class="container-fluid" width="100%" height="100%">
					<h3 class="text-center">Mappa dei posti</h3>
					<h5 class="text-center">dell'utente: <?php echo $_SESSION['user259536']; ?></h5>
					<div class="line_center"></div>
					<p class="text-center">Per prenotare un posto clicca su di esso,
						per annullare cliccare di nuovo sullo stesso posto.</p>
					<p class="text-center">Prima di acquistare, ricordati di aggiornare
						la pagina per essere sicuri che non siano stati prenotati da altri
						utenti.</p>
					<br>

					<section class="section_grid">
						<br>
						<br>
						<div class="container-grid" width="100%" height="100%">
                        <?php
                        $numAcq = 0;
                        $numDisp = 0;
                        $numPren = 0;
                        $numPrenUtente = 0;
                        $conn = connessioneDB($db_host, $db_user, $db_pass, $db_name);
                        if ($conn != false) {
                            for ($x = 1; $x <= $righe; $x ++) {
                                for ($y = 65; $y <= $asciiColSx; $y ++) {
                                    $posto = chr($y).$x;
                                    $stato = verificaStatoPostiLoggato($conn, "statoposti", $posto);
                                    switch ($stato) {
                                        case 3: // prenotato dall'utente in sessione
                                            echo '<div id="' . $posto . '" class="item_grid_yellow"><input type="submit" name="posto" value="' . $posto . '" onclick="verificaPrenotazioneJS(\'' . $posto . '\')"></input></div>';
                                            $numPrenUtente ++;
                                            break;
                                        case 2: // acquistato
                                            echo '<div id="' . $posto . '" class="item_grid_red"><input type="submit" name="posto" value="' . $posto . '" onclick="verificaPrenotazioneJS(\'' . $posto . '\')"></input></div>';
                                            $numAcq ++;
                                            break;
                                        case 1: // prenotato
                                            echo '<div id="' . $posto . '" class="item_grid_orange"><input type="submit" name="posto" value="' . $posto . '" onclick="verificaPrenotazioneJS(\'' . $posto . '\')"></input></div>';
                                            $numPren ++;
                                            break;
                                        default: // disponibile
                                            echo '<div id="' . $posto . '" class="item_grid_green"><input type="submit" name="posto" value="' . $posto . '" onclick="verificaPrenotazioneJS(\'' . $posto . '\')"></input></div>';
                                            $numDisp ++;
                                            break;
                                    }
                                }
                                echo '<div class="invisible"></div>'; // corridoio

                                for ($y = $asciiColSx + 1; $y <= $asciiColDx; $y ++) {
                                    $posto = chr($y).$x;
                                    $stato = verificaStatoPostiLoggato($conn, "statoposti", $posto);

                                    switch ($stato) {
                                        case 3: // prenotato dall'utente in sessione
                                            echo '<div id="' . $posto . '" class="item_grid_yellow"><input type="submit" name="posto" value="' . $posto . '" onclick="verificaPrenotazioneJS(\'' . $posto . '\')"></input></div>';
                                            $numPrenUtente ++;
                                            break;
                                        case 2: // acquistato
                                            echo '<div id="' . $posto . '" class="item_grid_red"><input type="submit" name="posto" value="' . $posto . '" onclick="verificaPrenotazioneJS(\'' . $posto . '\')"></input></div>';
                                            $numAcq ++;
                                            break;
                                        case 1: // prenotato
                                            echo '<div id="' . $posto . '" class="item_grid_orange"><input type="submit" name="posto" value="' . $posto . '" onclick="verificaPrenotazioneJS(\'' . $posto . '\')"></input></div>';
                                            $numPren ++;
                                            break;
                                        default: // disponibile
                                            echo '<div id="' . $posto . '" class="item_grid_green"><input type="submit" name="posto" value="' . $posto . '" onclick="verificaPrenotazioneJS(\'' . $posto . '\')"></input></div>';
                                            $numDisp ++;
                                            break;
                                    }
                                }
                            }
                            mysqli_close($conn);
                        }
                        ?>

                      </div>

                      <?php
                    if ((isset($_GET["msg"])) && ($_GET["msg"] == "SessioneScaduta")) {
                        echo '<script type="text/javascript">window.alert("Tempo di inattività maggiore di due minuti, per favore effettua di nuovo il login!");</script>';
                    }
                    ?>
                    </section>

					<br><br>
					<button id="Acquista" onclick="verificaNumeroPostiGialli()"
						class="btn btn-secondary">Acquista</button>
					<br>
          <button id="Aggiorna" onclick="aggiorna()"
						class="btn btn-secondary">Aggiorna</button>
					<div class="line_center"></div>
					<div class="text-center">
            <p>Totale posti: <?php echo $righe*$col; ?></p>
						<p id="nPostiPrenUser">Posti prenotati da te: <?php echo $numPrenUtente; ?></p>
						<p id="nPostiDisponibili">Posti disponibili: <?php echo $numDisp; ?></p>
						<p id="nPostiPrenAltri">Posti prenotati da altri: <?php echo $numPren; ?></p>
						<p id="nPostiAcquistati">Posti acquistati: <?php echo $numAcq; ?></p>
					</div>
          <br><br>

				</div>
			</nav>
		</div>
	</div>

	<script src="library/jquery-3.4.1.min.js"></script>
	<script src="js/verifiche.js"></script>
	<script type="text/javascript">

          function esci() {
              if(confirm("Sei sicuro di voler uscire?")) {
                  location.href="php/esci.php";
              }
          }
      </script>
</body>

</html>

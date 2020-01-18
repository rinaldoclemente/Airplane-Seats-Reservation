<?php
require_once 'php/sessione.php';
require_once 'php/controllaCookie.php';
require_once 'php/funzioni.php';

if(isset($_GET['msg'])== "SessioneScaduta"){
  echo '<script type="text/javascript">window.alert("Tempo di inattività maggiore di due minuti, sei stato disconnesso!");</script>';
}
?>
<!DOCTYPE html>

<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>RC Flights</title>

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="library/css/bootstrap.css">
<!-- Custom CSS -->
<link rel="stylesheet" type="text/css" href="css/styleIndex.css">

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

        echo
		'<style>
        @media screen and (max-width: 480px) {
          .container-grid{
              display: grid;
              grid-template-columns: repeat(' . $colConCorridoio . ',5px);
              grid-template-rows: repeat(' . $righe . ', 30px);
              position:relative;
              grid-gap:20px;
          }
          .container-grid div{
            padding: 2px;
            text-align: center;
            border-radius: 1px;
            border: 1px solid #171717;
            width: 22px;
            height: 20px;
            text-decoration: none;
            font-size: 10px;
          }
        }

        @media screen and (min-width: 480px) {
          .container-grid{
              display: grid;
              grid-template-columns: repeat(' . $colConCorridoio . ',5px);
              grid-template-rows: repeat(' . $righe . ', 30px);
              position:relative;
              grid-gap:20px;
          }
          .container-grid div{
            padding: 2px;
            text-align: center;
            border-radius: 1px;
            border: 1px solid #171717;
            width: 22px;
            height: 20px;
            text-decoration: none;
            font-size: 10px;
          }
        }

        @media screen and (min-width: 720px) {
          .container-grid{
              display: grid;
              grid-template-columns: repeat(' . $colConCorridoio . ',5px);
              grid-template-rows: repeat(' . $righe . ', 30px);
              position:relative;
              grid-gap:25px;
          }
          .container-grid div{
            text-align:center;
            border-radius: 1px;
            border: 1px solid #171717;
            width: 28px;
            height: 25px;
            text-decoration: none;
            font-size: 14px;
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
            text-decoration: none;
            font-size: 16px;
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
            text-decoration: none;
            font-size: 16px;
          }
        }
        </style>';
        ?>

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

	<div class="wrapper">

		<nav class="sidebar">

			<div class="sidebar-header">
				<h2>
					<img src="img/logo.png" alt="" height=60 width=60>RC Flights
				</h2>

				<div class="line_sidebar"></div>

				<ul class="list-unstyled components">
					<li><a href="index.php"> <i class="glyphicon glyphicon-plane"></i>
							Home
					</a></li>
                    <?php if(!$loggedIn): ?>
                      <li><a href="accedi.php"> <i
							class="glyphicon glyphicon-log-in"></i> Accedi
					</a></li>
					<li><a href="iscriviti.php"> <i class="glyphicon glyphicon-pencil"></i>
							Iscriviti
					</a></li>

                    <?php else: ?>
                      <li><a href="area.php"> <i
							class="glyphicon glyphicon-user"></i> MyArea
					</a></li>
					<li><a onclick="esci()"> <i class="glyphicon glyphicon-log-out"></i>
							Esci
					</a></li>
				</ul>

                <?php endif?>

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

                              <?php if(!$loggedIn): ?>
                              <li><a href="iscriviti.php">Iscriviti</a>
						</li>

						<button href="accedi.php" class="btn btn-primary navbar-btn">Accedi</button>
                              <?php else: ?>
                                <li><a href="area.php">MyArea</a></li>
						<button onclick="esci()" class="btn btn-primary navbar-btn">Esci</button>
                              <?php endif?>
                          </ul>
				</div>
			</nav>

			<div class="cental-block">
				<!-- Bootstrap -->
				<div class="container-fluid" width="100%" height="100%">
					<h2 class="text-center">Mappa dei posti</h2>
					<div class="line_center"></div>
					<p class="text-center">Qui puoi controllare lo stato attuale dei
						posti. Per prenotare un posto è
             obbligatorio entrare in MyArea
						dopo aver effettuato l'accesso al proprio account.</p>
					<br></br>

					<form role="form" method="POST" class="section_grid"
						action="php/prenotazione.php">
						<div class="container-grid" width="100%" height="100%">
                              <?php
                            $numAcq = 0;
                            $numDisp = 0;
                            $numPren = 0;
                            $conn = connessioneDB($db_host, $db_user, $db_pass, $db_name);
                            if ($conn != false) {
                                for ($x = 1; $x <= $righe; $x ++) {
                                    for ($y = 65; $y <= $asciiColSx; $y ++) {
                                        $posto = chr($y).$x;

                                        $stato = verificaStatoPosti($conn, "statoposti",$posto);
                                        switch ($stato) {
                                            case 2: // acquistato
                                                echo '<div class="item_grid_red"><p>' .$posto . '</p></div>';
                                                $numAcq ++;
                                                break;
                                            case 1: // prenotato
                                                echo '<div class="item_grid_orange"><p>' .$posto . '</p></div>';
                                                $numPren ++;
                                                break;
                                            default: // disponibile
                                                echo '<div class="item_grid_green"><p>' .$posto . '</p></div>';
                                                $numDisp ++;
                                                break;
                                        }
                                    }
                                    echo '<div class="invisible"></div>'; // corridoio

                                    for ($y = $asciiColSx + 1; $y <= $asciiColDx; $y ++) {
                                      $posto = chr($y).$x;
                                        $stato = verificaStatoPosti($conn, "statoposti",$posto);
                                        switch ($stato) {
                                            case 2: // acquistato
                                                echo '<div class="item_grid_red"><p>' .$posto . '</p></div>';
                                                $numAcq ++;
                                                break;
                                            case 1: // prenotato
                                                echo '<div class="item_grid_orange"><p>' .$posto . '</p></div>';
                                                $numPren ++;
                                                break;
                                            default: // disponibile
                                                echo '<div class="item_grid_green"><p>' .$posto . '</p></div>';
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
                        </form>
					<div class="line_center"></div>
          <p class="text-center">Totale posti : <?php echo $righe*$col; ?></p>
					<p class="text-center">Posti disponibili : <?php echo $numDisp; ?></p>
					<p class="text-center">Posti prenotati : <?php echo $numPren; ?></p>
					<p class="text-center">Posti acquistati : <?php echo $numAcq; ?></p>
          <br><br>
				</div>
			</div>
		</div>
	</div>

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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  

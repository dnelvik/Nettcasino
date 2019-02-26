<!DOCTYPE html>
<html lang="no">
<head>
	<title>Highscore</title>
	<meta charset = "UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/highscore.css">
	<link href="https://fonts.googleapis.com/css?family=Ultra" rel="stylesheet">
	<?php include("header.php"); ?>
</head>
<body style="background: black">
	<div id="container">
		<div id="indreboks">
			<?php // Lager en spørring
			$spillQuery= "SELECT DISTINCT spillnavn FROM highscore";
			$resultatSpill = mysqli_query($db, $spillQuery);
			?>
			<div class="select-field">
				<select onchange="refresh(this.value)">
					<option selected hidden>Velg Spill …</option>
					<?php
					//Henter alle spillene som er registrert i databasen og legger dem inn som en option i select-tagen
					while ($rad1 = mysqli_fetch_array($resultatSpill)) {
						echo"<option value=".'"'.$rad1['spillnavn'].'"'.">".$rad1['spillnavn']."</option>";
					}
					?>
				</select>
			</div>
			<table id="tabell">
			</table>
		</div>
	</div>
	<script>
		window.onload = function() {
			refresh("Jackpot");
		}
		//Oppdaterer tabellen med valgt spill
		function refresh(spillnavn){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					document.getElementById("tabell").innerHTML = this.responseText;
				}
			}
			xmlhttp.open("POST", "hentHighscore.php?spill="+spillnavn, true);
			xmlhttp.send();
		}
	</script>
</body>
<?php
include("footer.php")
?>
</html>

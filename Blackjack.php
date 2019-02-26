<!--HTML dokument for blackjack siden -->
<!DOCTYPE html>
<html lang="no">
<head>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/bj.css">
	<title>Blackjack</title>
	<meta charset="UTF-8" />

</head>
<body>
<?php include('header.php'); ?>
<?php 	if (!isset($_SESSION['brukernavn'])) {
	echo "<script language='javascript'>window.location.href='index.php?logginn=1';</script>";
	}
?>
	
	<div id="spill">
		<!-- Dealerens kort og data -->
		<section id="section-a">
			<div id="dealerdata"></div>
		</section>
		<!-- Loggen i spillet -->
		<section id="section-b">
			<div id="tekst"></div>
		</section>
		<!-- Spillerens kort og data -->
		<section id="section-c">
			<div id="utdata"></div>
		</section>
		<!-- Tekstboks for å vise saldo -->
		<section id="section-d">
			<div id="sum"></div>
		</section>
		<!-- Her er knappene som brukes i spillet -->
		<section id="section-e">
			<button type="button" class="button" onclick="startSpill()">Nytt spill</button>
			<input type="image" id="start" onclick="flip()" src="bilder/start.png" height="60" alt=" Start Knapp">
			<input type="image" id="hit" onclick="hit()" src="bilder/hit.png" height="60" alt="Start Knapp">
			<input type="image" id="stand" onclick="stand()" src="bilder/stand.png" height="60" alt="Start Knapp">
			<input type="image" id="bet5" onclick="bet5()" src="bilder/bet5.png" height="60" alt="Start Knapp">
			<input type="image" id="bet25" onclick="bet25()" src="bilder/bet25.png" height="60" alt="Start Knapp">
			<input type="image" id="bet100" onclick="bet100()" src="bilder/bet100.png" height="60" alt="Start Knapp">
			<input type="image" id="doubledown" onclick="doubleDown()" src="bilder/doubledown.png" height="60" alt="Start Knapp">

		</section>


		<section id="section-f">
			<div>
				<a onclick="byttBilde()" style="cursor: pointer" id="togglebgm"><img id="lydbilde" src="bilder/play.png" alt="Lyd knapp"></a>
				<audio id="audio_bgm" autoplay="autoplay">
				<source src="musikk/blackjack.mp3" />
				</audio>
			</div>
		</section>



	</div>
<!-- Bytter ikon når man trykker på lydikon for å mute -->
	<script>
		var on = false;
		function byttBilde(){
			var bilde = document.getElementById('lydbilde');

			if (on == true) {
				bilde.src ="bilder/play.png";
				on = false;
			}else{
				bilde.src = "bilder/mute.png";
				on = true;
			}
		}

		var audio = document.getElementById('audio_bgm');
		document.getElementById('togglebgm').addEventListener('click', function (e){
			e = e || window.event;
			audio.muted = !audio.muted;
			e.preventDefault();
		}, false);
	</script>
	<?php
	include("footer.php")
	?>
</body>

<script src="kortstokk.js"></script>
<script type="text/javascript">
	var penger = <?php echo $_SESSION['penger'];?>;
</script>
</html>

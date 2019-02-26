<!DOCTYPE html>
<html>
<head>
	<title>Spilleautomat</title>
	<meta charset = "UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/spilleautomat.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Ultra" rel="stylesheet">
</head>
<body>
<?php	include("header.php"); ?>
<?php 	if (!isset($_SESSION['brukernavn'])) {
	echo "<script language='javascript'>window.location.href='index.php?logginn=1';</script>";
	}
?>
	<div id="container">
		<div id ="indreboks">
			<!-- Legger til musikk og en knapp med mute-funksjon -->
			<a onclick="byttBilde()" style="cursor: pointer" id="togglebgm"><img id="lydbilde" src="bilder/play.png" height="20px"></a>
			<audio id="audio_bgm" autoplay="autoplay">
				<source src="musikk/jackpot.mp3" />
			</audio>
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
			<header><h1>Jackpot</h1></header>

			<canvas width ="1200" height="430"></canvas>

			<div id="knapper">
				<div id="rad1">
					<label><input type="radio" name="toggle" value="5" checked="checked"><span>$5</span></label>
					<label><input type="radio" name="toggle" value="10"><span>$10</span></label>
					<label><input type="radio" name="toggle" value="20"><span>$20</span></label>
					<label><input type="radio" name="toggle" value="50"><span>$50</span></label>
					<label><input type="radio" name="toggle" value="100"><span>$100</span></label>
				</div>
				<div id="knapp">
					<button type="button"  onclick="spill()"><span>Spin</span></button>
				</div>
				<div id="gevinst">Gevinst: <input class="tfield" type="text" name="gevinst" id="gfelt" readonly></div>
				<div id="saldo">Saldo: <input class="tfield" type="text" name="saldo" value="<?php echo $_SESSION['penger']?>" id="sfelt" readonly></div>
			</div>
			<div id="gevinstliste">
				<h2>Gevinster:</h2>
				<li><img src="bilder/3firkløver.png" width="60"> x 3</li>
				<li><img src="bilder/3hestesko.png" width="60"> x 6</li>
				<li><img src="bilder/3ess.png" width="60"> x 12</li>
				<li><img src="bilder/3chip.png" width="60"> x 24</li>
				<li><img src="bilder/3mynter.png" width="60"> x 48</li>
				<li><img src="bilder/3pengesekk.png" width="60"> x 96</li>
				<li><img src="bilder/3diamant.png" width="60"> x 192</li>
				<br>
				<li><img src="bilder/2firkløver.png" width="60"> x 1.5</li>
				<li><img src="bilder/2hestesko.png" width="60"> x 3</li>
				<li><img src="bilder/2ess.png" width="60"> x 6</li>
				<li><img src="bilder/2chip.png" width="60"> x 12</li>
				<li><img src="bilder/2mynter.png" width="60"> x 24</li>
				<li><img src="bilder/2pengesekk.png" width="60"> x 48</li>
				<li><img src="bilder/2diamant.png" width="60"> x 96</li>
				<br>
				<li><img src="bilder/1diamant.png" width="60"> x 2</li>
			</div>
		</div>
	</div>
	<script src="sa_js.js"></script>
</body>
<?php
include("footer.php")
?>
</html>

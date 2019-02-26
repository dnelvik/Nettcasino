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
	<?php
	if (!isset($_SESSION['brukernavn'])) {
		header('location: index.php?logginn=1');
		exit;
	}
	?>
	<div id="container">
		<div id ="indreboks">
			<header><h1>Coinflip</h1></header>

			<img id="kastet" style="border: 1px solid black" src="bilder/velg.jpg" width="400" height="300">

			<div id="knapper">
				<div id="rad1">
					<label><input type="radio" onclick="visValg('h')" id="kron" name="toggle" value="kron"><span>Kron</span></label>
					<label><input type="radio" onclick="visValg('t')" id="mynt" name="toggle" value="mynt"><span>Mynt</span></label>
					<span style="margin-left: 50px;">Du har valgt: </span><i id="valg"></i>
				</div>
				<div id="knapp">
					<button type="button" onclick="kastMynt()"><span>Kast mynt</span></button>
				</div>
				<div id="gevinst">Innsats: <input class="tfield" type="number" name="gevinst" id="gfelt" required></div>
				<div id="saldo">Saldo: <input class="tfield" id="sfelt" type="text" name="saldo" value="<?php echo $_SESSION['penger']?>" id="sfelt" readonly></div>
			</div>
			<div id="gevinstliste">
				<h2>Regler:</h2>
				<li>Spilleren velger enten Kron eller Mynt og hvor mye som skal bli sattset. <br>Når man kaster mynten vill den lande på enten Kron eller mynt.</li><br><li>Hvis du har valgt riktig vinner du innsattsen din!</li>
				<br>
				<div style="max-height: 100px; color: black; overflow-y: scroll;" id="consol"></div>
			</div>
		</div>
	</div>
	<script>
		function visValg(valg) {
			if (valg == 'h')
				document.getElementById('valg').innerHTML = 'Kron';
			else
				document.getElementById('valg').innerHTML = 'Mynt';
		}
		//Når spiller trykker kast mynt
		function kastMynt() {
			var innsats = document.getElementById('gfelt').value;
			var saldo = document.getElementById('sfelt').value;
			var valg = null;
			var rnd;
			var siste;
			var consol = document.getElementById('consol');
			var error = '';

			if (document.getElementById('kron').checked) {
				valg = 'kron';
			}else if (document.getElementById('mynt').checked) {
				valg = 'mynt';
			}
			if(saldo-innsats < 0){
				error += 'Du har for lite penger!<br>'
			}
			if (valg == null) {
				error += 'Du må velge kron eller mynt!<br>';
			}
			if(innsats <= 0){
				error += 'Du må velge en sum større enn 0!<br>';
			}
			if(innsats == null){
				error += 'Du må velge en sum å satse!<br>';
			}

			if (error != ''){
				consol.innerHTML += "<font color='red'>" + error + "</font>";
				scrollTilBunn('consol');
				return;
			}
			//Alt har gått fint:
			animasjon();
		}
		//Animerer myntkastet
		function animasjon(){
			var teller = 0;
			var id = setInterval(function(){
				rnd = Math.random() >= 0.5;
				if(rnd){
					document.getElementById('kastet').src = 'bilder/heads.jpg';
					siste = "kron";
				}else{
					document.getElementById('kastet').src = 'bilder/tails.jpg';
					siste = "mynt";
				}
				teller++;
				if(teller> 10){
					clearInterval(id);
					resultat();
				}
			}, 100)
		}
		//Finner ut resultatet
		function resultat(){
			if (document.getElementById('kron').checked) {
				valg = 'kron';
			}else if (document.getElementById('mynt').checked) {
				valg = 'mynt';
			}
			innsats = document.getElementById('gfelt').value;
			tid = new Date().toLocaleTimeString();
			if (valg == siste) {
				consol.innerHTML += "<li>" + tid + " <font color='green'>Du vant $" + innsats + "!</font></li>";
				oppdaterSaldo(innsats);
			}else{
				consol.innerHTML += "<li>" + tid + " <font color='red'>Du tapte $" + innsats + "..</font></li>";
				oppdaterSaldo(-innsats);
			}
			//Skroll consol til bunnen.
			scrollTilBunn('consol');
		}
		// For å oppdatere database ved hjelp av ajax
		function oppdaterSaldo(sum){
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if(this.readyState == 4 && this.status == 200) {
					document.getElementById("sfelt").value = this.responseText;
					document.getElementById("saldo-header").innerHTML = "$"+this.responseText;
				}
			}
			xmlhttp.open("POST", "s_a_server.php?sum="+sum+"&spill=Coinflip", true);
			xmlhttp.send();
		}

		function scrollTilBunn(id){
			var element = document.getElementById(id);
			element.scrollTop = element.scrollHeight - element.clientHeight;
		}
	</script>
</body>
<?php
include("footer.php")
?>
</html>

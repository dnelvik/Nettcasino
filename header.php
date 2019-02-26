<?php include('server.php');
//Alle sider implementerer header.php derfor får de også server.php med på kjøpet. ?>
<div class="top-sticky-bar">
	<div class="logo"><a href="index.php" title="Tilbake til forsiden"><img id="logo" src="bilder/bygdacasino.png" alt="Tilbake til forsiden"></a></div>
	<div id="nav-bar">
		<!--Navigasjons knapper i header.-->
		<button class="nav-btn" onclick="window.location.href='spill.php'">Spill</button>
		<?php  if (isset($_SESSION['brukernavn'])) : ?>
			<button class="nav-btn" onclick="window.location.href='highscore.php'">Highscore</button>
			<button class="nav-btn" onclick="window.location.href='profil.php'">Min profil</button>
			<button class="nav-btn" onclick="window.location.href='server.php?loggut=1'">Logg ut</button>
		<?php endif ?>
		<?php  if (!isset($_SESSION['brukernavn'])) : ?>
			<button class="nav-btn" onclick="window.location.href='highscore.php'">Highscore</button>
			<button class="nav-btn" onclick="window.location.href='register.php'">Registrer</button>
			<button class="nav-btn" onclick="document.getElementById('id01').style.display='block',slettError()">Logg inn</button>
		<?php endif ?>
	</div>
	<div class="saldo-bruker">
		<!--Viser bruker som er logget på og pengene hans-->
		<?php if (isset($_SESSION['brukernavn'])): ?>
			<span id="saldo-row1"><?php echo $_SESSION['brukernavn']; ?></span><br>	
			<a id="saldo-header" title="Sett inn penger" href="profil.php?arg=pengerinn">$<?php echo $_SESSION['penger'] ?></a>
		<?php endif ?>
	</div>
	<div class="nav-søk">
		<!--Søke felt som gir automatiske svar man som linker vidre til spill-->
		<!--Den har også et 'Enter'-søk som gir et fult søk på-->
		<div id="sok-header">
			<!-- <input style="background:white; width:25px;" type="image" src="bilder/searchicon.png" onclick="sok()" name="søkefelt"> -->
			<input type="text" id="sokefelt" placeholder="Søk på spill.." onblur="endDiv()" onkeyup="search(this.value)" onfocus="search(this.value)" id="text" >
			<div id="search">
			</div>
		</div>
	</div>
</div>

<?php  if (!isset($_SESSION['brukernavn'])) : ?>
	<!-- Gardin for logginn -->
	<div id="id01" class="gardin">
		<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close gardin">&times;</span>


		<!-- Innhold til gardinen -->
		<form class="gardin-content animate" method="post">
			<div class="imgcontainer">
				<div class="content-main">

					<h1>LOGG INN</h1>
					<?php include('errors.php'); ?>
					<div class="form-container"><input type="text"  class="form-design" name="brukernavn" placeholder="Brukernavn..."></div>
					<div class="form-container"><input type="password" class="form-design" name="passord" placeholder="Passord..."></div>
					<div class="form-container"><button type="submit" class="btn-form" name="login_bruker">Logg inn</button></div>

					<p>
						Ikke medlem? <a href="register.php">Registrer her</a>
					</p>
				</form>
			</div>

		</div>

	</form>
</div>
<?php endif ?>

<script>
// henter gardin
var gardin = document.getElementById('id01');

function slettError(){
	elem = document.getElementById('error')
	elem.parentNode.removeChild(elem);
}
// Når bruker trykker på utsiden av gardinen, forsvinner den.
window.onclick = function(event) {
	if (event.target == gardin) {
		gardin.style.display = "none";
	}

}

//Funksjon for å fjerne diven'e som blir laget av søkefelt.
function endDiv(){
	setTimeout(function () {
		var elem;
		while(elem = document.getElementById('searchtitle')){
			elem.parentNode.removeChild(elem);
		}
	}, 250);

}

//Funksjon for fult søk.(enter-søk)
function sok(){
	var sok = document.getElementById('sokefelt').value;

	var element = document.getElementById("search");
	var numberOfChildren = element.getElementsByTagName('div').length

	if (sok == "") {
		window.location.href="spill.php";
	}else if(numberOfChildren == 1){
		link = element.getElementsByTagName('a');
		window.location.href=link[0].href;

	}else{
		window.location.href="spill.php?sok=" + sok;
	}
}

//Legger til en lytter på søkefelt og sjekker etter 'enter'-tast
document.getElementById("sokefelt")
.addEventListener("keyup", function(event) {
	event.preventDefault();
	if (event.keyCode === 13) {
		sok();
	}
});

//sanntids-søk med støtte for eldre nettlesere.
function search(string){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}else{
		xmlhttp = new ActiveXObject("XMLHTTP");
	}
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById("search").innerHTML = xmlhttp.responseText;
		}
	}
	xmlhttp.open("GET", "server.php?s="+string, true);
	xmlhttp.send(null);
}

</script>



<!-- viser feilmeldinger om man ikke får logget inn
	(feil brukernavn eller passord osv.) -->
<?php if(isset($_POST['login_bruker']) || isset($_GET['logginn']) ) : ?>
	<script>document.getElementById('id01').style.display='block'</script>
<?php endif ?>

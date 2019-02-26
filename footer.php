<!--Footer som blir implementert i alle sidene-->
<footer>
		<!--Navigasjon-->
		<div id="bottomNavBar">
			<a href="index.php">Hjem</a>
			| <a href="omoss.php">Om oss</a>
			 <?php  if (!isset($_SESSION['brukernavn'])) : ?>
			| <a href="register.php">Registrer</a>
			|<a style="cursor:pointer;" onclick="document.getElementById('id01').style.display='block',slettError()">Logg inn</a>
			<?php endif ?>
			<?php  if (isset($_SESSION['brukernavn'])) : ?>
			| <a href="profil.php">Min profil</a>
			| <a href="server.php?loggut=1">Logg ut</a>

			<?php endif ?>
		</div>
		<!--Sosiale lenker-->
		<div id="socialFooter">
			<a title="Følg oss på Facebook" href="http://facebook.com/"><img class="social" alt="Facebook" src="bilder/facebook.svg"/></a>
			<a title="Følg oss på Twitter" href="http://twitter.com/"><img class="social" alt="Twitter" src="bilder/twitter.svg"/></a>
			<a title="Følg oss på Youtube" href="http://youtube.com/"><img class="social" alt="Youtube" src="bilder/youtube.svg"/></a>
		</div>
</footer>

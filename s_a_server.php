	<?php
session_start();

// koble opp database
$db = mysqli_connect('localhost', 'root', '', 'bygdacasino'); //legger til databasen
//Henter spill
$spill = $_REQUEST["spill"];
//Henter sum (- for trekk)
$sum = $_REQUEST["sum"];
//Henter brukernavn
$brukernavn = $_SESSION['brukernavn'];
//Lager SQL-spørring
$query ="CALL opprettTransaksjon('$brukernavn', '$sum', '$spill')";
mysqli_query($db, $query);

//Sjekk ny valuta
$query = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' LIMIT 1";
$resultat = mysqli_query($db, $query);
$bruker = mysqli_fetch_assoc($resultat);
$_SESSION['penger'] = $bruker['penger'];
echo $bruker['penger'];

// Henter highscore
$query = "SELECT * FROM highscore WHERE brukernavn ='$brukernavn' AND spillnavn='$spill' LIMIT 1";
$resultat = mysqli_query($db, $query);
$bruker  = mysqli_fetch_assoc($resultat);
//Setter dato
$dato = date("Y-m-d h:i:sa");

// Sjekker om brukeren har en highscore
if(!isset($bruker['score']) && $sum > 0){
	$query = 	"INSERT INTO highscore (brukernavn, spillnavn, score, dato)
				VALUES('$brukernavn', '$spill', '$sum', '$dato')";
	mysqli_query($db, $query);
}//Sjekker om brukeren har fått en høyere highscore
else if(isset($bruker['score']) && $sum > $bruker['score'] ){
	$query = "UPDATE highscore SET score = '$sum', dato = '$dato' WHERE brukernavn='$brukernavn' AND spillnavn ='$spill'";
	mysqli_query($db, $query);
}
?>

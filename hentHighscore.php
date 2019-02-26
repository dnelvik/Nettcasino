<?php
//Et lite script for å hente highscore fra databasen og gjøre det om til en html-tabell
//Kobler til database
include("server.php");
$spill = $_REQUEST["spill"];

//Lager spørring som henter highscore sortert fra høyest til lavest og rangerer dem fra 1 - n;
$set = "SET @rank=0;";
mysqli_query($db, $set);
$query = "SELECT @rank:=@rank+1 AS rank, brukernavn, spillnavn, score, dato FROM highscore WHERE spillnavn = '".$spill."' ORDER BY score DESC;";
$resultat = mysqli_query($db, $query);

echo "<tr><th>Rank</th><th>Brukernavn</th><th>Poeng</th><th>Spill</th><th>Dato</th></tr>";
while($rad = mysqli_fetch_array($resultat)){
	echo "<tr>";
	echo "<td>".$rad['rank']."</td>";
	echo "<td>".$rad['brukernavn']."</td>";
	echo "<td>".$rad['score']."</td>";
	echo "<td>".$rad['spillnavn']."</td>";
	echo "<td>".$rad['dato']."</td>";
	echo "</tr>";
}
?>
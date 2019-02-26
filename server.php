<?php
//server.php er oppkoblingen mot databasen og
//håndering av forskjellige argumenter og php forms.

//Starter sesjon
session_start();

if (isset($_GET['loggut'])) {
 session_destroy();
 unset($_SESSION['brukernavn']);
 unset($_SESSION['epost']);
 unset($_SESSION['penger']);
 header("location: index.php");
}

// variabler
$brukernavn = "";
$epost    = "";
$errors = array();
$success = array();

// koble opp database
$db = mysqli_connect('localhost', 'root', '', 'bygdacasino');
//legger til databasen

// Registrer - registrer bruker
if (isset($_POST['reg_bruker'])) {
  // hent tekst fra skjema
  $brukernavn = mysqli_real_escape_string($db, $_POST['username']);
  $brukernavn = ucfirst(strtolower($brukernavn));
  $epost = mysqli_real_escape_string($db, $_POST['email']);
  $fDato = mysqli_real_escape_string($db, $_POST['f_dato']);
  $passord_1 = mysqli_real_escape_string($db, $_POST['passord_1']);
  $passord_2 = mysqli_real_escape_string($db, $_POST['passord_2']);

  // sjekker at alle felt er fyllt ut
if (empty($brukernavn)) {
      array_push($errors, "Brukernavn må fylles ut");
    }
    if (empty($epost)) {
      array_push($errors, "Epost må fylles ut");
    }
    if (empty($passord_1)) {
      array_push($errors, "Passord må fylles ut");
    }

    if ($passord_1 != $passord_2) {
      array_push($errors, "Passordene er ikke like ");
    }

    // finner differansen av dagens dato og fødeselsdato
    $fDato = new DateTime($fDato);
    $split = explode("-", date('Y-m-d'));
    $dagensDato = "$split[0]-$split[1]-$split[2]";
    $dato = new DateTime($dagensDato);
    $interval = $dato->diff($fDato);
    $år = ($interval->format('%a')/365.24221065)+0.001;
    //+0.001 for å sikre at dagens dato -18år er godkjent.

    //sjekker om personen er over 18 år
    if ($år < 18) {
      array_push($errors, "* Du må være over 18 år");
    }

  // sjekk at brukernavn eller epost ikke finnes fra før
  $bruker_sjekk = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' OR epost='$epost' LIMIT 1";
  $resultat = mysqli_query($db, $bruker_sjekk);
  $bruker = mysqli_fetch_assoc($resultat);

  if ($bruker) { // hvis bruker finnes
    if ($bruker['brukernavn'] === $brukernavn) {
      array_push($errors, "Brukernavn finnes allerede");
    }

    if ($bruker['epost'] === $epost) {
      array_push($errors, "Epost finnes allerede");
    }
  }

  // registrer når ingen feilmeldinger oppstår
  if (count($errors) == 0) {
    $passord = md5($passord_1); // krypter passord
    $fDato = mysqli_real_escape_string($db, $_POST['f_dato']); // databasen tar dato som string
    $query = "INSERT INTO brukere (brukernavn, epost, fdato, passord )
          VALUES('$brukernavn', '$epost', '$fDato', '$passord')";
    mysqli_query($db, $query);
    header('location: index.php?logginn=1');
  }
}

// Header - Logg inn
if (isset($_POST['login_bruker'])) {
  $brukernavn = mysqli_real_escape_string($db, $_POST['brukernavn']);
  $brukernavn = ucfirst(strtolower($brukernavn));
  $passord = mysqli_real_escape_string($db, $_POST['passord']);

  //Sjekker at felt er fylt ut.
  if (empty($brukernavn)) {
    array_push($errors, "Oppgi brukernavn");
  }
  if (empty($passord)) {
    array_push($errors, "Oppgi passord");
  }

  //Ingen errors vi kan fortsette
  if (count($errors) == 0) {
    $passord = md5($passord); // krypterer passord før den sjekker med databasen
    $query = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' AND passord='$passord'";
    $results = mysqli_query($db, $query);
    $bruker = mysqli_fetch_assoc($results);
    $epost = $bruker['epost'];
    $penger = $bruker['penger'];
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['brukernavn'] = $brukernavn;
      $_SESSION['epost'] = $epost;
      $_SESSION['penger'] = $penger;
      header('location: index.php');
    }else {
      array_push($errors, "Feil Brukernavn/passord");
    }
  }
}
//Logg inn FERDIG

//Profil
//Bytting av passord
if (isset($_POST['change_pwd'])) {
  // hent tekst fra skjema
  $passord_0 = mysqli_real_escape_string($db, $_POST['passord_0']);
  $passord_1 = mysqli_real_escape_string($db, $_POST['passord_1']);
  $passord_2 = mysqli_real_escape_string($db, $_POST['passord_2']);

  // sjekker at alle felt er fyllt ut
  if (empty($passord_0)) {
      array_push($errors, "Gammelt passord må fylles ut");
  }
  if (empty($passord_1)) {
    array_push($errors, "Nytt passord må fylles ut");
  }

  if ($passord_1 != $passord_2) {
    array_push($errors, "Passordene er ikke like ");
  }

  $username = $_SESSION['brukernavn'];
  $pwd_check = "SELECT * FROM brukere WHERE brukernavn='$username' LIMIT 1";
  $resultat = mysqli_query($db, $pwd_check);
  $bruker = mysqli_fetch_assoc($resultat);

  if ($bruker) { // hvis bruker finnes
    if (!empty($passord_0)) {
      if (md5($passord_0) != $bruker['passord']) {
        array_push($errors, "Gammelt passord stemmer ikke");
      }
      // registrer når ingen feilmeldinger oppstår
      if (count($errors) == 0) {
        $passord = md5($passord_1); // krypter passord
        //uppdatterer passord
        $query = "UPDATE brukere SET passord = '$passord' WHERE brukernavn='$username'";
        mysqli_query($db, $query);
        //Skriver til output at alt gikk bra.
        array_push($success, "Passord er nå endret!");
      }
    }
  }
}

//Endre epost
if (isset($_POST['change_epost'])) {
  $epost = mysqli_real_escape_string($db, $_POST['email']);
// sjekker at alle felt er fyllt ut
  if (empty($epost)) {
      array_push($errors, "Epost må fylles ut.");
  }

  $query = "SELECT * FROM brukere WHERE epost='$epost' LIMIT 1";
  $resultat = mysqli_query($db, $query);
  $bruker = mysqli_fetch_assoc($resultat);

  if (!empty($epost)) {

    if ($bruker) { // hvis bruker finnes
      if ($epost == $_SESSION['epost']) {
        array_push($errors, "Epost er ikke endret.");
      }
      elseif ($bruker['epost'] === $epost) {
        array_push($errors, "Epost finnes allerede");
      }
    }
    // registrer når ingen feilmeldinger oppstår
    if (count($errors) == 0) {
      //oppdatterer passord
      $username = $_SESSION['brukernavn'];
      $query = "UPDATE brukere SET epost = '$epost' WHERE brukernavn='$username'";
      mysqli_query($db, $query);
      $_SESSION['epost'] = $epost;
      //Skriver til output at alt gikk bra.
      array_push($success, "Epost er nå endret!");
    }
  }
}

//Sette inn penger
if (isset($_POST['penger_inn'])) {
  $penger = mysqli_real_escape_string($db, $_POST['penger']);
// sjekker at alle felt er fyllt ut
  if (empty($penger)) {
      array_push($errors, "*Penger kan ikke være tom.");
  }

  //ingen feil?
  if (count($errors) == 0) {
    //oppdatterer penger
    $brukernavn = $_SESSION['brukernavn'];
    $query = "CALL opprettTransaksjon('$brukernavn', '$penger', 'Innskudd')";
    mysqli_query($db, $query);

    //Sjekk ny valuta
    $query = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' LIMIT 1";
    $resultat = mysqli_query($db, $query);
    $bruker = mysqli_fetch_assoc($resultat);
      $_SESSION['penger'] = $bruker['penger'];
    //Skriver til output at alt gikk bra.
    array_push($success, "Penger er nå satt inn!");
  }
}

//Uttak av penger
if (isset($_POST['penger_ut'])) {
  $penger = mysqli_real_escape_string($db, $_POST['penger']);
// sjekker at alle felt er fyllt ut
  if (empty($penger)) {
      array_push($errors, "*Penger kan ikke være tom.");
  }

  if ($penger > $_SESSION['penger']) {
      array_push($errors, "*Du har ikke så mye penger.");
  }

  //ingen feil?
  if (count($errors) == 0) {
    //uppdatterer penger
    $brukernavn = $_SESSION['brukernavn'];
    $penger = $penger * -1;
    $query = "CALL opprettTransaksjon('$brukernavn', '$penger', 'Uttak')";
    mysqli_query($db, $query);

    //Sjekk ny valuta
    $query = "SELECT * FROM brukere WHERE brukernavn='$brukernavn' LIMIT 1";
    $resultat = mysqli_query($db, $query);
    $bruker = mysqli_fetch_assoc($resultat);
      $_SESSION['penger'] = $bruker['penger'];
    //Skriver til output at alt gikk bra.
    array_push($success, "Penger er nå tatt ut!");
  }
}

//Slette bruker
if (isset($_POST['dlt_usr'])) {
  $brukernavn = $_SESSION['brukernavn'];
  $query1 = "DELETE FROM transaksjoner WHERE brukernavn='$brukernavn'";
  $query2 = "DELETE FROM brukere WHERE brukernavn='$brukernavn' LIMIT 1";
    mysqli_query($db, $query1);
    mysqli_query($db, $query2);
    header("location: server.php?loggut='1'");
}

//transaksjon tabell
if(isset($_GET['antall'])){
  $antall = $_GET['antall'];
  $brukernavn = $_SESSION['brukernavn'];
  $sql = "SELECT * FROM transaksjoner WHERE brukernavn LIKE '$brukernavn' ORDER BY transaksjonsNr DESC LIMIT $antall";
  $resultat = mysqli_query($db, $sql);

  while($row = mysqli_fetch_assoc($resultat)){
    $tNr = $row['transaksjonsNr'];
    $beskrivelse = $row['beskrivelse'];
    $transaksjon = $row['transaksjon'];
    $dato = $row['dato'];
    echo "<tr><td width='20%'>" . $tNr . "</td><td width='48%'>" . $beskrivelse . "</td><td width='20%'>" . $transaksjon . "</td><td width='12%'>" . $dato . "</td></tr>";
  }

  //Hvis antall rader = 0 kommer det en melding.
  if(mysqli_num_rows($resultat) == 0)
    echo "<tr><td colspan='4' style='color:red'>" . "Du har ingen transaksjoner.." . "</td></tr>";
  //Hvis det ikke er flere rader igjenn kommer det en melding.
  else if($antall > mysqli_num_rows($resultat))
    echo "<tr><td colspan='4' style='color:red'>" . "Du har ingen fler transaksjoner.." . "</td></tr>";
}
//Profil FERDIG

//Header - sanntids søk(s står for søk) henter ut bokser med linker på seg.
if(isset($_GET['s']) && $_GET['s'] != ''){
  $s = $_GET['s'];
  $sql = "SELECT spillnavn, ikon, utgitt FROM `spill` WHERE spillnavn LIKE '$s%' ORDER BY spillnavn";
  $resultat = mysqli_query($db, $sql);
  while($row = mysqli_fetch_assoc($resultat)){
    $spill = $row['spillnavn'];
    if($row['ikon'] != NULL)
      $ikon = $row['ikon'];
    else
      $ikon = 'standard.png';
    if($row['utgitt'])
      $url = strtolower($spill) . ".php";
    else
      $url = "spill.php?spill=" . $spill;
    if(!isset($_SESSION['brukernavn']))
      $url = "index.php?logginn=1";
    echo "<div style='padding:0;' id='searchtitle'>" . "<a style='font-family: verdana; text-decoration: none; padding: 12px 16px; display: block; color: black;' href='$url'>" . "<img height='30px' style='float:left' src='bilder/" . $ikon . "'>" . $spill . "</a>" . "</div>";
  }
}

//Spill - Henter spill dynamisk etter sortering.
//I form av små kort med bilde og tittel.
if(isset($_GET['sortby'])){
  $sort = $_GET['sortby'];
  $sql = "SELECT * FROM `spill`";
  $where = '';

  if(isset($_GET['sok']) && $_GET['sok'] != ''){
    //Hvis sok er satt setter vi $where.
    $where = " WHERE spillnavn LIKE '" . $_GET['sok'] . "%'";
  }

  if($sort == 'mestspilt'){
  //Gjør sql søk basert på unike brukere i transaksjoner.
  //Tar også en where settning hvis det er gjort et 'enter-søk' i header.
    $sql = "SELECT * FROM (SELECT spill.*, COUNT(DISTINCT brukernavn) AS play_count FROM spill LEFT JOIN transaksjoner ON spill.spillnavn = transaksjoner.beskrivelse GROUP BY spill.spillnavn ORDER BY `play_count`  DESC) AS spill" . $where;
  }else if($sort == 'a-z'){
    $sql = $sql . $where . 'ORDER BY spillnavn ASC';
  }else if($sort == 'z-a'){
    $sql = $sql . $where . 'ORDER BY spillnavn DESC';
  }else{
    return;
  }
  
  $resultat = mysqli_query($db, $sql);
  if(mysqli_num_rows($resultat) <= 0){
    return;//Returnerer om det ikke er noe resultat.
  }

  while($row = mysqli_fetch_assoc($resultat)){
    $spill = $row['spillnavn'];
    if($row['ikon'] != NULL)
      $ikon = $row['ikon'];
    else
      $ikon = 'standard.png';
    if($row['utgitt'])
      $url = strtolower($spill) . ".php";
    else
      $url = "?spill=" . $spill;
    if(!isset($_SESSION['brukernavn']))
      $url = "index.php?logginn=1";
    //lenker til logginn om man ikke er logget inn.

    echo "<div class='card'>
            <a href='" . $url . "'>
              <img class='img' src='bilder/" . $ikon . "'>
              <h3 class='card-title'>" . $spill . "</h3>
            </a>
          </div>";
  }
}

?>


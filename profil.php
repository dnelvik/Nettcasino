<!--Profil er en side som viser info om brukeren
  og lar brukeren gjøre presonlige endringer til databasen-->
<!DOCTYPE html>
<html lang="no">
<head>
  <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <title> Bygda Casino | Min profil</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/profil.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <meta charset="utf-8">

</head>
<body onload="visFler(teller)"><!--henter transaksjoner når dokument blir lastet-->
<?php include('header.php');
if (!isset($_SESSION['brukernavn'])) {
  //Tvinger brukeren til en annen side om han ikke er logget inn.
  echo "<script language='javascript'>window.location.href='index.php?logginn=1';</script>";
}
?>
    <section class="top-content">
      <div class="header-img-bg">
        <div class="content-profil" id="liten">
          <!--CONTENT SKAL INN HER -->
          <?php if (isset($_GET['arg'])) : ?>

            <!--ENDRE PASSORD -->
          <?php if ($_GET['arg'] == "passord") : ?>
              <form class="form" method="post" action="profil.php?arg=passord">
                <h1 class="header-form">Her kan du endre ditt gjelende passord</h1>
                <label class="label-form">GAMMELT PASSORD</label>
                <input class="input-form" type="password" name="passord_0">
                <label class="label-form">NYTT PASSORD</label>
                <input class="input-form" type="password" name="passord_1">
                <label class="label-form">GJENTA PASSORD</label>
                <input class="input-form" type="password" name="passord_2">
                <span class="span-form"><?php include('errors.php'); ?></span>
                <button type="submit" class="btn-form" name="change_pwd">Bytt Passord</button>
            </form>

          <?php endif ?>
          <!--ENDRE PASSORD FREDIG-->

          <!--ENDRE EPOST -->
          <?php if ($_GET['arg'] == "epost") : ?>
              <form class="form" method="post" action="profil.php?arg=epost">
                <h1 class="header-form">Endre din epost</h1>
                <label class="label-form">Epost</label>
                <input class="input-form" type="email" name="email" value="<?php echo $_SESSION['epost']; ?>">
                <button class="btn-form btn" type="submit" name="change_epost">Bytt epost</button>
              </form>
              <?php include('errors.php'); ?>
          <?php endif ?>
          <!--ENDRE EPOST FERDIG -->

          <!--PENGER INN -->
          <?php if ($_GET['arg'] == "pengerinn") : ?>
              <form class="form" method="post" action="profil.php?arg=pengerinn">
                <h1 class="header-form">Her setter du inn ønsket beløp</h1>
                <label class="label-form">Sett inn ønsket beløp</label>
                <input class="input-form" title="Beløp mellom" type="number" name="penger" min="1" placeholder="Velg gyldig beløp">
                <button class="btn-form btn" type="submit" name="penger_inn">Betal</button>
              </form>
              <?php include('errors.php'); ?>
          <?php endif ?>
          <!--PENGER INN FERDIG -->

          <!--PENGER UT -->
          <?php if ($_GET['arg'] == "pengerut") : ?>
              <form class="form" method="post" action="profil.php?arg=pengerut">
                <h1 class="header-form">Velg ønsket beløp du ønsker å ta ut</h1>
                <label class="label-form">Antall Kr</label>
                <input class="input-form" type="number" placeholder="Velg ønsket beløp" name="penger" min="1" value="100">
                <button class="btn-form btn" type="submit" name="penger_ut">Ta ut</button>
                <span class="span-form"><?php include('errors.php'); ?></span>
              </form>
          <?php endif ?>
          <!--PENGER UT FERDIG -->


          <!--SLETT BRUKER -->
          <?php if ($_GET['arg'] == "slett") : ?>
            <h1 class="header-form">Er du helt sikker på at du vil slette din bruker?</h1>
            <form class="form" method="post" action="server.php?arg=slett">
              <p class="p-form">Vær klar over at hvis du sletter kontoen din er det ingen måte å gjenoprette den igjen. Det vil si at alle penger også er tapt!</p>
              <button class="btn-form main" type="submit" id="dlt_usr"  name="dlt_usr" onclick="return confirm('Er du helt sikker på at du vill slette kontoen din for alltid??')">Slett bruker</button>
            </form>
          <?php endif ?>
          <!--SLETT BRUKER FERDIG -->

          <!--Transaksjon-->
          <!--arg er ikke satt så transaksjoner skal vises -->
          <?php endif ?>
          <?php if (!isset($_GET['arg'])) : ?>
           <div class="sticky-bar">
             <!-- Spaghetti kode på tabell. Borders og widths burde vært plasert inn i css filer og tildelt riktige id's -->
            <table id="tabell-header-sticky">
              <tr>
                <th colspan='4'><h3>Transaksjoner:</h3><input type="image" src="bilder/pluss.png" alt="Knapp for større informasjonsblokk" class="transknapp" onclick="stor(), byttBilde()"></th>
              </tr>
                <tr><td width="20%">tNr</td><td width="48%">Beskrivelse</td><td width="20%">verdi</td><td width="12%">dato</td></tr>
              </table>
            </div>
            <table id="tabell-profil" border="1px solid black" >
            </table>
            <button class="transknapp" type="button" name="button" onclick="visFler(teller+=7)"><i class="fas fa-history fa-2x"></i>  Vis fler rader</button>

          <?php endif ?>
          <!--Transaksjon FERDIG -->

          <!--SLUTT PÅ CONTENT -->
        </div>

<!--Knapper-->
      </div>
      <a href="profil.php?arg=pengerinn">
        <div class="top-box box-a">
          <i class="fas fa-credit-card fa-2x"></i>
          <h3>Sett inn penger</h3>
        </div>
      </a>


      <a href="profil.php?">
        <div class="top-box box-b">
          <i class="fas fa-history fa-2x"></i>
          <h3>Se transaksjoner</h3>
        </div>
      </a>

      <section class="boxes-under">
        <a href="profil.php?arg=passord">
          <div class="box">
            <i class="fas fa-key fa-2x"></i>
            <h3>Bytt passord</h3>
          </div>
        </a>

        <a href="profil.php?arg=epost">
          <div class="box">
            <i class="fas fa-envelope-square fa-2x"></i>
            <h3>Bytt email</h3>
          </div>
        </a>

        <a href="profil.php?arg=pengerut">
          <div class="box">
            <i class="fas fa-exchange-alt fa-2x"></i>
            <h3>Ta ut penger</h3>
          </div>
        </a>

        <a href="profil.php?arg=slett">
          <div class="box">
            <i class="fas fa-user-times fa-2x"></i>
            <h3>Slett bruker</h3>
          </div>
        </a>

      </section>
    </section>
<!--Knapper FERDIG-->



<?php include('footer.php') ?>
<script>

//Kode for å bytte forstørrelsesglass
//fra maximer til minimer.
var on = false;
function byttBilde(){

  var bilde = document.getElementById('transknapp');

  if (on == true) {
    bilde.src ="bilder/pluss.png";
    on = false;
  }else{
    bilde.src = "bilder/minus.png";
    on = true;
  }
}

//Funksjon for å gjøre transaksjoner storer.
function stor(){
  if (document.getElementById("liten"))
  {

    document.getElementById("liten").setAttribute("id", "trans");

  }
  else
  {
    document.getElementById("trans").setAttribute("id", "liten");
  }
}


//Funksjon for å vise flere transaksjoner til brukeren i sanntid.
var teller = 7;//Dette er så mange rader vi henter av gangen.

function visFler(antall){
  var xmlhttp;
  if(window.XMLHttpRequest){
    xmlhttp = new XMLHttpRequest();
  }else{
    xmlhttp = new ActiveXObject("XMLHTTP");
  }
  xmlhttp.onreadystatechange = function(){
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
      document.getElementById('tabell-profil').innerHTML = xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET", "server.php?antall=" + antall, true);
  xmlhttp.send(null);
    }
  </script>

</body>
</html>

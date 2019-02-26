<!--Landings side for nettstedet, info og reklame samt lenker til andre ting-->
<!DOCTYPE html>
<html>
<head>
<title>Forsides | Bygda Casino</title>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/login.css">


</head>
<body>
<?php include('header.php'); ?>
<!--Bilder som rulerer automatisk eller ved tastetrykk-->
  <header id="header-index" class="grid">
    <div class="imgslideshow slide-img"></div>
    <div class="imgslideshow slide-img2"></div>
    <div class="imgslideshow slide-img3"></div>
    <div class="content-wrap">
        <h1>Registrer idag og få ekstra innskudd!</h1>
        <div>
          <span class="dot" onclick="currentSlide(1)"></span>
          <span class="dot" onclick="currentSlide(2)"></span>
          <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </div>
    <!--Bytter bilde til forige og neste-->
    <a class="prev" onclick="plusSlides(-1),  stopp()">&#10094;</a>
    <a class="next" onclick="plusSlides(1) , stopp()">&#10095;</a>
  </header>

<!--Hoved innhold for siden-->
  <main id="main">
    <section id="section-a" class="grid">
      <div class="content-wrap">
        <div class="content-text">
          <h2 class="content-title"> Sommer er rett rundt hjørnet og vi har kampanje </h2>
          <p>Sett inn over $5000 og få $500 i innskuds bonus!</p>
        </div>
      </div>
    </section>

    <section id="section-b" class="grid">
      <ul>
        <li>
          <div class="card-spill">
            <a href="coinflip.php" title="Coinflip spill">
              <img class="img" src="bilder/coin.jpg">
              <div class="card-content">
                <h3 class="card-title">Coin-flip</h3>
                <p>Mynt-kast med store muligheter for gevinst! Prøv vårt mest spilte spill!</p>
              </div>
            </a>

          </div>

        </li>
        <li>
          <div class="card-spill">
            <a href="blackjack.php"  title="Blackjack spill">
              <img class="img" src="bilder/cards.jpeg">
              <h3 class="card-title">Blackjack</h3>
              <p>Verdens mest spilte spill. Enjoy!</p>
            </div>
          </a>
        </div>

      </li>
      <li>
        <div class="card-spill">
          <a href="jackpot.php" title="Slotmachine spill">
            <img class="img" src="bilder/slot.jpg">
            <div class="card-content">
              <h3 class="card-title">Jackpot</h3>
              <p>Luringen Danay har fikset ett spill for oss!</p>
            </div>
          </a>
        </div>

      </li>
    </ul>
  </section>

  <section id="section-c" class="grid">
    <div class="content-wrap">
      <h2 class="content-title">
        Kontakt oss i Bø kasino
      </h2>
      <p> Er det noe du lurer på er det bare å kontakte oss. Følg linken under eller bruk navigeringen øverst
        på websiden for å finne kontakt informasjon. May the odds ever be in your favor!
      </p>
      <a href="omoss.php#section-b-AboutUs" class="btn"> Mer.. </a>
    </div>
  </section>
</main>

<?php include('footer.php'); ?>
<script>
//Kode for bilde karusell kopiert fra w3schools men med endringer.
//ref: https://www.w3schools.com/howto/howto_js_slideshow.asp
var slideIndex = 1;
visBilder(slideIndex);

// Neste/forige knapp
function plusSlides(n) {
  visBilder(slideIndex += n);
}

// kontroll for knappene
function currentSlide(n) {
  visBilder(slideIndex = n);
}
//Viser bilde 'n'
function visBilder(n) {
  var i;
  var slides = document.getElementsByClassName("imgslideshow");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }


  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}

//Timer for autmatisk bytting av bilde
function timer(){
  plusSlides(+1);
}


var interval = window.setInterval(timer, 5000);
//Stopper timer
function  stopp(){
  clearInterval(interval);
}
</script>
</body>
</html>

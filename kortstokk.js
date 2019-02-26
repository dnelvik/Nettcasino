//Klasse for kortstokken
class Kortstokk {
	// Konstruktør for oppretting av kortstokk
	constructor() {
		this.kortstokk = [];
	}
	//Metode som lager kortstokken
	lagKortstokk() {
		//Konstruktør for et kort
		let kort = (farge, tall) => {
			this.farge = farge;
			this.tall = tall;
			this.navn = farge + "-" + tall;

			return {navn:this.navn, farge:this.farge, tall:this.tall}
		}

		let tall = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'Knekt', 'Dame', 'Konge'];
		let farge = ['K', 'S', 'H', 'R'];

		for (let f = 0; f < farge.length; f++){
			for (let t = 0; t<tall.length; t++){
				this.kortstokk.push(kort(farge[f], tall[t]));
			}
		}
	}
	//Metode som printer ut kortstokken
	printKortstokk(){
		let print = "<h1>";
		for (let i=0; i<this.kortstokk.length; i++){
			print += "<p>" + this.kortstokk[i].navn + "</p>";
		}
		print += "</h1>";
  		document.getElementById("utdata").innerHTML = print;
	}
	//Metode som stokker kortstokken
	stokk(){
		for (let i=0; i<this.kortstokk.length; i++){
			var rand = Math.floor(Math.random() * this.kortstokk.length);
			let temp = this.kortstokk[i];
			this.kortstokk[i] = this.kortstokk[rand];
			this.kortstokk[rand] = temp;
		}

	}
	//Metode som deler ut et kort fra kortstokken.
	deal() {
		var navn = this.kortstokk[0].navn;
		this.kortstokk.shift();
		return navn;
	}
}

/// KLASSE FOR SPILLER OG DEALER
class Spiller{
	//Konstruktør for spiller/dealer
	constructor(){
		this.kort = [];
		this.poeng = 0;
	}
	//Sjekker poengsummen til spiller/dealer
	sjekkPoeng(){
		var poeng = 0;
		var vinn = false;
		for (var i=0; i<this.kort.length; i++){
			var temp = this.kort[i].split("-")[1];
			if (temp == "Knekt" || temp == "Dame" || temp == "Konge"){
				poeng += 10;
			}
			else {
				poeng += parseInt(temp);
			}
		}
		for (var i=0; i<this.kort.length; i++){
			if (this.kort[i].split("-")[1] == 1){
				if (poeng < 12){
					poeng += 10;
				}
			}
		}
		return poeng;
	}
}
//Starter spillet
function init() {
	startSpill();
}

//globale variabler
var kortstokk;
var spiller;
var dealer;
var slutt=true;
var bet = 0;
var bets = true;
var sideTxt = "Velkommen til Blackjack";

//Funksjon som oppretter en ny runde.
function startSpill(){
	if (slutt == false){
		updateTxt("Du avbrøt runden og tapte " + bet + "$.");
	}
	if (bets == true){
		penger += bet;
	}
	//resetter alle globale verdier
	slutt = true;
	bets = true;
	bet = 0;
	split = 0;
	//Instansierer spillere og kortstokk
	kortstokk = new Kortstokk();
	spiller = new Spiller();
	dealer = new Spiller();
	//Oppretter kortstokk
	kortstokk.lagKortstokk();
	kortstokk.stokk();
	//Oppretter spiller og dealer
	spiller.kort.push(kortstokk.deal(), kortstokk.deal());
	dealer.kort.push(kortstokk.deal(), kortstokk.deal());
	dealer.poeng = null;

	//oppdaterer all GUI
	updateSpiller();
	updateDealer();
	updateTxt();
	updateButtons();
}

//Trykk hit knapp - få et kort
function hit(){
	if (slutt != true){
		spiller.kort.push(kortstokk.deal());
		updateSpiller();
		updateButtons();
		if (spiller.sjekkPoeng() > 21){
			tapte();
		}
	}
}

//Funksjon som kjører når stand-knappen trykkes på.
function stand() {
	if (slutt != true){
		slutt = true;
		dealeren();
		if (dealer.sjekkPoeng() == spiller.sjekkPoeng()){
			tie();
		}
		else if (dealer.sjekkPoeng() > 21 || dealer.sjekkPoeng() < spiller.sjekkPoeng()){
			vinn();
		} else {
			tapte();
		}
	}
}

//Dealers turn, kjøres etter spiller er ferdig
function dealeren(){
	while (dealer.sjekkPoeng() < 17){
		dealer.kort.push(kortstokk.deal());
	}
	updateDealer();
}

//Oppdaterer spiller-delen av GUI på spillet 
function updateSpiller(){
	//SPILLER
	if (bets==false){
		var txt = "<p>Spiller<br>Bet:" + bet + "<br> Poeng: " + spiller.sjekkPoeng() + "</p>";
	}
	else {
		var txt = "<p>Spiller<br>Bet:" + bet + "<br> Poeng: ";
	}
	var txtF = txt.fontcolor("white");
	document.getElementById("utdata").innerHTML = txtF;
	for (var i=0; i<spiller.kort.length; i++){
		var kortNavn = spiller.kort[i];
		if (bets == true){
			kortNavn = "back";
		}
		var img = document.createElement("img");
		img.src = "Kort/" + kortNavn + ".png";
		img.height = "100";
		document.getElementById("utdata").appendChild(img);
	}
}
//Oppdaterer dealeren sin del av GUI på spillet
function updateDealer(){
	if (slutt==true && bets==false){
		var førTxt = "<p>Dealer" + "<br> Poeng: " + dealer.sjekkPoeng() + "</p>";
	}
	else {
		var førTxt = "<p>Dealer" + "<br> Poeng: ";
	}
	var txtFarge = førTxt.fontcolor("white");
	document.getElementById("dealerdata").innerHTML = txtFarge;
	for (var i=0; i<dealer.kort.length; i++){
		var kortNavn = dealer.kort[i];
		if (bets == true){
			kortNavn = "back";
		} else if (bets == false && slutt == false){
			if (i == 0) kortNavn = "back";
		}

		var img = document.createElement("img");
		img.src = "Kort/" + kortNavn + ".png";
		img.height = "100";
		document.getElementById("dealerdata").appendChild(img);
	}
}

//Oppdaterer logg og penger
function updateTxt(tekst){
	//logg
	var logg = document.getElementById("tekst");
	if (tekst!=null){
		sideTxt = sideTxt + "<br>" + tekst;
	}
	logg.innerHTML = sideTxt;
	logg.scrollTop = logg.scrollHeight;

	//penger
	var sumTxt = "Du har $" + penger + " disponibelt.";
	document.getElementById("sum").innerHTML = sumTxt;
	document.getElementById("saldo-header").innerHTML = "$" + penger;
}

//Funksjon som oppdaterer synligheten av knappene for å
//indikere hvilke som kan trykkes på.
function updateButtons() {
	if (slutt == false){
		document.getElementById("start").style.opacity = "0.5";
		document.getElementById("bet5").style.opacity = "0.5";
		document.getElementById("bet25").style.opacity = "0.5";
		document.getElementById("bet100").style.opacity = "0.5";
		document.getElementById("hit").style.opacity = "1";
		document.getElementById("stand").style.opacity = "1";
		if (spiller.kort.length == 2 && bet < penger){
			document.getElementById("doubledown").style.opacity = "1";
		}
		else {
				document.getElementById("doubledown").style.opacity = "0.5";
		}
	} else if (slutt==true && bets == true) {
		document.getElementById("start").style.opacity = "1";
		document.getElementById("bet5").style.opacity = "1";
		document.getElementById("bet25").style.opacity = "1";
		document.getElementById("hit").style.opacity = "0.5";
		document.getElementById("stand").style.opacity = "0.5";
		document.getElementById("bet100").style.opacity = "1";
		document.getElementById("doubledown").style.opacity = "0.5";
	} else {
		document.getElementById("start").style.opacity = "0.5";
		document.getElementById("bet5").style.opacity = "0.5";
		document.getElementById("bet25").style.opacity = "0.5";
		document.getElementById("hit").style.opacity = "0.5";
		document.getElementById("stand").style.opacity = "0.5";
		document.getElementById("bet100").style.opacity = "0.5";
		document.getElementById("doubledown").style.opacity = "0.5";

	}
}

//Når spiller taper
function tapte(){
	slutt = true;
	dealeren();
	updateTxt("Tap.. du tapte $" + bet);
	updateButtons();
}
//Når spiller vinner
function vinn(blackjack){
	slutt = true;
	dealeren();
	updateButtons();
	if (!blackjack == 1){
		penger += bet*2;
		updateTxt("Du vant! Du tjente $" + bet);
		bet = bet*2;
	} else {
		updateTxt("BLACKJACK! Du tjente $" + (bet+(bet/2)));
		bet = (bet*2) + (bet/2);
		penger += bet;
	}
	trekkIfraSum(bet);

}
//Når spiller slutter og begge har like mye poeng
function tie(){
	slutt = true;
	dealeren();
	updateButtons();
	penger += bet;
	trekkIfraSum(bet);
	updateTxt("Uavgjort! Bettet returneres.");
}
//Vedder 5
function bet5(){
	if (bets==false) return;
	if (penger < 5){
		updateTxt("For lite penger på saldo.");
		return;
	}
	bet += 5;
	penger -= 5;
	updateTxt("Du økte bettet med $5");
	updateSpiller();
}
//Vedder 25
function bet25(){
	if (bets==false) return;
	if (penger < 25){
		updateTxt("For lite penger på saldo.");
		return;
	}
	bet += 25;
	penger -= 25;
	updateTxt("Du økte bettet med $25");
	updateSpiller();
}
//Vedder 100
function bet100(){
	if (bets==false) return;
	if (penger < 100){
		updateTxt("For lite penger på saldo.");
		return;
	}
	bet += 100;
	penger -= 100;
	updateTxt("Du økte bettet med $100");
	updateSpiller();
}
//Double down for når knappen trykkes
function doubleDown(){
	if (slutt==true) return;
	if (bet > penger) return;
	if (spiller.kort.length != 2) return;
	penger -= bet;
	trekkIfraSum(-bet);
	bet = bet*2;
	updateSpiller();
	updateTxt("Double down! Bettet er doblet.")
	hit();
	stand();
}
//Starter spillet etter betsa er satt
function flip(){
	if (bets == false) return;
	if (bet == 0){
		updateTxt("Bet kan ikke være 0.");
		return;
	}
	slutt = false;
	bets = false;
	updateSpiller();
	updateDealer();
	updateButtons();
	trekkIfraSum(-bet);
	updateTxt("Du startet spillet med $" + bet + " i potten. Lykke til!");
	if (spiller.sjekkPoeng() == 21 && dealer.sjekkPoeng() != 21){
		vinn(1);
	} else if (spiller.sjekkPoeng() == 21 && dealer.sjekkPoeng() == 21){
		uavgjort();
	}
}

//Oppdaterer pengevariabel i databasen
function trekkIfraSum(sum){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open("POST", "s_a_server.php?sum="+sum+"&spill=Blackjack", true);
	xmlhttp.send();
}

document.addEventListener('DOMContentLoaded', init, false);

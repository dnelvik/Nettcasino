/* 
Spilleautomat for bruk i canvas
Forfatter: Åsmund Norderud
*/

//Slot klasse
class Slot {
	constructor(x, y, maxSpin) {
		this.x = x;
		this.y = y;
		this.maxSpin = maxSpin;
		this.symbol = 1;
		this.teller;
		this.id;
		this.pos = 0;
	}
	//For å starte sloten
	start(){
		this.teller = 0;
		this.id = setInterval(this.spin.bind(this), 100);
	}
	spin(){
		if(this.teller >= this.maxSpin){
			clearInterval(this.id);
			if(this.pos == 3){
				kjører = false;
				resultat();
			}
		} else {
			this.symbol = nysymbol;
			this.tegnSlot();
			this.teller++;
			if(this.pos == 3){
				nysymbol = randomSymbol(this.symbol);
			}
		}
	}
	//Tegner sloten
	tegnSlot(){
		var img = new Image();
		switch(this.symbol){
			case 1: img.src = 'bilder/firkløver.png'; break;
			case 2: img.src = 'bilder/hestesko.png'; break;
			case 3: img.src = 'bilder/ess.png'; break;
			case 4: img.src = 'bilder/chip.png'; break;
			case 5: img.src = 'bilder/mynter.png'; break;
			case 6: img.src = 'bilder/pengesekk.png'; break;
			case 7: img.src = 'bilder/diamant.png';
		}
		img.onload = function(){
			c.drawImage(img, this.x, this.y, 370, 370);
		}.bind(this);
	}
}

//Deklarerer variabler før oppstart
var canvas = document.querySelector('canvas');
var c = canvas.getContext('2d');
c.imageSmoothingEnabled = false;
c.font = "30px Arial";

var sum;
var saldo;
var kjører = false;

var id1;
var id2;
var id3;

var nysymbol;

var slot1 = new Slot(30, 30, 10);
var slot2 = new Slot(415, 30, 20);
var slot3 = new Slot(800, 30, 30);
slot3.pos = 3;
oppstart();

//Kjøres ved oppstart
function oppstart(){
	c.clearRect(0, 0, canvas.width, canvas.height);
	slot1.tegnSlot();
	slot2.tegnSlot();
	slot3.tegnSlot();
}
//Kjøres når spin trykkes
function spill(){
	if(kjører == true){
		return;
	}
	//Henter valgt sum fra radiobuttons
	var radioknapper = document.getElementsByName('toggle');
	for (var i = 0, length = radioknapper.length; i < length; i++)
	{
		if (radioknapper[i].checked)
		{
			sum = radioknapper[i].value;
			break;
		}
	}
	saldo = document.getElementById('sfelt').value;

	// Hvis det er for lite penger på saldo
	if(saldo-sum < 0){
		return;
	}
	//Trekker ifra valgt sum fra brukerens saldo
	oppdaterSaldo(-sum);

	//Starter maskinen
	slot1.start();
	slot2.start();
	slot3.start();
	kjører = true;
}
// Finner resultatet og oppdaterer saldo til brukeren hvis man vinner
function resultat(){
	var gevinst = 0;
	var resultat = [slot1.symbol, slot2.symbol, slot3.symbol];
	if(slot1.symbol == slot2.symbol && slot1.symbol == slot3.symbol){
		gevinst = treLike(slot1.symbol);
	} else if( slot1.symbol == slot2.symbol){
		gevinst = toLike(slot1.symbol);
	} else if (slot3.symbol == 7) {
		gevinst = sum*2;
	}
	document.getElementById("gfelt").value = gevinst;
	//Oppdaterer saldo hvis man vinner
	if(gevinst != 0)
		oppdaterSaldo(gevinst);
}
//Oppdaterer saldo med valgt sum
function oppdaterSaldo(sum){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			document.getElementById("sfelt").value = this.responseText;
			document.getElementById("saldo-header").innerHTML = "$"+this.responseText;
		}
	}
	xmlhttp.open("POST", "s_a_server.php?sum="+sum+"&spill=Jackpot", true);
	xmlhttp.send();
}
//Regner gevinst hvis det er 3 like
function treLike(symbol){
	var x;
	switch(symbol){
		case 1: x = sum*3; break;
		case 2: x = sum*6; break;
		case 3: x = sum*12; break;
		case 4: x = sum*24; break;
		case 5: x = sum*48; break;
		case 6: x = sum*96; break;
		case 7: x = sum*192; break;
	}
	return x;
}
//Regner ut gevinst hvis det er 2 like
function toLike(symbol){
	var x;
	switch(symbol){
		case 1: x = sum*1.5; break;
		case 2: x = sum*3; break;
		case 3: x = sum*6; break;
		case 4: x = sum*12; break;
		case 5: x = sum*24; break;
		case 6: x = sum*48; break;
		case 7: x = sum*96; break;
	}
	return x;
}
// Funksjon for å returnere et tilfeldig symbol,
// Kan ikke være to like på rad
function randomSymbol(forrigeSymbol){
	var random = Math.floor(Math.random()*100);
	var symbol;
	if(random < 30){
		symbol = 1;
	} else if (random < 51){
		symbol = 2;
	} else if( random < 67){
		symbol = 3;
	} else if ( random < 80){
		symbol = 4;
	} else if( random < 90){
		symbol = 5;
	} else if (random < 96){
		symbol = 6;
	} else {
		symbol = 7;
	}
	if(symbol == forrigeSymbol){
		symbol = randomSymbol(symbol);
	}
	return symbol;
}

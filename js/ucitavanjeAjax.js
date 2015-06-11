function ucitaj(linkStranice)
{
    var ajax;
	if (window.XMLHttpRequest)
	{
	ajax=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	ajax=new ActiveXObject("Microsoft.XMLHTTP");
	}
    ajax.onreadystatechange = function()
	{// Anonimna funkcija
		if (ajax.readyState == 4 && ajax.status == 200)
		{
			document.getElementById("tijelo").innerHTML = ajax.responseText;
		}
		if (ajax.readyState == 4 && ajax.status == 404)
		{
			document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
		}
    }
    ajax.open("GET", linkStranice, true);
	ajax.send();
}

//ucitaj('pocetna.html');

function ucitajPHP(linkStranice)
{
    var ajax;
	if (window.XMLHttpRequest)
	{
	ajax=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	ajax=new ActiveXObject("Microsoft.XMLHTTP");
	}
    ajax.onreadystatechange = function()
	{// Anonimna funkcija
		if (ajax.readyState == 4 && ajax.status == 200)
		{
			document.getElementById("tijelo").innerHTML = ajax.responseText;
		}
		if (ajax.readyState == 4 && ajax.status == 404)
		{
			document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
		}
    }
    ajax.open("GET", linkStranice, true);
	ajax.send();
	
}

var provjera="";

function ucitajKomentare(id)
{
	var ajax;
	if (window.XMLHttpRequest)
	{
	ajax=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	ajax=new ActiveXObject("Microsoft.XMLHTTP");
	}
    ajax.onreadystatechange = function()
	{// Anonimna funkcija
		var x="sadrzaj"+id;
		if (ajax.readyState == 4 && ajax.status == 200)
		{
			document.getElementById(x).innerHTML = ajax.responseText;
		}
		if (ajax.readyState == 4 && ajax.status == 404)
		{
			document.getElementById("sadrzaj"+id).innerHTML = "Greska: nepoznat URL";
		}
    }
    var linkStranice="";   
    if(provjera=="")
	{
		linkStranice= "phpSkripte/komentariServis.php?"+"vijest="+id;
		provjera=id;
		ajax.open("GET", linkStranice, true);
		ajax.send();
	}
	else 
	{
		linkStranice= "phpSkripte/komentariServis.php";
		provjera="";
		ajax.open("GET", linkStranice, true);
		ajax.send();
	}
	
}

function dodajKomentar(komentar,autor,id)
{
	var ajax;
	if (window.XMLHttpRequest)
	{
	ajax=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	ajax=new ActiveXObject("Microsoft.XMLHTTP");
	}
    ajax.onreadystatechange = function()
	{// Anonimna funkcija
		var x="sadrzaj"+id;
		if (ajax.readyState == 4 && ajax.status == 200)
		{
			document.getElementById(x).innerHTML = ajax.responseText;
		}
		if (ajax.readyState == 4 && ajax.status == 404)
		{
			document.getElementById("sadrzaj"+id).innerHTML = "Greska: nepoznat URL";
		}
    }
    var linkStranice="";   
    if(provjera=="")
	{
		linkStranice= "komentariServis.php?"+"komentar="+komentar&"autor="+autor&"id="+id;
		provjera=id;
		ajax.open("POST", linkStranice, true);
		ajax.send();
	}
	else 
	{
		linkStranice= "komentariServis.php";
		provjera="";
		ajax.open("POST", linkStranice, true);
		ajax.send();
	}
	
}

function ucitajIndex(link)
{
    var ajax;
	if (window.XMLHttpRequest)
	{
	ajax=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
	ajax=new ActiveXObject("Microsoft.XMLHTTP");
	}
    ajax.onreadystatechange = function()
	{// Anonimna funkcija
		if (ajax.readyState == 4 && ajax.status == 200)
		{
			document.getElementById("tijelo").innerHTML = ajax.responseText;
		}
		if (ajax.readyState == 4 && ajax.status == 404)
		{
			document.getElementById("tijelo").innerHTML = "Greska: nepoznat URL";
		}
    }
    ajax.open("GET", link, true);
	ajax.send();
}




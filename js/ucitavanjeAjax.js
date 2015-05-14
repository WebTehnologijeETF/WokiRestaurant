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
    ajax.open("POST", linkStranice, true);
	ajax.send();
}

//ucitaj('pocetna.html');

function ucitajPHP(linkStranice)
{
	ucitaj('index.html');
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
    ajax.open("POST", linkStranice, true);
	ajax.send();
	
}
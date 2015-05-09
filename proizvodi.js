function omoguciID()
{
	try
	{
		omoguciSve();
		var id = document.getElementById("idP");
		id.disabled=false;

	}
	catch(e)
	{}
}
function onemoguciID()
{
	try
	{
		omoguciSve();
		var id = document.getElementById("idP");
		id.disabled=true;
	}
	catch(e)
	{}
}
function onemoguciSve()
{
	try
	{
		omoguciID();
		var naziv = document.getElementById("nazivP");
		naziv.disabled=true;
		var opis = document.getElementById("opis");
		opis.disabled=true;
		var url = document.getElementById("urlSlike");
		url.disabled=true;
	}
	catch(e)
	{}
}

function omoguciSve()
{
	try
	{
		var naziv = document.getElementById("nazivP");
		naziv.disabled=false;
		var opis = document.getElementById("opis");
		opis.disabled=false;
		var url = document.getElementById("urlSlike");
		url.disabled=false;
	}
	catch(e)
	{}
}
var check=false;
function validiraj()
{
	return (validacijaNaziva("nazivP")&& validacijaOpisa("opis") && validacijaUrla("urlSlike"));	
}

function validacijaIDa(id)
{
	var id= document.getElementById(id);
	var idV= document.getElementById(id).value;
	var errorElement= document.getElementById("IDError");
	if (idV.length==0)
		{
			errorSlika6.style.visibility = "visible";
			check=false;
			return prikaziPoruku(false,"Morate unijeti id!", errorElement);
		}
	else 
		{
			errorSlika6.style.visibility = "hidden";
			check=true;
			return prikaziPoruku(true,"", errorElement);
		}
	
}
function validacijaNaziva(id)
{
	var naziv= document.getElementById(id);
	var nazivV= document.getElementById(id).value;
	var errorElement= document.getElementById("NazivError");
	if (nazivV.length==0)
	{
		errorSlika7.style.visibility = "visible";
		check=false;
		return prikaziPoruku(false,"Morate unijeti naziv!", errorElement);
	}
	else 
	{
		errorSlika7.style.visibility = "hidden";
		check=true;
		return prikaziPoruku(true,"", errorElement);
	}
}
function validacijaOpisa(id)
{
	var opis= document.getElementById(id);
	var opisV= document.getElementById(id).value;
	var errorElement= document.getElementById("OpisError");
	if (opisV.length==0)
	{
		errorSlika8.style.visibility = "visible";
		check=false;
		return prikaziPoruku(false,"Morate unijeti opis!", errorElement);
	}
	else 
	{
		errorSlika8.style.visibility = "hidden";
		check=true;
		return prikaziPoruku(true,"", errorElement);
	}
}
function validacijaUrla(id)
{
	var url= document.getElementById(id);
	var urlV= document.getElementById(id).value;
	var errorElement= document.getElementById("UrlError");
	if (urlV.length==0)
	{
		errorSlika9.style.visibility = "visible";
		check=false;
		return prikaziPoruku(false,"Morate unijeti url!", errorElement);
	}
	else 
	{
		errorSlika9.style.visibility = "hidden";
		check=true;
		return prikaziPoruku(true,"", errorElement);
	}
}
function prikaziPoruku(isValid, errorMsg, errorElement) {
   if (isValid==false)
	   {
		  if (errorElement !== null) 
		  {
			 errorElement.innerHTML = errorMsg;
		  } 
		  else 
		  {
			 alert(errorMsg);
		  }
		  return false;
		}
   else 
   {
        if (errorElement !== null)
		{
			errorElement.innerHTML = "";
		}
		return true;
   }
}

function obradiProizvod()
{
  try
  {
	  var rb1 = document.getElementById("dodavanje");
	  var rb2 = document.getElementById("izmjena");
	  var rb3 = document.getElementById("brisanje");
	  if(rb1.checked==true)
	  {
		  return dodajProizvod();
	  }
	  else if(rb2.checked==true)
	  {
		  return izmijeniProizvod();
	  }
	  else if(rb3.checked==true)
	  {
		  return obrisiProizvod();
	  }
  }	
  catch(e)
  {}
}
function dodajProizvod() {

	validiraj();
	if(check==true)
	{
		var forma = document.getElementById('formaUnosProizvoda');
		var naziv = forma.nazivP.value;
		var opis = forma.opis.value;
		var slika = forma.urlSlike.value;
		var proizvod = {
			naziv: naziv,
			opis: opis,
			slika: slika,
		};
		var ajax=new XMLHttpRequest();
			ajax.onreadystatechange=function(){
				if(ajax.status === 200 & ajax.readyState === 4)
					{
					alert("Dodali ste proizvod!");
				}
			}
		ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16287", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("akcija=dodavanje" + "&brindexa=16287&proizvod=" + JSON.stringify(proizvod));
		prikaziProizvode();
	}
	else return false;
}

function izmijeniProizvod(){
	validiraj();
	if(check==true)
	{
	var forma = document.getElementById('formaUnosProizvoda');
	var id= forma.idP.value;
	var naziv = forma.nazivP.value;
	var opis = forma.opis.value;
	var slika = forma.urlSlike.value;
	var proizvod = {
		id:id,
		naziv: naziv,
		opis: opis,
		slika: slika,
	};
    var ajax;
	if (window.XMLHttpRequest)	
	{// code for IE7+, Firefox, Chrome, Opera, Safari
			ajax=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		ajax=new ActiveXObject("Microsoft.XMLHTTP");
	}
    ajax.onreadystatechange = function()
	{// Anonimna funkcija                               
		if (ajax.readyState == 4 && ajax.status == 200 )
		{
			alert("Izmjenili ste proizvod!");    								
		} 					
   }
    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16287", true);
	ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("akcija=promjena" + "&brindexa=16287&proizvod=" + JSON.stringify(proizvod));
	prikaziProizvode();
	}
	else return false;
}

function obrisiProizvod(){
	
	validiraj();
	if(check==true)
	{
		var forma = document.getElementById('formaUnosProizvoda');
		var id = forma.idP.value;
		var proizvod={
			id:id
		};
		var ajax;
		if (window.XMLHttpRequest)	
		{// code for IE7+, Firefox, Chrome, Opera, Safari
			ajax=new XMLHttpRequest();
		}
		else	
		{// code for IE6, IE5
			ajax=new ActiveXObject("Microsoft.XMLHTTP");
		}
	    ajax.onreadystatechange = function() 
		{// Anonimna funkcija
											
			if (ajax.readyState == 4 && ajax.status == 200 )
			{
				alert("Obrisali ste proizvod!");						
			} 
	   }
		ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16287", true);
		ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		ajax.send("akcija=brisanje" + "&brindexa=16287&proizvod=" + JSON.stringify(proizvod));
		prikaziProizvode();
	}
	else return false;
}

function prikaziProizvode()
{
	var ajax;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		ajax=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		ajax=new ActiveXObject("Microsoft.XMLHTTP");
	}
    ajax.onreadystatechange = function()
	{// Anonimna funkcija                                       
		if (ajax.readyState == 4 && ajax.status == 200 ){
			preuzmi(ajax.responseText);						
		} 						
   }
    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16287", true);
	ajax.send();
}
function preuzmi(response)
{
	try
	{
		var niz= JSON.parse(response);
		var izlaz="";																												
		for(var i=0; i < niz.length; i++)
		{
			slika=niz[i].slika;
			opis=niz[i].opis;
			izlaz=izlaz+ "<tr><td>";
			izlaz= izlaz + opis +"</td><td><img src=" + slika + " alt='' height='150px' weight='230px'>";
			izlaz= izlaz + "</td></tr>";
		}
		document.getElementById("pregled").innerHTML = izlaz;
	}
	catch(e)
	{}		
}



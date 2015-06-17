/*var errorSlika= document.getElementById("errorSlika");
var errorSlika1= document.getElementById("errorSlika1");
var errorSlika2= document.getElementById("errorSlika2");
var errorSlika3= document.getElementById("errorSlika3");
var errorSlika4= document.getElementById("errorSlika4");
var errorSlika5= document.getElementById("errorSlika5");
*/

var check=false;
function ValidacijaForme()
{
	
	//provjeraMjestoOpcina();
	return (validacijaImena("ime") && validacijaPrezimena("prezime") && check && validacijaTelefona ("tel") && validacijaPoruke("tekst"));
}
function validacijaImena(id)
{
	var ime= document.getElementById(id);
	var imeV= document.getElementById(id).value;
	var errorElement= document.getElementById("imeError")
	if (imeV.length>10 || imeV.length<3) 
	{
		errorSlika.style.visibility = "visible";
        prikaziPoruku(false,"Predugo/prekratko ime!", errorElement); 
		return false;
    }
	else if (imeV.length==0)
	{
		errorSlika.style.visibility = "visible";
		return prikaziPoruku(false,"Morate unijeti ime!", errorElement);
	}
	else 
	{		
		errorSlika.style.visibility = "hidden";
		return prikaziPoruku(true,"", errorElement);
	}
}

function validacijaPrezimena(id)
{
	var prezime= document.getElementById(id);
	var prezimeV= document.getElementById(id).value;
	var errorElement= document.getElementById("prezimeError");
	if (prezimeV.length==0)
	{
		errorSlika1.style.visibility = "visible";
		return prikaziPoruku(false,"Morate unijeti prezime!", errorElement);
		
	}
	else 
	{
		errorSlika1.style.visibility = "hidden";
		return prikaziPoruku(true,"", errorElement);
	}
}

function validacijaPoruke(id)
{
	var poruka= document.getElementById(id);
	var porukaV= document.getElementById(id).value;
	var errorElement= document.getElementById("txtError");
	if (porukaV.length==0)
	{
		errorSlika10.style.visibility = "visible";
		return prikaziPoruku(false,"Morate unijeti tekst!", errorElement);
		
	}
	else 
	{
		errorSlika10.style.visibility = "hidden";
		return prikaziPoruku(true,"", errorElement);
	}
}
function provjeraMjestoOpcina()
{
    var opcina = document.getElementById("opcina").value;
	opcina=encodeURIComponent(opcina);
	var mjesto = document.getElementById("mjesto").value;
	mjesto=encodeURIComponent(mjesto);
    var errorElementOpcina= document.getElementById("opcinaError");
    var errorElementMjesto= document.getElementById("mjestoError");	
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
			var provjera=JSON.parse(ajax.responseText);
			if(provjera.greska=="Nepostojeća općina")
			{
			 errorSlika4.style.visibility = "visible";
			 check=false;
			 return prikaziPoruku(false,"Nepostojeća općina!", errorElementOpcina);
			}
			if(provjera.greska=="Nepostojeće mjesto")
			{
			 errorSlika5.style.visibility = "visible";
			 check=false;
			 return prikaziPoruku(false,"Nepostojeće mjesto!", errorElementMjesto); 
			}
			if(provjera.greska=="Mjesto nije iz date općine")
			{
			 errorSlika5.style.visibility = "visible";
			 check=false;
			 return prikaziPoruku(false,"Mjesto nije iz date općine", errorElementMjesto); 
			}
			if(provjera.ok=="Mjesto je iz date općine")
			{
			 check=true;
			 errorSlika4.style.visibility = "hidden";
			 errorSlika5.style.visibility = "hidden";
			 
			 errorElementOpcina.innerHTML="";
			 errorElementMjesto.innerHTML="";
			}
		}    
		/*if (ajax.readyState == 4 && ajax.status == 404)
        {
            alert("Nepostojeca stranica!")
        }*/
	}
	console.log(check);
    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/mjesto_opcina.php?opcina="+opcina +"&mjesto=" + mjesto, true);
	ajax.send();
}
function validacijaMjesta(id)
{
	
	var errorElement= document.getElementById("mjestoError");
	if (document.getElementById(id).value.length==0)
	{
		errorSlika5.style.visibility = "visible";
		return prikaziPoruku(false,  "Morate unijeti mjesto!", errorElement);
	}
	else 
	{
		errorSlika5.style.visibility = "hidden";
		return prikaziPoruku(true, "", errorElement);
	}
}
function validacijaOpcine(id)
{
	var errorElement= document.getElementById("opcinaError");
	if (document.getElementById(id).value.length==0)
	{
		errorSlika4.style.visibility = "visible";
		return prikaziPoruku(false, "Morate unijeti opcinu!", errorElement);
		
	}
	else 
	{
		errorSlika4.style.visibility = "hidden";
		return prikaziPoruku(true, "", errorElement);
	}
}

function validacijaMaila(id)
{
	var mail= document.getElementById(id);
	var errorElement= document.getElementById("mailError");
	var mailRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if (!mailRegex.test(document.getElementById('forma')[id].value)) 
	{  
        errorSlika2.style.visibility = "visible";
		return prikaziPoruku(false, "Mail format: nekoime@nesto.com", errorElement);
	}
	else 
	{
		errorSlika2.style.visibility = "hidden";
		return prikaziPoruku(true, "", errorElement);
	}
}

function validacijaTelefona(id)
{
	var telefon= document.getElementById(id);
	var errorElement= document.getElementById("telError");
	var telefonRegEx = /^\(?(\d{3})\)?[-]?(\d{3})[-]?(\d{3})$/;
	if (!telefonRegEx.test(document.getElementById('forma')[id].value))
		{  
			errorSlika3.style.visibility = "visible";
			return prikaziPoruku(false,"Telefon format: (061)-123-345 ili 061-123-456 ili 061123456<br>", errorElement);
		}
	else 
	{
		errorSlika3.style.visibility = "hidden";
		return prikaziPoruku(true, "", errorElement);
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

//meni, podmeni

var lastRef;

function prikazi(ref)
{
	var meni=ref.children[1];
	if (meni.style.display=="block")
	{
		meni.style.display="none";
	}
	else
	{
		meni.style.display="block";
	}
	if(lastRef!=null && lastRef!=ref)
	{
		var meni1=lastRef.children[1];
		meni1.style.display="none";
		
	}
	lastRef=ref;	
}
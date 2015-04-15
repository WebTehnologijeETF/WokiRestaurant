window.onload= inicijalizacija;

var errorSlika= document.getElementById("errorSlika");
var errorSlika1= document.getElementById("errorSlika1");
var errorSlika2= document.getElementById("errorSlika2");
var errorSlika3= document.getElementById("errorSlika3");

function inicijalizacija()
{
	document.getElementById("ime").focus();
	document.getElementById("forma").onsubmit=ValidacijaForme;
	document.getElementById("opcija").onchange=crossProvjera;
}

function ValidacijaForme()
{
	return (validacijaImena("ime") && validacijaPrezimena("prezime") && validacijaMaila("email") && validacijaTelefona ("tel"));
}
function validacijaImena(id)
{
	var ime= document.getElementById(id);
	var imeV= document.getElementById(id).value;
	var errorElement= document.getElementById("imeError")
	if (imeV.length>10 || imeV.length<3) 
	{
		errorSlika.style.visibility = "visible";
        prikaziPoruku(false, ime, "Predugo/prekratko ime!", errorElement); 
		return false;
    }
	else if (imeV.length==0)
	{
		errorSlika.style.visibility = "visible";
		return prikaziPoruku(false, ime, "Morate unijeti ime!", errorElement);
	}
	else 
	{		
		errorSlika.style.visibility = "hidden";
		return prikaziPoruku(true, ime, "", errorElement);
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
		return prikaziPoruku(false, prezime, "Morate unijeti prezime!", errorElement);
		
	}
	else 
	{
		errorSlika1.style.visibility = "hidden";
		return prikaziPoruku(true, prezime, "", errorElement);
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
		return prikaziPoruku(false, mail, "Mail format: nekoime@nesto.com", errorElement);
	}
	else 
	{
		errorSlika2.style.visibility = "hidden";
		return prikaziPoruku(true, mail, "", errorElement);
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
			return prikaziPoruku(false, telefon, "Telefon format: (061)-123-345 ili 061-123-456 ili 061123456<br>", errorElement);
		}
	else 
	{
		errorSlika3.style.visibility = "hidden";
		return prikaziPoruku(true, telefon, "", errorElement);
	}
}
function prikaziPoruku(isValid, inputElement, errorMsg, errorElement) {
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

function crossProvjera()
{
	var range= document.getElementById("range");
	var opcija= document.getElementById("opcija");
	if(opcija.options[opcija.selectedIndex].text=="Kritika" || opcija.options[opcija.selectedIndex].text=="Sugestija" )
		range.disabled=false;
	else range.disabled=true;
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
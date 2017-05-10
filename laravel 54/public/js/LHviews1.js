

HTMLCollection.prototype.foreach=function(aInFc1)
{
	for(var i1=0; i1<this.length; i1++){
		aInFc1(this[i1], i1, this);
	}
	return 0;
}

function fAOnClUpravit1(aDatum1, aMod2)
{
	var RR1 = document.getElementById("trIDRadek1_"+aDatum1);
	var R1 = RR1.getElementsByTagName("td");
	var R2  =document.getElementById("FoGetIDFormular1");

	R2[1].value = R1[0].innerHTML.replace(" ","T");
	R2[2].value = R1[1].innerHTML;
	R2[3].value = R1[2].innerHTML;
	R2[4].value = R1[3].innerHTML;
	R2[6].value = R1[0].innerHTML.replace(" ","T");
	R2[7].value = "UPRAVIT";

	switch(aMod2){
	case 2:
		//nastavení modu
		R2[5].value="2";
		
		//přemazání background-color včech řádků
		document.getElementsByTagName("tr").foreach(function(e1){e1.style.backgroundColor = "rgb(255, 255, 255)";});
		
		//nastavení barvy editovaneho formuláře
		RR1.style.backgroundColor = "rgb(255, 0, 0)";
		break;
	case 3:
		//nastavení modu
		R2[5].value="3";
		
		//odesláni formuláře
		R2.submit();
		break;
	}

}




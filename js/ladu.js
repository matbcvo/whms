$(function() {
	$( "#varuosa-nimetus-input" ).autocomplete({
		minChars: 1,
		source: 'autocomplete.php?s=varuosad'
    });
	$( "#uussoiduk-mudel-input" ).autocomplete({
		minChars: 1,
		source: 'autocomplete.php?s=uussoiduk-mudel'
    });
	
	
	
});

function varuosadeotsing() {
		var str = "";
		str = $('#varuosadeotsing-input').val();
		if (str == "") {
			document.getElementById("varuosadeotsing_tulemus").innerHTML = "Viga! Otsingusõna sisestamata.";
			return;
		} else { 
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp = new XMLHttpRequest();
			} else {
				// code for IE6, IE5
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("varuosadeotsing_tulemus").innerHTML = this.responseText;
				}
			};
			xmlhttp.open("GET","vo_otsing.php?q="+str,true);
			xmlhttp.send();
		}
	}
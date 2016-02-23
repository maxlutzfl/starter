<script>
console.log('asefasef');
alert('asefasefaes');
	function submitForm(id) {
		var formId = document.getElementById(id);
		var form = formId.querySelector('form');
		var elem = form.elements;
		var url = form.action;        
		var params = "";
		var value;

		for (var i = 0; i < elem.length; i++) {
		    if (elem[i].tagName == "SELECT") {
		        value = elem[i].options[elem[i].selectedIndex].value;
		    } else {
		        value = elem[i].value;                
		    }
		    params += elem[i].name + "=" + encodeURIComponent(value) + "&";
		}

		console.log(params);

		if (window.XMLHttpRequest) {
		    // code for IE7+, Firefox, Chrome, Opera, Safari
		    var xmlhttp=new XMLHttpRequest();
		} else { 
		    // code for IE6, IE5
		    var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}

		// xmlhttp.open("POST",url,false);
		xmlhttp.open("GET","<?php echo home_url(); ?>/wp-content/plugins/brandco-contact-forms/send.php",true);
		// xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		// xmlhttp.setRequestHeader("Content-length", params.length);
		// xmlhttp.setRequestHeader("Connection", "close");
		// xmlhttp.send(params);
		// console.log(xmlhttp.responseText);
		return xmlhttp.responseText;
	}
	
</script>
//Function checking if the browser accepts the XMLHTTPRequest object
function objet_XMLHttpRequest()
{
	var mavariable = null;
	
	//Test of the browser
	if (window.XMLHttpRequest || window.ActiveXObject){
		// if intenet explorer, we test activeX
		if(window.ActiveXObject){
			// We test if it is IE7 or more
			try{
			mavariable = new ActiveXObject("Msxml2.XMLHTTP");
			}
			// otherwise it's IE6 or less
			catch(e){
			mavariable = new ActiveXObject("Microsoft.XMLHTTP");
			}
		}
		//Recent browser (chrome, firefox, ...)
		else{
			mavariable = new XMLHttpRequest();
		}
	}
	//XMLHttpRequest isn't accepted by the browser
	else{
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return mavariable;
}

function teste_ajax(){
 
	var mavariable = objet_XMLHttpRequest();
	 
	//Recuperation of data 
	var pseudo = encodeURIComponent( login);
	var message = encodeURIComponent( document.getElementById("saisie").value);
			
	//if the login is empty, we highlight a error 
	if(pseudo == ''){
		alert('Pseudo vide!');
		return false; // End of the function
	}
	//if the message is empty, we highlight a error 
	if(message == ''){
		alert('Message vide!');
		return false;
	}

	// We assign a function to the onreadystatechange attribute
	mavariable.onreadystatechange = function(){
			if( mavariable.readyState == 4 && mavariable.status == 200){
			// We empty the field saisie
			document.getElementById("saisie").value='';
		}
	};

	//Declaration of a sending method
	mavariable.open("POST","traitement.php",true);
	mavariable.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
	// We send 
	mavariable.send("pseudo="+pseudo+"&saisie="+message);
}

// function which insert tag to put smileys or text in italic, bold or underlined
function insertTag(startTag, endTag) 
{
	var field  = document.getElementById("saisie"); // We get the text area
	var scroll = field.scrollTop;                     // Memorization of the scroll's position
	field.focus();
	
	// beginning of the selection 
	var startSelection   = field.value.substring(0, field.selectionStart);
	var currentSelection = field.value.substring(field.selectionStart, field.selectionEnd);
	// end of the selection
	var endSelection     = field.value.substring(field.selectionEnd);
			
	field.value = startSelection + startTag + currentSelection + endTag + endSelection;
	field.focus();
	field.setSelectionRange(startSelection.length + startTag.length, startSelection.length + startTag.length + currentSelection.length);

	field.scrollTop = scroll;
}

// repositionning of the scroll bar
function go_bottom()
{
	elt = document.getElementById("texte");
	element.scrollTop = element.scrollHeight;
}

//Function which refresh the div "texte" 
function refresh()
{
	var xhr = objet_XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			document.getElementById("texte").innerHTML = xhr.responseText;
		}
	};
	
	xhr.open("GET","tchat.php", true);
	xhr.send( null);
	
	
}

 

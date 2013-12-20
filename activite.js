// Initialization of variables 
var activite_detectee = false;
var intervalle = 100;
var temps_inactivite = 0;
var inactivite_persistante = true;
var deco = false;

// Function which test the inactivity
function testerActivite() {

	var mavariable = objet_XMLHttpRequest();
	
  // We test if a activity is detected 
     if(activite_detectee) {
       activite_detectee = false;
       temps_inactivite = 0;
       inactivite_persistante = false;
     }
     else {
	// The inactivity go on and we calculate the inactivity time  
       if(inactivite_persistante) {
		   
         temps_inactivite += intervalle;
         // If the inactivity time exceed 1 000 secondes, the user is disconnected
         if(temps_inactivite >=  1 000 000)
			{				
				window.location.replace("deconnexion.php");			
			}
		   
       }
       else
         inactivite_persistante = true;
     }
	 
	 
  // We restart the function
  setTimeout('testerActivite();', intervalle);
}

// We launch the function a first time at the load of the page
setTimeout('testerActivite();', intervalle);









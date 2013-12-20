<?php
	/* elimination of the cache */
	header("Cache-Control: no-cache");
	
	$fichier = "tchat.txt";
	
	
	// conversion of $fichier in a array
	$lines = file($fichier);
	
	// Displaying of the file
	foreach($lines as $line)
	{
		echo($line);
		echo "<br>";
	}
?>

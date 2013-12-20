<?php
	session_start();
	
	$login = $_SESSION['login'];
	
	/* suppression of html interpretation */
	$message = (isset($_POST['saisie'])) ? htmlspecialchars($_POST['saisie']) : NULL;
	$date = "[".date("d-m-Y")."] ";
	$heure = "  ".date("H:i")."  ";
	// bold
	$message = preg_replace('`\[g\](.+)\[/g\]`', '<b>$1</b>', $message); 
	//italic
	$message = preg_replace('`\[i\](.+)\[/i\]`', '<i>$1</i>', $message);
	//underline
	$message = preg_replace('`\[s\](.+)\[/s\]`', '<u>$1</u>', $message);
	// Substitution of smiley by "real" smiley */
	$message = str_replace(':)', '<img src="images/sourire.png" title="smiley" alt="smiley" />', $message);
	$message = str_replace(':D', '<img src="images/rigole.png" title="smiley" alt="smiley" />', $message);
	$message = str_replace(';)', '<img src="images/clin.png" title="smiley" alt="smiley" />', $message);
	$message = str_replace(':p', '<img src="images/langue.png" title="smiley" alt="smiley" />', $message);
	$message = str_replace(':L', '<img src="images/sourire.png" title="smiley" alt="smiley" />', $message);
		
	 
	// creating of a variable containing a name file */
	$fichier = "tchat.txt";
	 
	// opening of the file "tchat.txt". If it doesn't exist, it will be created 
	$fichier_a_ouvrir = fopen ($fichier, "a+");
	//writing in the file of the message
	fwrite($fichier_a_ouvrir, $date.$heure.$login.' : '.$message."\r\n" );

	// closing of the file
	fclose ($fichier_a_ouvrir);
	 
?>

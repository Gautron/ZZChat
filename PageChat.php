<?php
	session_start();
	
	/* Memorization of login in a cookie (during one week) */
	setcookie('pseudo', $_SESSION['login'] , time() + 7*24*3600, null, null, false, true);
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<title> ! ZZChat !</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	
	
	 <!-- Call of the CSS page -->
	<link rel="stylesheet" media="screen" type="text/css" href="PageChat.css" />
	
	 <!-- Call of the javascript page : fonction.js -->
	<script type="text/javascript" src="fonctions.js"></script>
	
	<script type="text/javascript">
		login = "<?php echo $_SESSION['login'];?>"; <!-- variable globale to get the login in fonction.js -->
	</script>
	
	<!-- Call of the javascript page : activite.js -->
	<script type="text/javascript" src="activite.js"></script> 
	
	<!-- Use of a jquery library -->
	<script src="jquery-2.0.0.min.js"></script>
	<script src="jquery.mCustomScrollbar.concat.min.js"></script>
	<link href="jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />

	</head>
	<!-- javascript functions which reload regularly the page and detect a inactivity -->
	<body onload='setInterval("refresh()", 1000);' onkeydown="activite_detectee = true;statut('actif');" onmousemove="activite_detectee = true;statut('actif');"> 
		
		<!-- Displaying of a welcome message -->
		<?php if($_SESSION['env'] == "en")
			{	?>
		<script>
		alert(" Hello <?php echo $_SESSION['login']; ?>");
		</script>
		<?php }
		else{ ?>  
		<script>
		alert(" Bonjour <?php echo $_SESSION['login']; ?>");
		</script>		
		<?php } ?>
		
		
	<div id="fond"> 
		<div class="ruban">     
			<h2><?php echo "ZZ Chat";?> </h2>     
		</div>     
		<div class="ruban_gauche">
		</div>
		<div class="ruban_droit">
		</div>
	</div>	
	
	
	
	<!-- Call of traitement.php without reloaded the whole page -->
	<form action="traitement.php" method="post" onsubmit="teste_ajax(); return(false);"   > 

	<!-- Buttons to write smiley or put in bold, italic or underlined -->
    <div id="smiley">
	<img src="images/sourire.png" onclick="insertTag(':)','');"/>
    <img src="images/clin.png" onclick="insertTag(';)','');"/>
	<img src="images/langue.png" onclick="insertTag(':p','');"/>
    <img src="images/rigole.png" onclick="insertTag(':D','');"/>
    <img src="images/hihi.png" onclick="insertTag(':L','');"/>
    <input type="button" value="G" onclick="insertTag('[g\]','[/g\]');"/>
	<input type="button" value="I" onclick="insertTag('[i\]','[/i\]');"/>
	<input type="button" value="U" onclick="insertTag('[s\]','[/s\]');"/>
    </div>
    
		<!-- Location to write the message-->
		<input type="text" id="saisie" name="saisie" placeholder= <?php 
			if($_SESSION['env'] == "en")
			{	?> "Enter a message" <?php }
			else{ ?> "Entrer votre message" <?php } ?> value=" " /><br/>
		<!-- Button to send the message -->
		<input class="boutonENV" type="submit" value=<?php 
			if($_SESSION['env'] == "en")
			{	?> "Send message"<?php }
			else{ ?> "Envoyer message" <?php } ?> ><br/>
	</form>
	
	<!-- It is supposed to put the scroll bar at down to see the last message but it doesn't work -->
	<div id="texte" onFocus="go_bottom();">
	</div>
	
	<?php
			/* Normaly delete what is contained in "tchat.txt" if it is too big (but it doesn't work and we don't know why) */
			
			/*$fictext = fopen("tchat.txt","rw");
			$octet = filesize($fictext);
			if ($octet > 200 000)
			{
				ftruncate($fictext,0); 
			}
			fclose($fictext);*/
	?>
		
	<div id="utilisateurs" >
		
		<?php
			/* Displaying of connected users */		
			global $ficLog;
			$ficLog = fopen("Liste_Log.txt","r");
			
			while (!feof($ficLog))
			{
				$tab = fgets($ficLog);
				echo $tab; 
				echo "<br>";
			}
			fclose($ficLog);
		?> 

	</div>
	
	
	<!-- Button to disconnect the user -->
	<a href="deconnexion.php"><button id = "boutonDeconnexion" class="btn btn-default"> <?php 
			if($_SESSION['env'] == "en")
			{	?> Sign out<?php }
			else{ ?> Deconnexion <?php } ?> </button></a>
	
	</body>
</html> 

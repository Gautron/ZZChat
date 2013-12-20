<?php
	session_start();

?>

<!DOCTYPE html>
<html>
	<head>
	<title> ! ZZChat !</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />
	 
	 <!-- Call of the CSS page -->
	<link rel="stylesheet" media="screen" type="text/css" href="ZZChat.css" />
	
	</head>
	<body>
	
	
			
	
	<?php
	
		/* Initialization of the variable "env" */
		if( !isset( $_SESSION['env']))
		{
			$_SESSION['env'] = "fr";
		}
		
		/* Transition to a SESSION variable */
		if( isset( $_GET['env']))
			$_SESSION['env'] = $_GET['env'];
			
		/* Displaying of messages in the right language in function of "env" */
		if($_SESSION['env'] == "en")
		{	
			$message1 = "Saloon ZZ Chat :";
			$message2 = "Login :";
			$message3 = "Sign in";
			$message4 = "Please enter a login";
			$message5 = "login already taken";
			$message6 = "Wrong login : forbidden character";
			$message7 = "System error";
		}
		else
		{
			$message1 = "Salon ZZ chat :";
			$message2 = "Pseudo :";
			$message3 = "Se connecter";
			$message4 = "Veuillez taper un login";
			$message5 = "Pseudo déjà pris";
			$message6 = "Mauvais login : caractère(s) interdit(s)";
			$message7 = "Erreur système";
		}
		
		
	?>
	
	<!-- Presentation -->
	<div id="fond"> 
      <div class="ruban">     
        <h2><?php echo $message1;?> </h2>     
      </div>     
      <div class="ruban_gauche"></div>
      <div class="ruban_droit"></div>
	</div>
	
	<!-- Form with validation button and cookie to propose the last pseudo what you have used -->
	<div id="formContainer" >
            <form id="formlogin" method="post" action="verif.php">
   
                <input type="text" name="login" id="login" value= <?php
				if(isset($_COOKIE['pseudo'])){ echo $_COOKIE['pseudo']; }else{  echo $message2; } ?>  />
                <input type="submit" class="btn btn-default" name="button" value="<?php echo $message3;?>" />
            </form>
            
    </div>
	<?php
	
	/* Checking of the existence of "error" sent by verif.php */
	$error = 0;
	if( isset( $_GET['error']))
		$error = $_GET['error'];
	
	/* displaying of error message */
	if($error == 1){ ?>
<script>
alert("<?php echo $message4; ?>");
</script>
	<?php }else if($error == 2){ ?>
<script>
alert("<?php echo $message5; ?>");
</script>
	<?php }else if($error == 3){ ?>
<script>
alert("<?php echo $message6; ?>");
</script>	
	<?php }else if($error == 4){ ?>
<script>
alert("<?php echo $message7; ?>");
</script>
	<?php } ?>
	
	<!-- Link (flag) to change the language -->
	<a id="uk" href="ZZchat.php?env=en"> <img src="images/uk.png" width="48" height="48"/> </a>
	<a id="fr" href="ZZchat.php?env=fr"> <img src="images/fr.png" width="48" height="48" /> </a>
	</body>
</html> 


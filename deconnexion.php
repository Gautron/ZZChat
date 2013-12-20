<?php
	session_start();
	
	/* Function which suppress a login in "Liste_Log.txt" */
	function suppressionLogin($loginASupprimer) 
	{	 
		/* conversion of "Liste_Log.txt" in a array */			
		$monlog = file("Liste_Log.txt");
		$i = 0;
		
		/* initialization of a string which will contain all the login except $loginASupprimer */
		$txtlogfinal = "";
		
		while( isset($monlog[$i]))				
		{
			/* If the login isn't the login to disconnect, we add it in the string */
			if( $monlog[$i] != $loginASupprimer . "\n")
			{
				$txtlogfinal .= $monlog[$i];
			}				
			$i++;
		}	
		
		/* Opening of "Liste_Log.txt" */		
		$monlog = fopen("Liste_Log.txt","w");
		
		/* We write the string in "Liste_Log.txt" */
		fputs( $monlog, $txtlogfinal);
		fclose( $monlog);
							
	}
	/* recuperation of login to disconnect him */
	$loginASupprimer = $_SESSION['login'];
	/* suppression of the login in "Liste_Log.txt" */
	suppressionlogin($loginASupprimer);
	/* we close the session */
	session_destroy();
	/* User is resent at the homepage */
	header("Location: ZZchat.php");
?>

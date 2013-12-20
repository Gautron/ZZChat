<?php

	/* Starting of the session */
	session_start();
	
	/* Recuperation login and blocking of HTML interpretation */
	$login = htmlspecialchars($_POST['login']);	
	
	/* Suppression of blank at the beginning and at the end of the login */
	$login = trim($login);
	
			
	
	if(isset($login))
	{
		$verifValue = NULL;
		
			

		
			function verifLog($l) 
			{
					/* Opening of "Liste_Log.txt" */
					global $ficLog;
					$ficLog = fopen("Liste_Log.txt","r");
					$ret =0;
					$oldlogin = $l;
					
					/* Suppression of forbidden character */
					$l = str_replace(CHR(32),"", $l);
					$l = str_replace("$","",$l);
					$l = str_replace("\\","", $l);
					$l = str_replace("/","",$l);
					$l = str_replace("#","", $l);
					$l = str_replace("&","",$l);
					
					
					
					if(strlen($l) < strlen($oldlogin)) /* That means there are forbidden characters in login*/
					{
						$ret = 2;
					}
					else
					{
						if ( $ficLog )
						{					
							while ( (!feof($ficLog)) && $ret == 0)
							{
								$tab = fgets($ficLog); /* recuperation of a line of "Liste_Log.txt" */
			
		
								if ( strlen($tab) > strlen($l) )
								{
									$nbChar = strlen($tab) - 1; /* Because of the \0 at the end */
								}else
								{
								
									$nbChar = strlen($l);
								}
								
								
								if ( strncmp($tab,$l,$nbChar) == 0) /* Comparison of the line of Liste_Log.txt and the login */
								{
									$ret = 1;
																	
								}
							}
						}
					}
					fclose($ficLog);
					return $ret;
			}
			
			function LogRegister($l)
			{
				/* Opening of "Liste_Log.txt" */
				global $ficLog;
				$ficLog = fopen("Liste_Log.txt","a");
				$ret=0;
				
				if ( $ficLog )
				{
					/* Writing of the new login in "Liste_log.txt" */
					fputs($ficLog, $l);
					fputs($ficLog, "\n");
				}
				else
				{
					$ret = 1;
				}
				fclose($ficLog);
			return $ret;
			}
			
			
			
			if(empty($login))
			{
			    /* User is resent on the same page con a error message */
				header("Location: ZZchat.php?error=1");
				exit();

			}else
			{
				/* verification of login */
				$verifValue = verifLog($login);
				switch ($verifValue)
				{
					case 0:
					/* the login is right so it is written in "Liste_log.txt" */
					$retReg = LogRegister($login);
					if ( $retReg == 1)
					{
						echo ("Erreur Systeme\n");
					
					}
					
					/* login is recorded in a SESSION variable and sent on the second page  */
					$_SESSION['login'] = $login; 
					header("Location: PageChat.php?login=$login");
						
						
						break;
					case 1: /* other case : User is resent on the same page con a error message */
						header("Location: ZZchat.php?error=2");
						break;
					case 2:
						header("Location: ZZchat.php?error=3");
						break;
					default:
						header("Location: ZZchat.php?error=4");
					
				}
			}	
	}
		
?>

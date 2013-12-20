<?php
			function verifLog($l) 
			{
					global $ficLog;
					$ficLog = fopen("Liste_Log.txt","r");
					$ret =0;
					$oldlogin = $l;
					$l = str_replace(CHR(32),"", $l);
					
					if(strlen($l) < strlen($oldlogin))
					{
						$ret = 2;
					}
					else
					{
						if ( $ficLog )
						{					
							while ( (!feof($ficLog)) && $ret == 0)
							{
									/* supprimer les espace */						
								$tab = fgets($ficLog); 
			
		
								if ( strlen($tab) > strlen($l) )
								{
									$nbChar = strlen($tab) - 1; /* A cause du zero de fin */
								}else
								{
								
									$nbChar = strlen($l);
								}
								
								
								if ( strncmp($tab,$l,$nbChar) == 0) /* on compare avec le login rentré par l'utilisateur */
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
				global $ficLog;
				$ficLog = fopen("Liste_Log.txt","a");
				$ret=0;
				
				if ( $ficLog )
				{
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
?>

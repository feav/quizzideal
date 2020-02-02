<?php
	include('./requiert/php-global.php');

	if (!empty($_POST['submit']))
	{
		if ($banniT == 0)
		{
			$message = htmlspecialchars(addslashes($_POST['message']));

			if (!empty($message))
			{			
				$pdo->exec("INSERT INTO tchat (time,idUser,message,date) VALUES (NOW(),'".$mbreHashId."','".$message."','".date('d/m/Y à H:i')."')");
				echo '';
			} else {
				echo '';
			}
		}
		else {
			echo '';
		}
	}
?>
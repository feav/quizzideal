<?php
			function data($longueur) {
				$chaine_code = '';
				$chaine = "123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopqsdfghjklmwxcvbn";
				for ($i = 0; $i < $longueur; $i++) {
					$chaine_code .= substr($chaine, (rand() % (strlen($chaine))), 1);
				}
				return $chaine_code;
			}
?>
<?php

// Début : Inscription
if (!empty($_POST['nom'])): $post_reg_nom = ucfirst(addslashes(htmlentities($_POST['nom'])));
else: $post_reg_nom = null;
endif;
if (!empty($_POST['prenom'])): $post_reg_prenom = ucfirst(addslashes(htmlentities($_POST['prenom'])));
else: $post_reg_prenom = null;
endif;
if (!empty($_POST['email'])): $post_reg_email = strtolower(addslashes(htmlentities($_POST['email'])));
else: $post_reg_email = null;
endif;
if (!empty($_POST['password'])): $post_reg_mdp = addslashes(htmlentities($_POST['password']));
else: $post_reg_mdp = null;
endif;
if (!empty($_POST['news'])): $post_reg_news = addslashes(htmlentities($_POST['news']));
else: $post_reg_news = null;
endif;
if (!empty($_POST['idParrain'])): $post_idParrain = addslashes(htmlentities($_POST['idParrain']));
else: $post_idParrain = null; 
endif;

if (!empty($_POST["submit_register"])) {
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["captcha"])) {
        if (preg_match("!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!", $post_reg_email)) {
            $sql_RegCount = $pdo->query("SELECT COUNT(id) as 'total' FROM users WHERE email = '" . $post_reg_email . "'");
            $dns_RegCount = $sql_RegCount->fetch(PDO::FETCH_ASSOC);
            $nb_RegCount = addslashes(htmlentities($dns_RegCount['total']));

            if ($nb_RegCount == 0) {
                if ($_POST['captcha'] == $_POST['captchaVerif']) {
                    $reponsConfirm = 'Bravo, vous êtes maintenant inscrit ! Un e-mail de confirmation vous a été envoyé.';
                    $button = '"Fermer"';

                    $pdo->exec("INSERT INTO `users` (`id`, `hashId`, `email`, `mdp`, `nom`, `prenom`, `pays`, `ip`, `idParrain`, `news`) VALUES ('', '" . code(25) . "', '" . $post_reg_email . "', '" . sha1(md5($post_reg_mdp)) . "', '" . $post_reg_nom . "', '" . $post_reg_prenom . "', '" . $country_code . "', '" . ip . "', '".$post_idParrain."', '" . $post_reg_news . "')");

                    $message = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
								<html>
								<head>
									<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
								</head>
								<body><div style="font-family:arial;font-size:12px;">
									Bonjour ' . $post_reg_prenom . ',<br/><br/>

									Merci de votre inscription sur ' . ucfirst(nom_site) . ' !<br/><br/>
									
									Afin de pouvoir vous connecter, nous vous invitons à cliquer ou de copier/coller le lien de confirmation suivant dans votre barre de navigation.<br/><br/>
									
									Lien de confirmation : <a href="' . url_site . '/index.html?confirm=1&userEmail=' . $post_reg_email . '&token=' . sha1(md5($post_reg_mdp)) . '" title="" target="_blank">' . url_site . '/index.html?confirm=1&userEmail=' . $post_reg_email . '&token=' . sha1(md5($post_reg_mdp)) . '</a><br/><br/>
									
									<strong><u>Vos données de connexion sont les suivantes :</u></strong><br/><br/>
									<strong>Adresse e-mail :</strong> ' . $post_reg_email . '<br/>
									<strong>Mot de passe :</strong> ' . $post_reg_mdp . '<br/><br/>
									
									&Agrave; bientôt sur ' . ucfirst(nom_site) . ' !
								</div></body></html>';

                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
                    $headers .= "From : " . ucfirst(nom_site) . " <support@" . nom_site . ">\n";
                    $headers .= "Reply-To: " . ucfirst(nom_site) . " <support@" . nom_site . ">\n";

                    mail($post_reg_email, '' . ucfirst(nom_site) . ' : Confirmation d\'inscription', $message, $headers);

                    $post_reg_nom = null;
                    $post_reg_prenom = null;
                    $post_reg_email = null;
                } else {
                    $reponsError = 'Le Captcha entré est incorrect.';
                    $button = '"Fermer"';
                }
            } else {
                $reponsError = 'Cette adresse e-mail est déjà inscrite.';
                $button = '"Fermer"';
            }
        } else {
            $reponsError = 'L\'adresse e-mail entrée est incorrecte.';
            $button = '"Fermer"';
        }
    } else {
        $reponsError = 'Tout les champs sont requis pour votre inscription.';
        $button = '"Fermer"';
    }
}
// Fin : Inscription
// Début : Connexion
if (!empty($_POST['email'])): $post_log_email = addslashes(htmlentities($_POST['email']));
else: $post_log_email = null;
endif;
if (!empty($_POST['mdp'])): $post_log_mdp = addslashes(htmlentities($_POST['mdp']));
else: $post_log_mdp = null;
endif;
if (!empty($_POST['captcha'])): $post_log_captcha = addslashes(htmlentities($_POST['captcha']));
else: $post_log_captcha = null;
endif;

if (!empty($_POST["submit_login"])) {
    if (empty($_POST['email']) OR empty($_POST['mdp']) OR empty($_POST['captcha'])) {
        $reponsError = 'Vous devez remplir tous les champs.';
        $button = '"Fermer"';
    } else {
        if (isset($_SESSION['id'])) {
            $reponsError = 'Désolé mais vous êtes déjà connecté.';
            $button = '"Fermer"';
        } else {
            $req = $pdo->prepare('SELECT id, email, mdp, actif, banni, datelastco FROM users WHERE email=:email');
            $req->bindValue(":email", $_POST['email']);
            $req->execute();

            $result_req = $req->fetch(PDO::FETCH_OBJ);

            if (empty($result_req)) {
                $reponsError = 'Les identifiants entrés ne sont pas correct.';
                $button = '"Fermer"';
            } else {
                if ($result_req->actif == 1) {
                    if ($result_req->banni == 0) {
                        if ($result_req->mdp == sha1(md5($_POST['mdp']))) {
                            if ($_POST['captcha'] == $_POST['captchaVerif']) {

                                $sql = "SELECT idUser,email,ip FROM users_infos WHERE idUser = {$result_req->id}";
                                $req = $pdo->query($sql);
                                $res = $req->fetch(PDO::FETCH_ASSOC);
                                if($res != NULL){
                                    $_SESSION['email_offre'] = $res['email'];
                                    $_SESSION['ip'] = $res['ip'];
                                }

                                $_SESSION['id'] = $result_req->id;
                                $_SESSION['email'] = $result_req->email;

                                $reponsConfirm = 'Connexion en cours, veuillez patienter...';
                                $button = 'false';
                                if ($result_req->datelastco != date('Y-m-d') && false) {
                                    $redirectionLogin = url_site . 'bonus.php';
                                } else {
                                    $redirectionLogin = 'accueil.php';
                                }
                                //$redirectionLogin = 'accueil.php';
                                $post_log_email = null;
                            } else {
                                $reponsError = 'Le Captcha entré est incorrect.';
                                $button = '"Fermer"';
                            }
                        } else {
                            $reponsError = 'Les identifiants entrés ne sont pas correct.';
                            $button = '"Fermer"';
                        }
                    } else {
                        $reponsBanni = 'Oups, il semble que vous avez été banni ! Redirection en cours...';
                        $button = 'false';
                        $redirectionLogin = url_site;
                        $post_log_email = null;
                    }
                } else {
                    $reponsError = 'Votre compte est inactif. Veuillez vérifier vos e-mails et confirmer votre inscription. (Contactez-nous si vous ne trouvez pas cet e-mail)';
                    $button = '"Fermer"';
                }
            }
        }
    }
}
// Fin : Connexion
// Début : Confirmation d'inscription
if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
    if (!empty($_GET['userEmail'])): $get_conf_email = addslashes(htmlentities($_GET['userEmail']));
    else: $get_conf_email = null;
    endif;
    if (!empty($_GET['token'])): $get_conf_token = addslashes(htmlentities($_GET['token']));
    else: $get_conf_token = null;
    endif;

    $sql_ValidAccount = $pdo->query("SELECT COUNT(id) as 'total' FROM users WHERE email = '" . $get_conf_email . "' AND mdp = '" . $get_conf_token . "' AND actif = 0");
    $dns_ValidAccount = $sql_ValidAccount->fetch(PDO::FETCH_ASSOC);
    $nb_RegCount = addslashes(htmlentities($dns_ValidAccount['total']));

    // get montant bonus inscription
    $bi = $pdo->query("SELECT inscription,ami FROM parrainage WHERE id=1");
    $mtt = $bi->fetch(PDO::FETCH_ASSOC);
    $bonusInscription = (float)$mtt['inscription'];
    $bonusParrainage = (float)$mtt['ami'];

    if ($nb_RegCount == 1) {
        $user = $pdo->query("SELECT * FROM users WHERE email = '" . $get_conf_email . "' AND mdp = '" . $get_conf_token . "' AND actif = 0");
        $user = $user->fetch(PDO::FETCH_ASSOC);
        // add bonus inscription
        $montant = (float)$user['euros'];
        $montant += $bonusInscription;
        $idParrain = (int)$user['idParrain'];

        //add bonus parrain
        if( $idParrain != 0){
            $parrain = $pdo->query("SELECT * FROM users WHERE id = {$idParrain}");
            $parrain = $parrain->fetch(PDO::FETCH_ASSOC);
            $montantParrain = (float)$parrain['euros'];
            $montantParrain += $bonusParrainage;
            $pdo->exec("UPDATE users SET euros = {$montantParrain} WHERE id = {$idParrain}");
        }

        $pdo->exec("UPDATE users SET actif = 1,euros = {$montant} WHERE email = '" . $get_conf_email . "' AND mdp = '" . $get_conf_token . "' AND actif = 0");

        $reponsConfirm = 'Votre compte a bien été validé, vous pouvez maintenant vous connecter.';
        $button = '"Fermer"';
    } else {
        $reponsError = 'Oups, une erreur est survenue !';
        $button = '"Fermer"';
    }
}
// Fin : Confirmation d'inscription

if (isset($reponsConfirm)) {
    ?>
    <script type="text/javascript">
        swal({
        text: "<?= $reponsConfirm; ?>",
                button: <?= $button; ?>,
                icon: "success",
                closeOnClickOutside: false,
                closeOnEsc: false,
        })<?php if (isset($redirectionLogin)) { ?>,
            setTimeout("window.location='<?= $redirectionLogin; ?>'", 3000);<?php } ?>
    </script>
    <?php
}

if (isset($reponsBanni)) {
    ?>
    <script type="text/javascript">
        swal({
        text: "<?= $reponsBanni; ?>",
                button: <?= $button; ?>,
                icon: "warning",
                closeOnClickOutside: false,
                closeOnEsc: false,
        })<?php if (isset($redirectionLogin)) { ?>,
            setTimeout("window.location='<?= $redirectionLogin; ?>'", 3000);<?php } ?>
    </script>
    <?php
}

if (isset($reponsError)) {
    ?>
    <script type="text/javascript">
        swal({
            text: "<?= $reponsError; ?>",
            button: <?= $button; ?>,
            icon: "error",
            closeOnClickOutside: false,
            closeOnEsc: false,
        });
    </script>
    <?php
}
?>
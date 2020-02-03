<?php



if (!empty($_POST['name'])): $name = ucfirst(addslashes(htmlentities($_POST['name'])));

else: $name = null;

endif;

if (!empty($_POST['first_name'])): $first_name = ucfirst(addslashes(htmlentities($_POST['first_name'])));

else: $first_name = null;

endif;

if (!empty($_POST['birth'])): $birth = strtolower(addslashes(htmlentities($_POST['birth'])));

else: $birth = null;

endif;

if (!empty($_POST['address'])): $address = addslashes(htmlentities($_POST['address']));

else: $address = null;

endif;

if (!empty($_POST['city'])): $city = addslashes(htmlentities($_POST['city']));

else: $city = null;

endif;

if (!empty($_POST['postal'])): $postal = addslashes(htmlentities($_POST['postal']));

else: $postal = null; 

endif;

if (!empty($_POST['email'])): $email = addslashes(htmlentities($_POST['email']));

else: $email = null;

endif;

if (!empty($_POST['phone'])): $phone = addslashes(htmlentities($_POST['phone']));

else: $phone = null; 

endif;

$reponsConfirm = "";

$idUser = $_POST['idUser'];

$ip = $_POST['ip'];



if(!empty($_POST['submit_infos'])){
	if(!empty($_POST['first_name']) && !empty($_POST['name']) && !empty($_POST['birth']) && !empty($_POST['address']) && !empty($_POST['city']) && !empty($_POST['postal']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['captcha'])){

			if(preg_match('!^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$!', $email)){

                if(preg_match('#^[0-9]+$#', $postal)){

                    if(preg_match('#^[0-9 ]+$#', $phone) && strlen($phone) >= 10){

                        $stmt = $pdo->query("SELECT COUNT(id) as 'total' FROM users WHERE email = '" . $email . "'");

                        $getEmail = $stmt->fetch(PDO::FETCH_ASSOC);

                        $getEmail = addslashes(htmlentities($getEmail['total']));

                        if($getEmail == 0){ 

                            $stmt = $pdo->query("SELECT COUNT(id) as 'total' FROM users_infos WHERE email = '" . $email . "'");

                            $res = $stmt->fetch(PDO::FETCH_ASSOC);

                            if($res != 0){

                                if($_POST['captcha'] == $_POST['captchaVerif']){

                                $datas = [

                                    'idUser' => $idUser,

                                    'name' => $name,

                                    'first_name' => $first_name,

                                    'birth' => $birth,

                                    'address' => $address,

                                    'city' => $city,

                                    'postal' => $postal,

                                    'email' => $email,

                                    'phone' => $phone,

                                    'ip' => $ip

                                ];

                                $sql = "INSERT INTO users_infos (iduser, name, first_name, birth, address, city, postal, email, phone, ip) VALUES (:idUser, :name, :first_name, :birth, :address, :city, :postal, :email, :phone, :ip)";

                                $req = $pdo->prepare($sql);

                                $result = $req->execute($datas);

                                if($result){

                                    $_SESSION['email_offre'] = $datas['email'];

                                    $_SESSION['ip'] = $datas['ip'];

                                    $reponsConfirm = 'Vous pouvez maintenant acceder aux offres';

                                    $button = '"Fermer"';

                                    $redirection = url_site . 'missions.php';

                                }

                            }else{

                                $reponsError = 'Le Captcha entré est incorrect.';

                                $button = '"Fermer"';

                            }

                            }else{

                                $reponsError = 'L\'email entrée est deja utilisé.';

                                $button = '"Fermer"';

                            }

                        }else{

                            $reponsError = 'L\'email entrée est deja utilisé.';

                            $button = '"Fermer"';

                        }

                    }else{

                        $reponsError = 'Le numero de telephone entrée est incorrecte.';

                        $button = '"Fermer"';

                    }

                }else{

                    $reponsError = 'Le code postal entrée est incorrecte.';

                    $button = '"Fermer"';

                }

			}else{

				$reponsError = 'L\'adresse e-mail entrée est incorrecte.';

                $button = '"Fermer"';

			}

	}else{

		$reponsError = 'Tout les champs sont requis pour votre inscription.';

        $button = '"Fermer"';
	}

}


if (isset($reponsConfirm)) {

    ?>

    <script type="text/javascript">

        swal({

        text: "<?= $reponsConfirm; ?>",

                button: <?= $button; ?>,

                icon: "success",

                closeOnClickOutside: false,

                closeOnEsc: false,

        })<?php if (isset($redirection)) { ?>,

            setTimeout("window.location='<?= $redirection; ?>'", 3000);<?php } ?>

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

        <?php if (isset($redirection)) { ?>,

            setTimeout("window.location='<?= $redirection; ?>'", 3000);

        <?php } ?>

    </script>

    <?php

}



?>
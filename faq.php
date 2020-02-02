<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Questions fréquentes';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');

$sqlPage = $pdo->query("SELECT * FROM pages WHERE id = 1");
$resultatPage = $sqlPage->fetch(PDO::FETCH_ASSOC);
$namePage = addslashes(htmlentities($resultatPage['nom']));
$descriptionPage = nl2br(htmlentities($resultatPage['contenu']));
?>
<style>
h3 {
    font-size: 18px;
    font-weight: 700;
    /* margin: 0 0 21px; */
    color: #9292b4;
    text-align: left;
}
</style>
<section class="bg-white absolute-section-1">
    <div class="m-auto content container">
        <div class="section-headline">
            <h2 class="f-s-36 xs-f-s-24 Oswald uppercase color-dark-grey txt-align-center m-b--20"><span class="color-black">FAQ</span></h2>
            <div class="container m-t-40">
                <div class="row" align="center">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 col-xs-12 txt-align-center" style="float: inherit;">
                        <div class="bg-light-grey p-20 b-r-10 b-5-blue">
                            <div class="f-s-21 uppercase f-w-400 m-b-5 color-orange">Questions fréquentes</div>

                                <div style="text-align: justify; font-size: 13px;color: #686f8a;line-height: 180%;font-family: 'Open Sans', sans-serif;">
                                    <br /><br />
                                    <hr>
                                    <h2 align="center">Questions générales</h2>
                                    <hr>
                                    
                                    <h3>Quel est le principe de Quizzdeal.fr ?</h3>
                                    <p>
                                       Quizzdeal.fr est une plate-forme de bonus et de crédits vous permettant de remporter de l'argent et des cadeaux, en participant à des jeux, des loteries ou des sondages.
                                       Tous les paiements seront crédités sur votre compte Quizzdeal.fr, et pourront être virés vers votre compte bancaire ou Paypal si les fonds atteignent le seuil de 5 euros.
                                    </p>
                                    
                                    <h3>Comment Quizzdeal.fr est financé ?</h3>
                                    <p>
                                        Quizzdeal.fr reçoit des commissions des partenaires, pour lesquelles vous pouvez participer aux programmes. 
                                        Nous gardons une petite partie de cette commission pour notre service. 
                                        La plupart de la commission vous est reversée en tant que membre de Quizzdeal.fr pour votre participation à des programmes et des actions.

                                    </p>
                                    
                                    <h3>Dois-je acheter quelque chose à Quizzdeal.fr ?</h3>
                                    <p>
                                        Quizzdeal.fr est 100% gratuit, vous n'avez absolument rien à débourser, et au contraire, tout à y gagner.
                                    </p>
                                    
                                    <h3>Est-ce que mes mes données sont en toute sécurisées ?</h3>
                                    <p>
                                       Toutes les données sont protégées, confidentielles et soumises à nos Conditions Générales d'Utilisation.
                                    </p>
                                    
                                    <h3>Comment puis-je gagner de l'argent avec Quizzdeal.fr ?</h3>
                                    <p>
                                        Pour gagner de l'argent avec Quizdeal.fr, vous devez vous connecter à Quizdeal.fr puis participer gratuitement à des missions auprès de nos partenaires en cliquant sur "Gagner de l'argent".
                                    </p>
                                    
                                    <h3>Quelle est l'importance de "poursuite" (tracking) ?</h3>
                                    <p>
                                        Le terme «poursuite» décrit l' enregistrement de la participation chez un partenaire. 
                                        Avec la participation à une offre avec bonus, la transaction est reconnue par nos partenaires et est enregistrée. 
                                        Cette procédure est appelée aussi "tracking".
                                    </p>
                                    
                                    <br /><br />
                                    <hr>
                                    <h2 align="center">Paiement</h2>
                                    <hr>
                                    
                                    <h3>Comment obtenir ma commission méritée ?</h3>
                                    <p>
                                        Vous pouvez demander un paiement, si vos fonds atteingnent 5 €. 
                                        Pour cela, cliquez, lorsque vous êtes connecté sur "Votre compte", sur le bouton "paiement". 
                                        Là, vous avez la possibilité de vous faire payer votre crédit par PayPal ou par virement bancaire. 
                                        A noter, il y a des frais, lorsque vous choisissez le paiement par paypal (1,9% + € 0,35). 
                                        Les données, qui sont fait par vous, ne sont pas renseignées à des tiers.
                                    </p>
                                    
                                    <h3>Pourquoi y-a-t-il des frais de Paypal ?</h3>
                                    <p>
                                        Malheureusement, il est vrai que les transactions Paypal sont associées à des coûts supplémentaires pour Quizzdeal.fr. 
                                        C'est la raison pour laquelle vEuro.fr doit facturer des frais sur les transactions PayPal. 
                                        Quizzdeal.fr recommande donc le virement bancaire, parce qu' il n' y a aucun frais ou taxes.
                                    </p>
                                    
                                    <h3>Est-il possible de transférer mes fonds à d'autres membres ?</h3>
                                    <p>
                                        NON. Ce n'est pas possible.
                                    </p>
                                    
                                    <h3>A partir de quel montant puis-je demander un paiement ?</h3>
                                    <p>
                                        Vous pouvez demander un paiement, si vos fonds atteignent 5 €.
                                    </p>
                                    
                                    <br /><br />
                                    <hr>
                                    <h2 align="center">Votre compte</h2>
                                    <hr>
                                    
                                    <h3>Est-ce que l’affiliation est gratuite ?</h3>
                                    <p>
                                        La création de votre compte sur Quizzdeal.fr est 100% gratuite. Pas de frais cachés ou de surcoûts.
                                    </p>
                                    
                                    <h3>Combien de comptes sont autorisés par utilisateur ?</h3>
                                    <p>
                                        Quizzdeal.fr autorise la création d'un seul compte par personne et par ménage.
                                        Les comptes multiples pour une même personne ne sont pas autorisés, et exposent à un bloquage des personnes concernées, ainsi qu'à la parte des crédits gagnés.
                                    </p>
                                    
                                    <h3>Comment et quand puis-je annuler mon compte ?</h3>
                                    <p>
                                        Vous pouvez annuler votre compte à tout moment en nous en faisant la demande par le biais de la page Contact.
                                    </p>
                                    
                                    <h3>Où puis-je changer mes données ?</h3>
                                    <p>
                                        Pour modifier votre profil et vos informations personnelles, vous devez vous connecter à votre Espace Membre, puis aller sur la page Profil.
                                    </p>
                                    
                                    <h3>Puis-je me désinscrire de la newsletter ?</h3>
                                    <p>
                                        Oui, à tout moment, vous pouvez ne plus recevoir notre newsletter. Il vous suffit pour cela de vous connecter et de modifier votre profil.
                                        Et de la même manière, vous pourrez de nouveau vous inscrire sur notre liste de diffusion.
                                    </p>
                                    
                                    <h3>Est-ce que mes données sont partagées avec des tiers ?</h3>
                                    <p>
                                        Toutes les données rassemblées par Quizzdeal.fr sont traitées confidentiellement et ne sont pas transmises à des tiers.
                                    </p>
                                    
                                    <br /><br />
                                    <hr>
                                    <h2 align="center">Missions</h2>
                                    <hr>
                                    
                                    <h3>Quelle est la définition d'une mission ?</h3>
                                    <p>
                                        Une mission est un programme qui est offert par les partenaires de Quizzdeal.fr. 
                                        Si vous participez à une mission, vous recevez une commission de nos partenaires. 
                                        Ainsi, vous pouvez gagner de l'argent, par exemple avec un enregistrement ou une inscription.
                                    </p>
                                    
                                    <h3>Où puis-je trouver des missions ?</h3>
                                    <p>
                                        Vous trouvez des missions en vous connectant à votre Espace Membre, puis en cliquant sur "Gagner de l'argent".
                                    </p>
                                    
                                    <h3>Quand vais-je recevoir de l'argent pour une action ?</h3>
                                    <p>
                                        En général, il faudra 24 à 48h pour que la participation apparaisse comme étant validée dans votre historique, le délai dépendant des vérifications effectuées par les différents partenaires.. 
                                    </p>
                                    
                                    <h3>Vous ne pouvez pas trouver la participation ?</h3>
                                    <p>
                                        Si le délai est dépassé et que vous n'avez toujours aucun retour dans votre historique, vous pouvez nous en faire part par la page Contact, en précisant :<br /><br />
                                        - le nom du partenaire ou de la mission<br />
                                        - la date de participation ?<br />
                                        - votre nom, prénom et email<br />
                                    </p>
                                    
                                    <h3>Les Trash-mails sont-ils admis ?</h3>
                                    <p>
                                        NON - Ce qu'on appelle fournisseur de Trash-mail ou de "e-mails jettables" ne sont pas autorisés. 
                                        Ni pour l’inscription ni à la participation aux actions. 
                                        A noter que toute tentative d'utiliser une "e-mail jetable", se traduira par un bloquage du compte.
                                    </p>
                                    
                                    <h3>Ma mission a été refusée</h3>
                                    <p>
                                        Un paiement est effectué seulement si il y a eu vraiment une transaction ou une inscription. 
                                        Ce sont les raisons de l'annulation de paiement:<br /><br />  
                                        - La transaction a été annulée par le partenaire.<br />   
                                        - S'il vous plaît notez, que toute la commission sera annulée, s’il y a une annulation partielle. <br />
                                        <br />
                                        Si l'annulation est faite par erreur, contactez-nous s'il vous plaît en indiquant l'action sur laquelle portait la commission. 
                                        Nous contacterons immédiatement le partenaire. 
                                    </p>
                                    
                                    <br /><br />
                                    <hr>
                                    <h2 align="center">Système d’acquisition de nouveaux membres</h2>
                                    <hr>
                                    
                                    <h3>Comment puis-je acquérir des nouveaux membres ?</h3>
                                    <p>
                                        Vous pouvez parrainer des nouveaux membres pour Quizzdeal.fr et recevoir une commission de 10 pour cent à vie. 
                                        Pour cela, il suffit de partager votre lien de parrainage avec votre filleul, ce dernier devant le préciser dans sa page Profil sur son Espace Membre.
                                    </p>
                                    
                                    <h3>Vais-je recevoir une commission pour les nouveaux membres recrutés ?</h3>
                                    <p>
                                        Pour vos nouveaux membres recrutés, vous recevez la rémunération suivante: Niveau 1: 10% du chiffre d'affaires.. Quand vous parrainez un autre ami, vous obtenez 10% de son chiffre d'affaires. 
                                        Ainsi, vous pouvez gagner beaucoup d'argent très vite et sans beaucoup de travail.
                                    </p>
                                    
                                    <h3>Où puis-je trouver mon lien de parrainage ?</h3>
                                    <p>
                                        Le lien de parrainage se trouve dans la page Parrainage accessible depuis votre Espace Membre.
                                    </p>
                                </div>

                                <br><br>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include('./requiert/inc-footer.php');
?>
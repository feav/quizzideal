<?php
include('./requiert/php-global.php');

$meta_title = 'Quizzdeal.fr : Mentions légales';
$meta_description = '';

include('./requiert/inc-head.php');
include('./requiert/inc-header-navigation.php');

$sqlPage = $pdo->query("SELECT * FROM pages WHERE id = 1");
$resultatPage = $sqlPage->fetch(PDO::FETCH_ASSOC);
$namePage = addslashes(htmlentities($resultatPage['nom']));
$descriptionPage = nl2br(htmlentities($resultatPage['contenu']));
?>
<section class="bg-white absolute-section-1">
    <div class="m-auto content p-40-20">
        <div class="section-headline">
            <h2 class="f-s-36 xs-f-s-24 Oswald uppercase color-dark-grey txt-align-center m-b--20"><span class="color-beige">Mentions</span> légales</h2>
            <div class="container m-t-40">
                <div class="row" align="center">
                    <div class="col-md-2"></div>
                    <div class="col-md-8 col-xs-12 txt-align-center" style="float: inherit;">
                        <div class="bg-light-grey p-20 b-r-10 b-5-blue">
                            <div class="f-s-21 uppercase f-w-400 m-b-5 color-orange"><?= $namePage; ?></div>

                            <?= $descriptionPage; ?>

                                <div class='' style="text-align: justify; font-size: 13px;">
                                    <h4 align="center">Mentions légales</h4>
                                    <hr>
                                    <h5>Définitions</h5>
                                    <p><b>Client&nbsp;:</b>&nbsp;tout professionnel ou personne physique capable au sens des articles 1123 et suivants du Code civil, ou personne morale, qui visite le Site objet des présentes conditions générales.<br>
                                        <b>Prestations et Services&nbsp;:</b> <a href="http://quizzdeal.fr">Quizzdeal</a> met à disposition des Clients&nbsp;:</p>

                                    <p><b>Contenu&nbsp;:</b>&nbsp;Ensemble des éléments constituants l’information présente sur le Site, notamment textes – images.</p>

                                    <p><b>Informations clients&nbsp;:</b> Ci après dénommé «&nbsp;Information (s)&nbsp;» qui correspondent à l’ensemble des données personnelles susceptibles d’être détenues par <a href="http://quizzdeal.fr">Quizzdeal</a> pour la gestion de votre compte, de la gestion de la relation client et à des fins d’analyses et de statistiques.</p>


                                    <p><b>Utilisateur :</b> Internaute se connectant, utilisant le site susnommé.</p>
                                    <p><b>Informations personnelles :</b> « Les informations qui permettent, sous quelque forme que ce soit, directement ou non, l'identification des personnes physiques auxquelles elles s'appliquent » (article 4 de la loi n° 78-17 du 6 janvier 1978).</p>
                                    <p>Les termes «&nbsp;données à caractère personnel&nbsp;», «&nbsp;personne concernée&nbsp;», «&nbsp;sous traitant&nbsp;» et «&nbsp;données sensibles&nbsp;» ont le sens défini par le Règlement Général sur la Protection des Données (RGPD&nbsp;: n° 2016-679)</p>

                                    <h5>1. Présentation du site internet.</h5>
                                    <p>En vertu de l'article 6 de la loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique, il est précisé aux utilisateurs du site internet&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;l'identité des différents intervenants dans le cadre de sa réalisation et de son suivi:
                                    </p><p><strong>Propriétaire</strong> :   Timothee Duda   – marion de rulhe 12390 Auzits<br>

                                        <strong>Responsable publication</strong> : Timothee Duda – dudatimothee@gmail.com<br>
                                        Le responsable publication est une personne physique ou une personne morale.<br>
                                        <strong>Webmaster</strong> : Timothee Duda – dudatimothee@gmail.com<br>
                                        <strong>Hébergeur</strong> : LWS – 4, rue galvani 75017 Paris +33 8 26 10 24 13<br>
                                        <strong>Délégué à la protection des données</strong> : Timothee Duda – dudatimothee@gmail.com<br>
                                    </p>

                                    <div ng-bind-html="linkHTML"><p>Ces mentions légales RGPD sont issues du <a href="https://fr.orson.io/1371/generateur-mentions-legales" title="générateur de mentions légales RGPD d">générateur de mentions légales RGPD d'Orson.io</a></p></div>



                                    <h5>2. Conditions générales d’utilisation du site et des services proposés.</h5>

                                    <p>Le Site constitue une œuvre de l’esprit protégée par les dispositions du Code de la Propriété Intellectuelle et des Réglementations Internationales applicables. 
                                        Le Client ne peut en aucune manière réutiliser, céder ou exploiter pour son propre compte tout ou partie des éléments ou travaux du Site.</p>

                                    <p>L’utilisation du site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;implique l’acceptation pleine et entière des conditions générales d’utilisation ci-après décrites. Ces conditions d’utilisation sont susceptibles d’être modifiées ou complétées à tout moment, les utilisateurs du site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;sont donc invités à les consulter de manière régulière.</p>

                                    <p>Ce site internet est normalement accessible à tout moment aux utilisateurs. Une interruption pour raison de maintenance technique peut être toutefois décidée par <a href="http://quizzdeal.fr">Quizzdeal</a>, qui s’efforcera alors de communiquer préalablement aux utilisateurs les dates et heures de l’intervention.
                                        Le site web&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;est mis à jour régulièrement par <a href="http://quizzdeal.fr">Quizzdeal</a> responsable. De la même façon, les mentions légales peuvent être modifiées à tout moment : elles s’imposent néanmoins à l’utilisateur qui est invité à s’y référer le plus souvent possible afin d’en prendre connaissance.</p>

                                    <h5>3. Description des services fournis.</h5>

                                    <p>Le site internet&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;a pour objet de fournir une information concernant l’ensemble des activités de la société.
                                        <a href="http://quizzdeal.fr">Quizzdeal</a> s’efforce de fournir sur le site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;des informations aussi précises que possible. Toutefois, il ne pourra être tenu responsable des oublis, des inexactitudes et des carences dans la mise à jour, qu’elles soient de son fait ou du fait des tiers partenaires qui lui fournissent ces informations.</p>

                                    <p>Toutes les informations indiquées sur le site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;sont données à titre indicatif, et sont susceptibles d’évoluer. Par ailleurs, les renseignements figurant sur le site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;ne sont pas exhaustifs. Ils sont donnés sous réserve de modifications ayant été apportées depuis leur mise en ligne.</p>

                                    <h5>4. Limitations contractuelles sur les données techniques.</h5>

                                    <p>Le site utilise la technologie JavaScript.

                                        Le site Internet ne pourra être tenu responsable de dommages matériels liés à l’utilisation du site. De plus, l’utilisateur du site s’engage à accéder au site en utilisant un matériel récent, ne contenant pas de virus et avec un navigateur de dernière génération mis-à-jour
                                        Le site <a href="http://quizzdeal.fr">Quizzdeal</a> est hébergé chez un prestataire sur le territoire de l’Union Européenne conformément aux dispositions du Règlement Général sur la Protection des Données (RGPD&nbsp;: n° 2016-679)</p>

                                    <p>L’objectif est d’apporter une prestation qui assure le meilleur taux d’accessibilité. L’hébergeur assure la continuité de son service 24 Heures sur 24, tous les jours de l’année. Il se réserve néanmoins la possibilité d’interrompre le service d’hébergement pour les durées les plus courtes possibles notamment à des fins de maintenance, d’amélioration de ses infrastructures, de défaillance de ses infrastructures ou si les Prestations et Services génèrent un trafic réputé anormal.</p>

                                    <p><a href="http://quizzdeal.fr">Quizzdeal</a> et l’hébergeur ne pourront être tenus responsables en cas de dysfonctionnement du réseau Internet, des lignes téléphoniques ou du matériel informatique et de téléphonie lié notamment à l’encombrement du réseau empêchant l’accès au serveur.</p>

                                    <h5>5. Propriété intellectuelle et contrefaçons.</h5>

                                    <p><a href="http://quizzdeal.fr">Quizzdeal</a> est propriétaire des droits de propriété intellectuelle et détient les droits d’usage sur tous les éléments accessibles sur le site internet, notamment les textes, images, graphismes, logos, vidéos, icônes et sons.
                                        Toute reproduction, représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de : <a href="http://quizzdeal.fr">Quizzdeal</a>.</p>

                                    <p>Toute exploitation non autorisée du site ou de l’un quelconque des éléments qu’il contient sera considérée comme constitutive d’une contrefaçon et poursuivie conformément aux dispositions des articles L.335-2 et suivants du Code de Propriété Intellectuelle.</p>

                                    <h5>6. Limitations de responsabilité.</h5>

                                    <p><a href="http://quizzdeal.fr">Quizzdeal</a> agit en tant qu’éditeur du site. <a href="http://quizzdeal.fr">Quizzdeal</a> &nbsp;est responsable de la qualité et de la véracité du Contenu qu’il publie. </p>

                                    <p><a href="http://quizzdeal.fr">Quizzdeal</a> ne pourra être tenu responsable des dommages directs et indirects causés au matériel de l’utilisateur, lors de l’accès au site internet <a href="http://quizzdeal.fr">Quizzdeal</a>, et résultant soit de l’utilisation d’un matériel ne répondant pas aux spécifications indiquées au point 4, soit de l’apparition d’un bug ou d’une incompatibilité.</p>

                                    <p><a href="http://quizzdeal.fr">Quizzdeal</a> ne pourra également être tenu responsable des dommages indirects (tels par exemple qu’une perte de marché ou perte d’une chance) consécutifs à l’utilisation du site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>.
                                        Des espaces interactifs (possibilité de poser des questions dans l’espace contact) sont à la disposition des utilisateurs. <a href="http://quizzdeal.fr">Quizzdeal</a> se réserve le droit de supprimer, sans mise en demeure préalable, tout contenu déposé dans cet espace qui contreviendrait à la législation applicable en France, en particulier aux dispositions relatives à la protection des données. Le cas échéant, <a href="http://quizzdeal.fr">Quizzdeal</a> se réserve également la possibilité de mettre en cause la responsabilité civile et/ou pénale de l’utilisateur, notamment en cas de message à caractère raciste, injurieux, diffamant, ou pornographique, quel que soit le support utilisé (texte, photographie …).</p>

                                    <h5>7. Gestion des données personnelles.</h5>

                                    <p>Le Client est informé des réglementations concernant la communication marketing, la loi du 21 Juin 2014 pour la confiance dans l’Economie Numérique, la Loi Informatique et Liberté du 06 Août 2004 ainsi que du Règlement Général sur la Protection des Données (RGPD&nbsp;: n° 2016-679). </p>

                                    <h6>7.1 Responsables de la collecte des données personnelles</h6>

                                    <p>Pour les Données Personnelles collectées dans le cadre de la création du compte personnel de l’Utilisateur et de sa navigation sur le Site, le responsable du traitement des Données Personnelles est : Timothee Duda. <a href="http://quizzdeal.fr">Quizzdeal</a>est représenté par Timothee Duda, son représentant légal</p>

                                    <p>En tant que responsable du traitement des données qu’il collecte, <a href="http://quizzdeal.fr">Quizzdeal</a> s’engage à respecter le cadre des dispositions légales en vigueur. Il lui appartient notamment au Client d’établir les finalités de ses traitements de données, de fournir à ses prospects et clients, à partir de la collecte de leurs consentements, une information complète sur le traitement de leurs données personnelles et de maintenir un registre des traitements conforme à la réalité.
                                        Chaque fois que <a href="http://quizzdeal.fr">Quizzdeal</a> traite des Données Personnelles, <a href="http://quizzdeal.fr">Quizzdeal</a> prend toutes les mesures raisonnables pour s’assurer de l’exactitude et de la pertinence des Données Personnelles au regard des finalités pour lesquelles <a href="http://quizzdeal.fr">Quizzdeal</a> les traite.</p>
                                    &nbsp;
                                    <h6>7.2 Finalité des données collectées</h6>
                                    &nbsp;
                                    <p><a href="http://quizzdeal.fr">Quizzdeal</a> est susceptible de traiter tout ou partie des données : </p>

                                    <ul>

                                        <li>pour permettre la navigation sur le Site et la gestion et la traçabilité des prestations et services commandés par l’utilisateur : données de connexion et d’utilisation du Site, historique des commandes, etc. </li>
                                        &nbsp;
                                        <li>pour prévenir et lutter contre la fraude informatique (spamming, hacking…) : matériel informatique utilisé pour la navigation, l’adresse IP, le mot de passe (hashé) </li>
                                        &nbsp;
                                        <li>pour améliorer la navigation sur le Site : données de connexion et d’utilisation </li>
                                        &nbsp;
                                        <li>pour mener des enquêtes de satisfaction facultatives sur <a href="http://quizzdeal.fr">Quizzdeal</a> : adresse email </li>
                                        <li>pour mener des campagnes de communication (newsletter, mail, sms) : numéro de téléphone, adresse email</li>


                                    </ul>

                                    <p><a href="http://quizzdeal.fr">Quizzdeal</a> ne commercialise pas vos données personnelles qui sont donc uniquement utilisées par nécessité ou à des fins statistiques et d’analyses.</p>
                                    &nbsp;
                                    <h6>7.3 Droit d’accès, de rectification et d’opposition</h6>
                                    &nbsp;
                                    <p>
                                        Conformément à la réglementation européenne en vigueur, les Utilisateurs de <a href="http://quizzdeal.fr">Quizzdeal</a> disposent des droits suivants : </p>
                                    &nbsp;<ul>

                                        <li>droit d'accès (article 15 RGPD) et de rectification (article 16 RGPD), de mise à jour, de complétude des données des Utilisateurs droit de verrouillage ou d’effacement des données des Utilisateurs à caractère personnel (article 17 du RGPD), lorsqu’elles sont inexactes, incomplètes, équivoques, périmées, ou dont la collecte, l'utilisation, la communication ou la conservation est interdite </li>
                                        &nbsp;
                                        <li>droit de retirer à tout moment un consentement (article 13-2c RGPD) </li>
                                        &nbsp;
                                        <li>droit à la limitation du traitement des données des Utilisateurs (article 18 RGPD) </li>
                                        &nbsp;
                                        <li>droit d’opposition au traitement des données des Utilisateurs (article 21 RGPD) </li>
                                        &nbsp;
                                        <li>droit à la portabilité des données que les Utilisateurs auront fournies, lorsque ces données font l’objet de traitements automatisés fondés sur leur consentement ou sur un contrat (article 20 RGPD) </li>
                                        &nbsp;
                                        <li>droit de définir le sort des données des Utilisateurs après leur mort et de choisir à qui <a href="http://quizzdeal.fr">Quizzdeal</a> devra communiquer (ou non) ses données à un tiers qu’ils aura préalablement désigné</li>
                                        &nbsp;</ul>

                                    <p>Dès que <a href="http://quizzdeal.fr">Quizzdeal</a> a connaissance du décès d’un Utilisateur et à défaut d’instructions de sa part, <a href="http://quizzdeal.fr">Quizzdeal</a> s’engage à détruire ses données, sauf si leur conservation s’avère nécessaire à des fins probatoires ou pour répondre à une obligation légale.</p>
                                    &nbsp;
                                    <p>Si l’Utilisateur souhaite savoir comment <a href="http://quizzdeal.fr">Quizzdeal</a> utilise ses Données Personnelles, demander à les rectifier ou s’oppose à leur traitement, l’Utilisateur peut contacter <a href="http://quizzdeal.fr">Quizzdeal</a> par écrit à l’adresse suivante : </p>
                                    &nbsp;
                                    Timothee Duda – DPO, Timothee Duda <br>
                                    marion de rulhe 12390 Auzits.
                                    &nbsp;
                                    <p>Dans ce cas, l’Utilisateur doit indiquer les Données Personnelles qu’il souhaiterait que <a href="http://quizzdeal.fr">Quizzdeal</a> corrige, mette à jour ou supprime, en s’identifiant précisément avec une copie d’une pièce d’identité (carte d’identité ou passeport). </p>

                                    <p>
                                        Les demandes de suppression de Données Personnelles seront soumises aux obligations qui sont imposées à <a href="http://quizzdeal.fr">Quizzdeal</a> par la loi, notamment en matière de conservation ou d’archivage des documents. Enfin, les Utilisateurs de <a href="http://quizzdeal.fr">Quizzdeal</a> peuvent déposer une réclamation auprès des autorités de contrôle, et notamment de la CNIL (https://www.cnil.fr/fr/plaintes).</p>
                                    &nbsp;
                                    <h6>7.4 Non-communication des données personnelles</h6>

                                    <p>
                                        <a href="http://quizzdeal.fr">Quizzdeal</a> s’interdit de traiter, héberger ou transférer les Informations collectées sur ses Clients vers un pays situé en dehors de l’Union européenne ou reconnu comme «&nbsp;non adéquat&nbsp;» par la Commission européenne sans en informer préalablement le client. Pour autant, <a href="http://quizzdeal.fr">Quizzdeal</a> reste libre du choix de ses sous-traitants techniques et commerciaux à la condition qu’il présentent les garanties suffisantes au regard des exigences du Règlement Général sur la Protection des Données (RGPD&nbsp;: n° 2016-679).</p>

                                    <p>
                                        <a href="http://quizzdeal.fr">Quizzdeal</a> s’engage à prendre toutes les précautions nécessaires afin de préserver la sécurité des Informations et notamment qu’elles ne soient pas communiquées à des personnes non autorisées. Cependant, si un incident impactant l’intégrité ou la confidentialité des Informations du Client est portée à la connaissance de <a href="http://quizzdeal.fr">Quizzdeal</a>, celle-ci devra dans les meilleurs délais informer le Client et lui communiquer les mesures de corrections prises. Par ailleurs <a href="http://quizzdeal.fr">Quizzdeal</a> ne collecte aucune «&nbsp;données sensibles&nbsp;».</p>

                                    <p>
                                        Les Données Personnelles de l’Utilisateur peuvent être traitées par des filiales de <a href="http://quizzdeal.fr">Quizzdeal</a> et des sous-traitants (prestataires de services), exclusivement afin de réaliser les finalités de la présente politique.</p>
                                    <p>
                                        Dans la limite de leurs attributions respectives et pour les finalités rappelées ci-dessus, les principales personnes susceptibles d’avoir accès aux données des Utilisateurs de <a href="http://quizzdeal.fr">Quizzdeal</a> sont principalement les agents de notre service client.</p>

                                    <div ng-bind-html="rgpdHTML"><h6>7.5 Types de données collectées</h6><p>Concernant les utilisateurs d’un Site <a href="http://quizzdeal.fr">Quizzdeal</a>, nous collectons les données suivantes qui sont indispensables au fonctionnement du service&nbsp;, et qui seront conservées pendant une période maximale de 9 mois après la fin de la relation contractuelle:<br>nom, prénom, email</p><p><a href="http://quizzdeal.fr">Quizzdeal</a> collecte en outre des informations qui permettent d’améliorer l’expérience utilisateur et de proposer des conseils contextualisés&nbsp;:<br>adresse postale, date de naissance</p><p> Ces &nbsp;données sont conservées pour une période maximale de 9 mois après la fin de la relation contractuelle</p></div>


                                    <h5>8. Notification d’incident</h5>
                                    <p>
                                        Quels que soient les efforts fournis, aucune méthode de transmission sur Internet et aucune méthode de stockage électronique n'est complètement sûre. Nous ne pouvons en conséquence pas garantir une sécurité absolue. 
                                        Si nous prenions connaissance d'une brèche de la sécurité, nous avertirions les utilisateurs concernés afin qu'ils puissent prendre les mesures appropriées. Nos procédures de notification d’incident tiennent compte de nos obligations légales, qu'elles se situent au niveau national ou européen. Nous nous engageons à informer pleinement nos clients de toutes les questions relevant de la sécurité de leur compte et à leur fournir toutes les informations nécessaires pour les aider à respecter leurs propres obligations réglementaires en matière de reporting.</p>
                                    <p>
                                        Aucune information personnelle de l'utilisateur du site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;n'est publiée à l'insu de l'utilisateur, échangée, transférée, cédée ou vendue sur un support quelconque à des tiers. Seule l'hypothèse du rachat de <a href="http://quizzdeal.fr">Quizzdeal</a> et de ses droits permettrait la transmission des dites informations à l'éventuel acquéreur qui serait à son tour tenu de la même obligation de conservation et de modification des données vis à vis de l'utilisateur du site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>.</p>

                                    <h6>Sécurité</h6>

                                    <p>
                                        Pour assurer la sécurité et la confidentialité des Données Personnelles et des Données Personnelles de Santé, <a href="http://quizzdeal.fr">Quizzdeal</a> utilise des réseaux protégés par des dispositifs standards tels que par pare-feu, la pseudonymisation, l’encryption et mot de passe. </p>
                                    &nbsp;
                                    <p>
                                        Lors du traitement des Données Personnelles, <a href="http://quizzdeal.fr">Quizzdeal</a>prend toutes les mesures raisonnables visant à les protéger contre toute perte, utilisation détournée, accès non autorisé, divulgation, altération ou destruction.</p>
                                    &nbsp;
                                    <h5>9. Liens hypertextes « cookies » et balises (“tags”) internet</h5>
                                    <p>
                                        Le site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;contient un certain nombre de liens hypertextes vers d’autres sites, mis en place avec l’autorisation de <a href="http://quizzdeal.fr">Quizzdeal</a>. Cependant, <a href="http://quizzdeal.fr">Quizzdeal</a> n’a pas la possibilité de vérifier le contenu des sites ainsi visités, et n’assumera en conséquence aucune responsabilité de ce fait.</p>
                                    Sauf si vous décidez de désactiver les cookies, vous acceptez que le site puisse les utiliser. Vous pouvez à tout moment désactiver ces cookies et ce gratuitement à partir des possibilités de désactivation qui vous sont offertes et rappelées ci-après, sachant que cela peut réduire ou empêcher l’accessibilité à tout ou partie des Services proposés par le site.
                                    <p></p>

                                    <h6>9.1. « COOKIES »</h6>
                                    &nbsp;<p>
                                        Un « cookie » est un petit fichier d’information envoyé sur le navigateur de l’Utilisateur et enregistré au sein du terminal de l’Utilisateur (ex : ordinateur, smartphone), (ci-après « Cookies »). Ce fichier comprend des informations telles que le nom de domaine de l’Utilisateur, le fournisseur d’accès Internet de l’Utilisateur, le système d’exploitation de l’Utilisateur, ainsi que la date et l’heure d’accès. Les Cookies ne risquent en aucun cas d’endommager le terminal de l’Utilisateur.</p>
                                    &nbsp;<p>
                                        <a href="http://quizzdeal.fr">Quizzdeal</a> est susceptible de traiter les informations de l’Utilisateur concernant sa visite du Site, telles que les pages consultées, les recherches effectuées. Ces informations permettent à <a href="http://quizzdeal.fr">Quizzdeal</a> d’améliorer le contenu du Site, de la navigation de l’Utilisateur.</p>
                                    &nbsp;<p>
                                        Les Cookies facilitant la navigation et/ou la fourniture des services proposés par le Site, l’Utilisateur peut configurer son navigateur pour qu’il lui permette de décider s’il souhaite ou non les accepter de manière à ce que des Cookies soient enregistrés dans le terminal ou, au contraire, qu’ils soient rejetés, soit systématiquement, soit selon leur émetteur. L’Utilisateur peut également configurer son logiciel de navigation de manière à ce que l’acceptation ou le refus des Cookies lui soient proposés ponctuellement, avant qu’un Cookie soit susceptible d’être enregistré dans son terminal. <a href="http://quizzdeal.fr">Quizzdeal</a> informe l’Utilisateur que, dans ce cas, il se peut que les fonctionnalités de son logiciel de navigation ne soient pas toutes disponibles.</p>
                                    &nbsp;<p>
                                        Si l’Utilisateur refuse l’enregistrement de Cookies dans son terminal ou son navigateur, ou si l’Utilisateur supprime ceux qui y sont enregistrés, l’Utilisateur est informé que sa navigation et son expérience sur le Site peuvent être limitées. Cela pourrait également être le cas lorsque <a href="http://quizzdeal.fr">Quizzdeal</a> ou l’un de ses prestataires ne peut pas reconnaître, à des fins de compatibilité technique, le type de navigateur utilisé par le terminal, les paramètres de langue et d’affichage ou le pays depuis lequel le terminal semble connecté à Internet.</p>
                                    &nbsp;<p>
                                        Le cas échéant, <a href="http://quizzdeal.fr">Quizzdeal</a> décline toute responsabilité pour les conséquences liées au fonctionnement dégradé du Site et des services éventuellement proposés par <a href="http://quizzdeal.fr">Quizzdeal</a>, résultant (i) du refus de Cookies par l’Utilisateur (ii) de l’impossibilité pour <a href="http://quizzdeal.fr">Quizzdeal</a> d’enregistrer ou de consulter les Cookies nécessaires à leur fonctionnement du fait du choix de l’Utilisateur. Pour la gestion des Cookies et des choix de l’Utilisateur, la configuration de chaque navigateur est différente. Elle est décrite dans le menu d’aide du navigateur, qui permettra de savoir de quelle manière l’Utilisateur peut modifier ses souhaits en matière de Cookies.</p>
                                    &nbsp;<p>
                                        À tout moment, l’Utilisateur peut faire le choix d’exprimer et de modifier ses souhaits en matière de Cookies. <a href="http://quizzdeal.fr">Quizzdeal</a> pourra en outre faire appel aux services de prestataires externes pour l’aider à recueillir et traiter les informations décrites dans cette section.</p>
                                    &nbsp;<p>
                                        Enfin, en cliquant sur les icônes dédiées aux réseaux sociaux Twitter, Facebook, Linkedin et Google Plus figurant sur le Site de <a href="http://quizzdeal.fr">Quizzdeal</a> ou dans son application mobile et si l’Utilisateur a accepté le dépôt de cookies en poursuivant sa navigation sur le Site Internet ou l’application mobile de <a href="http://quizzdeal.fr">Quizzdeal</a>, Twitter, Facebook, Linkedin et Google Plus peuvent également déposer des cookies sur vos terminaux (ordinateur, tablette, téléphone portable).</p>
                                    &nbsp;<p>
                                        Ces types de cookies ne sont déposés sur vos terminaux qu’à condition que vous y consentiez, en continuant votre navigation sur le Site Internet ou l’application mobile de <a href="http://quizzdeal.fr">Quizzdeal</a>. À tout moment, l’Utilisateur peut néanmoins revenir sur son consentement à ce que <a href="http://quizzdeal.fr">Quizzdeal</a> dépose ce type de cookies.</p>
                                    &nbsp;
                                    <h6>Article 9.2. BALISES (“TAGS”) INTERNET</h6>
                                    &nbsp;

                                    <p>

                                        <a href="http://quizzdeal.fr">Quizzdeal</a> peut employer occasionnellement des balises Internet (également appelées « tags », ou balises d’action, GIF à un pixel, GIF transparents, GIF invisibles et GIF un à un) et les déployer par l’intermédiaire d’un partenaire spécialiste d’analyses Web susceptible de se trouver (et donc de stocker les informations correspondantes, y compris l’adresse IP de l’Utilisateur) dans un pays étranger.</p>
                                    &nbsp;
                                    <p>
                                        Ces balises sont placées à la fois dans les publicités en ligne permettant aux internautes d’accéder au Site, et sur les différentes pages de celui-ci. 
                                        &nbsp;</p>
                                    <p>
                                        Cette technologie permet à <a href="http://quizzdeal.fr">Quizzdeal</a> d’évaluer les réponses des visiteurs face au Site et l’efficacité de ses actions (par exemple, le nombre de fois où une page est ouverte et les informations consultées), ainsi que l’utilisation de ce Site par l’Utilisateur. </p>
                                    &nbsp;<p>
                                        Le prestataire externe pourra éventuellement recueillir des informations sur les visiteurs du Site et d’autres sites Internet grâce à ces balises, constituer des rapports sur l’activité du Site à l’attention de <a href="http://quizzdeal.fr">Quizzdeal</a>, et fournir d’autres services relatifs à l’utilisation de celui-ci et d’Internet.</p>
                                    &nbsp;<p>
                                    </p><h6>10. Droit applicable et attribution de juridiction.</h6>  
                                    <p>
                                        Tout litige en relation avec l’utilisation du site&nbsp;<a href="http://quizzdeal.fr">Quizzdeal</a>&nbsp;est soumis au droit français. 
                                        En dehors des cas où la loi ne le permet pas, il est fait attribution exclusive de juridiction aux tribunaux compétents de Rodez</p>

                                    <!--<h6>"nom de site" est un service présenté par :</h6>
                                    <p>Monsieur ,<br>
                                        Adresse<br><br>
                                        <span class="icon icon-phone">&#160;&#160;Numéro de telephone</span><br>
                                        <span class="icon icon-envelope">&#160;&#160;adresse email</span><br><br>
                                        <h6>"nom de site" est hébergé par la société :</h6>
                                        <p>votre hebergeur<br><span class="icon icon-envelope">&#160;&#160;email hebergeur</span></p><br>-->
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
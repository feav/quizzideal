<?php
	include('./requiert/new-form/header.php');
	
	$meta_title = 'Quizzdeal.fr : Mentions légales';
	$meta_description = '';
	

		$sqlPage = $pdo->query("SELECT * FROM pages WHERE id = 1");
		$resultatPage = $sqlPage->fetch(PDO::FETCH_ASSOC);
		$namePage = addslashes(htmlentities($resultatPage['nom'])) ?? "";
		$descriptionPage = nl2br(htmlentities($resultatPage['contenu'])) ?? "";

?>
<style>
div.section-headline-wrap.vb {
	background: #f1f1fb;
	padding: 20px;
}
section.bg-light-grey.absolute-section-1.margin-base {
	margin:0;
    padding-bottom: 50px;
}
.section-headline > h2 {
    font-size: 30px;
    font-weight: 700;
    color: #283346;
    display: block;
    width: auto;
	font-family: 'Montserrat', sans-serif;
}
.section-headline > p {
    margin: 0;
}
.m-auto.content.p-40-20.container {
    padding: 26px 31px 0;
    font-size: 15px !important;
    color: #686f8a;
    line-height: 180%;
    padding-top: 0;
}
h2 {
    font-size: 18px;
    font-weight: 700;
    margin: 0 0 21px;
    color: #9292b4;
    text-align: left;
}
.f-w-light {
	font-weight:inherit;
}
p {
    text-align: justify;
}
</style>
<div class="container" style="margin-top: 25px;">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title-page">Les derniers gagnants</h1>

			<section class="bg-light-grey absolute-section-1 margin-base">
					<div class="m-auto content p-40-20 container">
						<div class="row">
						<div class="col-md-8 col-md-offset-2 col-xs-12 f-s-14 f-w-light">
							<div class="f-s-21 uppercase f-w-400 m-b-5 color-orange"><?= $namePage; ?></div>
							<?= $descriptionPage; ?>
							<section>
							Pour accéder au service Multi-cadeaux, vous devez accepter intégralement et sans réserve les présentes conditions générales d’utilisation.
		Les Utilisateurs s’engagent à utiliser les services de « Quizzdeal », de façon loyale et honnête, conformément à leur destination, pour leurs seuls besoins
		et s’interdisent d’en faire commerce auprès de tiers.
		          </section>
		       
		<section>
		<h2><br>Information du site Quizzdeal</br></h2>
		<p>L'entreprise Multi-Cdeaux ayant le N° de SIRET en cours représentée par MR Duda Timothee. Le site internet http://www.quizzdeal.fr,
		un ensemble de services gratuit, sans obligation d'achat et pour une durée indéterminée.
		Le site Quizzdeal.fr a fait l'objet d'une déclaration à la CNIL (Commission Nationale Informatique et Liberté) sous le n°2195962.</p>
		</section>

		<section>
		<h2><br>Conditions générales d'inscription:</br></h2>

		<p>L'inscription au site Multi-cadeaux, ainsi que sont accès, sont libres et gratuits. Vous devez remplir pour cela un formulaire d'inscription disponible
		en ligne avec toutes les informations exigées, valider le règlement du site. Ce site est ouvert à toutes personnes résidant en France ou à l’étranger
		sans restriction, sous réserve de la compréhension de ce règlement.
		Les personnes mineures doivent obtenir l'autorisation de leurs parents ou de la personne exerçant l'autorité parentale pour accéder au site.</p>

		<p>L'utilisateur devra fournir une adresse e-mail valide, non jetable, afin de pouvoir valider son inscription. Toute inscription non validée dans les 48 heures sera supprimée.
		Une seule inscription par foyer est autorisé. Les adresses IP de connexion et d'utilisation sont enregistrées et vérifiées.
		En cas d'utilisation de plus d'un compte par foyer/personne, les comptes seront bloqués pour une durée indéterminées.
		Interdiction de se parrainer sois même.</p>
		</section>

		<section>
		<h2><br>Proctection et gestions des données personnelles:</h2></br>

		<p>Les données saisies lors de l'inscription ne servent qu'à identifier l'utilisateur et à la gestion de son compte. Ces données ne seront en aucun cas
		transmise à des tiers pour quelque utilisation que ce soit.</p>

		<p>Conformément aux dispositions de la Loi N° 78-17 du 6 janvier 1978 relative à l’informatique, aux fichiers et aux libertés, l’utilisateur dispose d’un droit
		d'accès et de rectification des informations personnelles le concernant détenues par Quizzdeal.
		Ce droit d'accès et de modification peut être exercé par email à l’adresse suivante: ou sur votre page personnel directement.</p>
		</section>

		<section>
		<h2><br>Utilisation du site et services Quizzdeal</h2></br>
		<p>Le site Quizzdeal permet aux utilisateurs enregistrés, de gagner des cadeaux en effectuant différentes actions publicitaires, en participant à
		des concours ou des jeux. Pour chaque action effectuée, l'utilisateur gagne des points défini pour chaque partenaire et chaque jeux.</p>
		<p>Il n'y a aucune obligation d'inscription, de visite ou d'achat sur d'éventuels sites partenaires. Quizzdeal ne pratique pas l'incentive si l'annonceur ne l'autorise pas.
		En raison de la nature même d'Internet, Quizzdeal ne pourrait être tenu responsable des pertes de points lié à la non-diffusion de publicité
		suite à des problèmes avec le réseau Internet.</p>
		<p>Il est strictement interdit de faire de l'usurpation d'idendité afin de souscrire à des offres. L'utilisateur s'engage à assumer la responsabilité des données qu'il fournit lors de ses différentes inscritpions. En aucun cas Multi-Cdeaux peut être tenu responsable légalement des données fournis par l'utilisateur.
		Le site ne pourrait être tenu responsable des pertes de points ou soldes liés à des problèmes techniques sur les serveurs hébergeant le site.</p>
		<p>Toute tentative de tricherie ou de fraude, Toutes insultes ou manque de respect envers d'autres membres ou administration du site aboutira à à la suppression sans préavis du compte et des bénéfices éventuels. Cette suppression est définitive et sans recours.</p>
		<p>Les comptes sont individuels et personnels. Ainsi, il est strictement interdit de vendre un compte Quizzdeal, de la même manière
		qu'il n'est pas autorisé de donner son compte. Cela entraînera une suppression immédiate du compte, ainsi que la perte des filleuls qui seront reversés au site.</p>
		</section>

		<section>
		<h2><br>Parrainage</h2></br>
		<p>L'utilisateur peut parrainer via son site ou directement par Email un nouveau membre. Celui-ci deviendra son filleul. Multi-cadeaux, reversera donc
		au parrain 15% des gains de ses filleuls.</p>
		<p>L'envoi massif d'emails non sollicités promotionnant votre lien de parrainage est interdit sous peine de radiation pure et simple du membre en question.</p>

		<h2><br>Conservation de données de protection</h2></br>
		<p>Les informations de connexion des membres au site Multi-Cdeaux sont conservées pendant une durée de 8 mois dans une base de données sauvegardée
		quotidiennement dans des conditions de sécurité et de fiabilité raisonnable.</p>
		<p>Toutes les opérations réalisées sur le site sont présumées avoir été réalisées par le détenteur du compte.</p>
		</section>

		<section>
		<h2><br>Résiliation</h2></br>
		<p>Chacune des parties peut à tout moment et de plein droit résilier le présent contrat et demander la clôture de son compte pour quelque motif que ce soit,
		par courrier électronique.</p>
		<p>La résiliation ne déroge pas aux règles de paiement de l'Article 5 des présentes conditions générales.</p>
		<p>En cas de bannissement d'un membre pour non respect du présent règlement, Quizzdeal se garde le droit de payer ou non le dit membre.</p>
		<p>En cas de non-connexion à un compte pendant plus de 100 jours, Quizzdeal se réserve le droit de considérer ce compte comme abandonné,
		et à ce titre de le clôturer. Aucun reversement ne pourra être effectué.</p>
		</section>

		<section>
		<h2><br>Loi applicable et attribution de juridiction</h2></br>
		<p>Le contrat est soumis au droit français. En cas de litige relatif à l'interprétation de ces conditions générales, leur exécution, leur résiliation ou
		pour quelque cause que ce soit, les parties privilégieront un règlement à l'amiable. En cas d'impossibilité, le tribunal compétent est le Tribunal de Commerce de Paris.</p>
		<p>En s'inscrivant sur le site Quizzdeal, le membre confirme son acceptation pleine et entière des présentes conditions générales et son engagement de s'y conformer.</p>

		<h2><br>Protection de la vie privée</h2></br>
		<p>En visitant et en souscrivant à des offres disponibles sur notre site, vous acceptez le fait que les annonceurs enregistrent ou pas vos informations personnelles et les réutilisent ou pas à des pratiques commerciales.</p>
		</section>

		<section>
		<h2><br>Divers</h2></br>
		<p>Quizzdeal, se réserve le droit de modifier unilatéralement les termes des présentes Conditions sans préavis.
		<p>Toutes les données de quelques natures qu'elles soient, et notamment les textes, graphismes, logos, icônes, images, clips audio ou vidéo,
		marques, logiciels, figurant sur le site sont nécessairement protégées par le droit d'auteur, le droit des marques et tous autres droits de propriété
		intellectuelle, et appartiennent a Quizzdeal, ou à des tiers ayant l’autorisation de Quizzdeal, pour les exploiter.</p>
		<p>Pas de publicités sur des pages à contenu illégal. Ne pas essayer de tricher/détourner le système de points.</p>
		<p>En utilisant le site, vous acceptez que votre pseudo apparaisse sur les pages du site, en particulier sur la page des paiements.</p>
		<p>L'utilisation de logiciels ou de proxy ou tout autre moyen pour générer des points est interdites
		Nous nous réservons le droit de bloquer un compte et de demander à certains membres de justifier leurs points.Sans réponse de leur part, le compte sera supprimé.</p>
		</section>


        </div>
    </div>
</div>
		
<?php
	include('./requiert/new-form/footer.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 transitional//EN">
<?php include('devis_getinfos.php'); ?>
<html>
<head>
<title>WATS - Devis#<?php echo $_GET['id_devis']; ?></title>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
</meta>
<link href="ressources/css/template.css" rel="stylesheet">
</head>


<body>
	<img src="ressources/img/logo-wats-noir.png" style="width: 120px; height: auto; margin-top: 20px; padding-bottom: 10px; margin-left: 12px;">

	<p style="right: 0; position: absolute; color: gray; text-align: right; margin-top: 20px; margin-right: 10px">
		<span style="font-size: 14px; font-weight: bold;">DEVIS</span>
		<br>
		<?php echo $DevisInfos['numero_devis']; ?>
		<br><br>
		<span style="font-size: 14px; font-weight: bold;">N° CLIENT</span>
		<br>
		<?php echo $DevisInfos['id_client']; ?>
		<br>
		<br>
		<span style="font-size: 14px; font-weight: bold;">DATE</span>
		<br>
		<?php echo TransformDateFR($DevisInfos['date_devis']); ?>
		<br>
	</p>

	<p style="padding-left: 10px;">
		SARL au capital de 200 €<br>
		822 097 366 RCS Marseille<br>
		SIRET : 822 097 366 00014<br>
		TVA Intracom: FR 83 822 097 366<br>
		APE : 7021Z<br>
		caroline@watsagency.fr
	</p>

	<br><br>

	<h2>
		<?php echo strtoupper($ClientInfos['nom_societe']); ?><br>
		<?php echo $Address_Line1; ?><br>
		<?php echo $Address_Line2; ?>
	</h2>

	<br>








	<!-- VISIBLE ONLY IF PAID -->
	<?php if($DevisInfos['statut'] == "1") { ?>
	<p>
		<b>Mode de réglement :</b> <?php echo $DevisInfos['type_reglement']; ?><br>
		<b>Date du paiement :</b> <?php echo TransformDateFR($DevisInfos['date_paiement']); ?><br>
	</p>
	<?php } ?>
	<!-- --------------------- -->

	<br><br>











	<table class="designations-table">
		<tr>
			<th>DÉSIGNATIONS</th>
			<th>QTE</th>
			<th>PU HT</th>
			<th>TOTAL HT</th>
		</tr>

		<?php foreach($DevisDesigs as $presta) { ?>
		<tr>
			<td style="text-align: left; width:40%;"><?php echo ucfirst($presta['designation']); ?></td>
			<td><?php echo $presta['quantite']; ?></td>
			<td><?php echo FormatEuro($presta['montant_ht']); ?></td>
			<td><?php echo FormatEuro($presta['montant_ht'] * $presta['quantite']); ?></td>
		</tr>
		<?php } ?>
	</table>

	<br><br>










<div class="garder_samepage">



	<table class="tableau2">
		<tr>
			<td style="width:40%; text-align: left;">TOTAL HT</td>
			<td style="text-align: right;"><?php echo FormatEuro($DevisInfos['total_ht']); ?></td>
		</tr>
		<tr>
			<td style="width:40%; text-align: left; border: none">NET HT</td>
			<td style="text-align: right; border: none"><?php echo FormatEuro($DevisInfos['total_ht']); ?></td>
		</tr>
		<tr>
			<td style="width:40%; text-align: left;">TVA</td>
			<td style="text-align: right;"><?php echo FormatEuro(ConvertTTC($DevisInfos['total_ht']) - $DevisInfos['total_ht']); ?></td>
		</tr>
		<tr>
			<td style="width:40%; text-align: left; border: none">TOTAL TTC</td>
			<td style="text-align: right; border: none"><?php echo FormatEuro(ConvertTTC($DevisInfos['total_ht'])); ?></td>
		</tr>
		<tr>
			<td style="width:40%; text-align: left; font-weight: bold; border: none; color: #FF4961;">NET À PAYER</td>
			<td style="text-align: right; border: none; color: #FF4961;"><?php echo FormatEuro(ConvertTTC($DevisInfos['total_ht'])); ?></td>
		</tr>
		<tr>
			<td style="width:10%; border: none;"></td>
			<td style="width: 90%; text-align: right; font-weight: bold; border: none; font-size: 18px; font-family: 'La Belle Aurore', cursive;">Merci de votre confiance !</td>
		</tr>
	</table>















	<table class="tableau3">
		<tr>
			<th>BASE HT</th>
			<th>TAUX TVA</th>
			<th>TOTAL TVA</th>
		</tr>

		<tr>
			<td><?php echo FormatEuro($DevisInfos['total_ht']); ?></td>
			<td>20%</td>
			<td><?php echo FormatEuro(ConvertTTC($DevisInfos['total_ht']) - $DevisInfos['total_ht']); ?></td>
		</tr>
	</table>

	<br><br>

	<h3>
		Domiciliation bancaire pour les règlements par virement :
	</h3>

	<table class="tableau-rib">
		<tr>
			<th>Banque</th>
			<th>Guichet</th>
			<th>N° de compte</th>
			<th style="border-right: none">Clé</th>
		</tr>
		<tr>
			<td>10096</td>
			<td>18565</td>
			<td>00094251401</td>
			<td style="border-right: none">97</td>
		</tr>
		<tr>
			<td style="font-weight: bold;">IBAN</td>
			<td colspan="3" style="border-right: none">FR76 1009 6185 6500 0942 5140 197</td>
		</tr>
	</table>

	<br><br><br>

	<p style="right: 0; position: absolute; text-align: center; font-size: 10px; margin-right: 15px">
		Toute somme non payée à l'échéance donnera lieu au paiement<br> d'une indemnité de recouvrement de 40€<br>
		(articles L441-3 et L441-6 du Code du commerce)
	</p>

	<p style="font-size: 10px;">
		Pénalité de retard (taux annuel) : <br>
		% - pas d'escompte pour paiement anticipé<br>
		En cas de retard de paiement, une pénalité égale à 3 fois le taux d'intérêt <br>
		légal sera exigible (Décret 2009-138 du 9 février 2009)
	</p>

</div>


<div class="footer"><div class="footer-content">WATS - 21, Boulevard de Tunis - 13008 Marseille</div></div>

</body>
</html>

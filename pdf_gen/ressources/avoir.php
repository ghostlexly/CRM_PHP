<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 transitional//EN">
<?php include('avoir_getinfos.php'); ?>
<html>
<head>
<title>WATS - Avoir#<?php echo $_GET['id']; ?></title>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
</meta>
<link href="ressources/css/template.css" rel="stylesheet">
</head>


<body>
	<img src="ressources/img/logo-wats-noir.png" style="width: 120px; height: auto; margin-top: 20px; padding-bottom: 10px; margin-left: 12px;">

	<p style="right: 0; position: absolute; color: gray; text-align: right; margin-top: 20px; margin-right: 10px">
		<span style="font-size: 14px; font-weight: bold;">AVOIR</span>
		<br>
		<?php echo $AvoirInfos['numero_avoir']; ?>
		<br><br>


		<span style="font-size: 14px; font-weight: bold;">N° CLIENT</span>
		<br>
		<?php echo $AvoirInfos['id_client']; ?>
		<br><br>


    <span style="font-size: 14px; font-weight: bold;">N° FACTURE</span>
		<br>
		<?php echo $AvoirInfos['numero_facture']; ?>
		<br><br>


		<span style="font-size: 14px; font-weight: bold;">DATE</span>
		<br>
		<?php echo TransformDateFR($AvoirInfos['date']); ?>
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














	<table class="designations-table">
		<tr>
			<th>DÉSIGNATIONS</th>
			<th>QTE</th>
			<th>PU HT</th>
			<th>TOTAL HT</th>
		</tr>

		<?php foreach($AvoirDesigs as $presta) { ?>
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
			<td style="text-align: right;"><?php echo FormatEuro($AvoirInfos['total_ht']); ?></td>
		</tr>
		<tr>
			<td style="width:40%; text-align: left; border: none">NET HT</td>
			<td style="text-align: right; border: none"><?php echo FormatEuro($AvoirInfos['total_ht']); ?></td>
		</tr>
		<tr>
			<td style="width:40%; text-align: left;">TVA</td>
			<td style="text-align: right;"><?php echo FormatEuro(ConvertTTC($AvoirInfos['total_ht']) - $AvoirInfos['total_ht']); ?></td>
		</tr>
		<tr>
			<td style="width:40%; text-align: left; border: none">TOTAL TTC</td>
			<td style="text-align: right; border: none"><?php echo FormatEuro(ConvertTTC($AvoirInfos['total_ht'])); ?></td>
		</tr>
		<tr>
			<td style="width:40%; text-align: left; font-weight: bold; border: none; color: #FF4961;">NET AVOIR</td>
			<td style="text-align: right; border: none; color: #FF4961;"><?php echo FormatEuro(ConvertTTC($AvoirInfos['total_ht'])); ?></td>
		</tr>
	</table>















	<table class="tableau3">
		<tr>
			<th>BASE HT</th>
			<th>TAUX TVA</th>
			<th>TOTAL TVA</th>
		</tr>

		<tr>
			<td><?php echo FormatEuro($AvoirInfos['total_ht']); ?></td>
			<td>20%</td>
			<td><?php echo FormatEuro(ConvertTTC($AvoirInfos['total_ht']) - $AvoirInfos['total_ht']); ?></td>
		</tr>
	</table>

</div>


<div class="footer"><div class="footer-content">WATS - 21, Boulevard de Tunis - 13008 Marseille</div></div>

</body>
</html>

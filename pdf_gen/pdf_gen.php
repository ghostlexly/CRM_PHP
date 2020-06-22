<?php
// CODED BY TOLGA MALKOC // http://tolga-malkoc.pe.hu
// LICENCE Open Software License v. 3.0 (OSL-3.0)
require_once('dompdf/autoload.inc.php');
use Dompdf\Dompdf;
ob_start();

try {
	if(isset($_GET['ressource']) && file_exists("ressources/$_GET[ressource].php")) {

		$PHP_Page = file_get_contents("http://$_SERVER[SERVER_NAME]/pdf_gen/ressources/$_GET[ressource].php?$_SERVER[QUERY_STRING]");
		

			
			

			// instantiate and use the dompdf class
			$dompdf = new Dompdf();
			$dompdf->set_option('isHtml5ParserEnabled', true);
			$dompdf->set_option('isRemoteEnabled', true);
			$dompdf->loadHtml($PHP_Page);

			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('A4', 'portrait');

			// Render the HTML as PDF
			$dompdf->render();

			// Output the generated PDF to Browser
			$dompdf->stream("facture_wats.pdf", array("Attachment" => false));

		
	} else {
		echo "Un problème est survenu durant la mise en page de votre PDF. Veuillez réessayer.";
	}
} catch (Exception $e) {
	ob_end_clean();
	echo "Un problème est survenu durant la génération de votre PDF. Veuillez réessayer.";
}
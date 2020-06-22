// Calcul HT - Designation prestation
function Calculs_HT_Prestations() {
 sleep(500).then(() => {	
	$(".Prestation_Ligne").each(function(itm) {
		var prestation = this;

		// Lancer On Load une première fois
		Executer_Calculs_HT_Prestations(prestation);

		// Entree Prix Unit
		$(this).find('#prix_unitaire').keyup(function() {
			Executer_Calculs_HT_Prestations(prestation);
		});


		// Entree Quantite Unit
		$(this).find('#quantite').keyup(function() {
			Executer_Calculs_HT_Prestations(prestation);
		});

	});
 });	
}


function Executer_Calculs_HT_Prestations(prestation) {
	var Prix_Unit = $(prestation).find('#prix_unitaire').val();
	var Quantite_Unit = $(prestation).find('#quantite').val();

	if(Prix_Unit !== '' && Quantite_Unit !== '') {
		var Resultat_HT = (parseFloat(Prix_Unit) * parseFloat(Quantite_Unit)).toFixed(2);		
		Resultat_HT = humanizeNumber(Resultat_HT);
		$(prestation).find('#montant').val(Resultat_HT + ' €');
		Calculs_HT_et_TTC_Total();
	} else {
		$(prestation).find('#montant').val('0.00 €');
		$("[name='montant_total_ht']").val('-- €');
		$("[name='montant_total_ttc']").val('-- €');
	}
}


$(function(){
	Calculs_HT_Prestations();
});



// Calculs HT et TTC total
function Calculs_HT_et_TTC_Total() {
	var C_Total_HT = "0.00";
	var C_Total_TTC = "0.00";


	$(".Prestation_Ligne").each(function(itm) {
		var Prix_Unit = $(this).find('#prix_unitaire').val();
		var Quantite_Unit = $(this).find('#quantite').val();

		var Resultat_HT = (parseFloat(Prix_Unit) * parseFloat(Quantite_Unit)).toFixed(2);
		C_Total_HT = (parseFloat(C_Total_HT) + parseFloat(Resultat_HT)).toFixed(2);
	});


	C_Total_TTC = (C_Total_HT * (1 + (20 / 100))).toFixed(2);

	C_Total_HT = humanizeNumber(C_Total_HT);
	C_Total_TTC = humanizeNumber(C_Total_TTC);
	
	$("[name='montant_total_ht']").val(C_Total_HT);

	if($("[name='tva_applicable']").is(':checked')) {
		$("[name='montant_total_ttc']").val(C_Total_TTC);
	} else {
		$("[name='montant_total_ttc']").val('-- €');
	}
}





// Enlever total TTC si la case est décochée
$(function() {
	$("[name='tva_applicable']").change(function() {
		if($("[name='tva_applicable']").is(':checked')) {
			Calculs_HT_et_TTC_Total();
		} else {
			$("[name='montant_total_ttc']").val('-- €');
		}
	});
});
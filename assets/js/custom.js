// Affichage paiement après checkbox
$(function(){
	$("[name='facture_reglee']").change(function() {

		if ($(this).is(":checked")==true) {
			$("#moyen_de_paiement").css("display","block");
		}
		else {
			$("#moyen_de_paiement").css("display","none");
		}

	});
});




function humanizeNumber(n) {
  n = n.toString()
  while (true) {
    var n2 = n.replace(/(\d)(\d{3})($| |\.)/g, '$1 $2$3')
    if (n == n2) break
    n = n2
  }
  return n
}

// sleep time expects milliseconds
function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}






function ConfirmDelete(r, url)
{
  var x = confirm("Êtes-vous sûr de vouloir supprimer cette entrée? - C'est irrécupérable.");
  if (x) {
      	 // *** Bouton Oui cliqué ***
      		
		  //Sécurité
		  var url_test = url.toLowerCase();
		  if(url_test.startsWith('http')) {
		  	console.log('Tentative XSS bloquée. Bien tenté ;)');
		  	url = "";
		  	return false;
		  }
	
			//Requête
			var request = $.get(url);

			//Error Handler
		      request.fail(function() {
		          //MSG
		          $.notify({
		            // options
		            message: "Un problème est survenu dans le POST AJAX. <br> Veuillez réessayer."
		          },{
		            // settings
		            type: 'danger',
		            animate: {
		            enter: 'animated fadeInDown',
		            exit: 'animated fadeOutUp'
		            }
		          });

		          return false;
		      });



		 //Success Handler
      request.done(function(result) {

			//MSG
			$.notify({
				// options
				message: "La ligne a bien été supprimée définitivement." 
			},{
				// settings
				type: 'success',
				animate: {
				enter: 'animated fadeInDown',
				exit: 'animated fadeOutUp'
				}
			});




			//SUPPRESSION ROW IN TABLE
			r = r.parentNode.parentNode.parentNode.parentNode;
			var index_in_table = r.rowIndex;
			document.getElementById("invoices-list").deleteRow(index_in_table);

		});

			return false;
  } else {
   			 return false;
  }
}










function AjaxPOST_Notify(r, messagenotify, url)
{
    //Sécurité
    var url_test = url.toLowerCase();
    if(url_test.startsWith('http')) {
      console.log('Tentative XSS bloquée. Bien tenté ;)');
      url = "";
      return false;
    }


      //Requête AJAX
      var request = $.get(url);
        
      //Error Handler
      request.fail(function() {
          //MSG
          $.notify({
            // options
            message: "Un problème est survenu dans le POST AJAX. <br> Veuillez réessayer."
          },{
            // settings
            type: 'danger',
            animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
            }
          });
      });
      

      //Success Handler
      request.done(function(result) {
          //MSG
          $.notify({
            // options
            message: messagenotify
          },{
            // settings
            type: 'success',
            animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutUp'
            }
          });
      });

      return false;
}












function Nettoyer_Cases_TableHebergs(itm) {
	var Row_ITM = $(itm).parent().parent().parent().parent();
	
	var Cell_Date_Renouv = Row_ITM.children().eq(3);
	var Cell_Duree = Row_ITM.children().eq(4);

	Cell_Date_Renouv.text('Modification à actualisation');
	Cell_Duree.text('Modification à actualisation');
}







$(function() {
	// iCheck checkboxes activation
	$(".input-chk").iCheck({checkboxClass:"icheckbox_square-red",radioClass:"iradio_square-red"}),a.on("draw.dt",function(){$(".input-chk").iCheck({checkboxClass:"icheckbox_square-red",radioClass:"iradio_square-red"})});
});
/*=========================================================================================
		File Name: form-repeater.js
		Description: Repeat forms or form fields
		----------------------------------------------------------------------------------------
		Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
		Version: 1.0
		Author: PIXINVENT
		Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

(function(window, document, $) {
	'use strict';

	// Default
	$('.repeater-default').repeater();

	// Custom Show / Hide Configurations
	$('.file-repeater, .contact-repeater').repeater({
		show: function () {
			$(this).slideDown();
		},
		hide: function(remove) {
			if (confirm('Êtes-vous sûr de vouloir supprimer cette ligne?')) {
				$(this).slideUp(remove);
			}
		}
	});


})(window, document, jQuery);
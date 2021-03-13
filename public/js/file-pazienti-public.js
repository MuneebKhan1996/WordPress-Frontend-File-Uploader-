(function( $ ) {
	'use strict';
	$(function() {
		// Handler for .ready() called.
		$('#fp-form').on('submit', function(e){
			//e.preventDefault();
			$.ajax({
                type: 'POST',
                url: the_ajax_script.ajaxurl,
                data: {"action": "fp_file_upload_ajax" },
                
                success: function(data){
					alert(data);
				}
            });
		});
	});

})( jQuery );

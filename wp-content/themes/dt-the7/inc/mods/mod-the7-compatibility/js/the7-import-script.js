(function($) {

	$(document).ready(function() {
		$('#setting-error-presscore-import-the7-options .dt-skins-list').on('change', function() {
			var selectedSkin = $(this).val();
			the7Adapter.importPostData.defaultPreset = selectedSkin;
		});

		$('#setting-error-presscore-import-the7-options .dt-import-options').on('click', function(event) {
			event.preventDefault();

			var $button = $(this);
			var $spinner = $button.siblings('.spinner');

			$spinner.show();

			$.post(
				'options.php',
				the7Adapter.importPostData
			).success( function() {
				$spinner.hide();
				location.assign( $button.attr('href') );
			} );

			return false;
		});
	});

})(jQuery);
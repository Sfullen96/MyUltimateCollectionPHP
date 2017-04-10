$(function() {

	if($('.results').outerHeight() >= 500) {
		$('.showMoreResults').show();
	}

	$(document).on('click', '.showMoreResults', function(event) {
		$('.results').css('max-height', 'none');
		$(this).hide();
	});

});
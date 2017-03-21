$(function() {

	var editing = false;

	$(document).on('dblclick', '.editableTrack', function(event) {
		event.preventDefault();

		if (!editing) {
			editing = true;
			var text = $(this).text();
			var elementType = $(this).prev().prop('nodeName');
			var element = $(this);

			$(this).before('<input type="text" class="form-control editingTrack" data-id="'+ $(this).attr('id') +'" data-trackid="'+ $(this).attr('data-trackid') +'" data-itemid="'+ $(this).attr('data-itemid') +'" value="'+ text +'" />');
			$('.editingTrack').focus();
			$(this).hide();
		} else {
			alert('Finish editing current element');
		}
		
	});


	$(document).on('blur', '.editingTrack', function(event) {
		event.preventDefault();
		editing = false;

		var field = $(this).attr('data-id');
		var value = $(this).val();
		var table = $(this).attr('data-table');
		var itemId = $(this).attr('data-itemid');

		valueToSend = value.replace(/[/]/g, '-slash-');

		$.get('updateItem/' + field + '/' + valueToSend + '/' + table + '/' +itemId, function(data) {
			/*optional stuff to do after success */
		});

		
		$(this).siblings('.editableTrack').text(value);
		$(this).siblings('.editableTrack').show();
		$(this).remove();

	});

	$(document).on('keyup', '.editingTrack', function(event) {
		if (event.which == 13) {
            $('.editingTrack').blur();
        }
	});
	 
});


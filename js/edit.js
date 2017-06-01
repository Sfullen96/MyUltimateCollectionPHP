$(function() {

	var editing = false;

	$(document).on('dblclick', '.editable', function(event) {
		event.preventDefault();

		if (!editing) {
			editing = true;
			var text = $(this).text();
			var elementType = $(this).prev().prop('nodeName');
			var element = $(this);

			$(this).before('<input type="text" class="form-control editing" data-id="'+ $(this).attr('id') +'" data-table="'+ $(this).attr('data-table') +'" data-itemid="'+ $(this).attr('data-itemid') +'" value="'+ text +'" />');
			$('.editing').focus();
			$(this).hide();
		} else {
			alert('Finish editing current element');
		}
		
	});


	$(document).on('blur', '.editing', function(event) {
		event.preventDefault();
		editing = false;

		var field = $(this).attr('data-id');
		var value = $(this).val();
		var table = $(this).attr('data-table');
		var itemId = $(this).attr('data-itemid');

		valueToSend = value.replace(/[/]/g, '-slash-');
		valueToSend = encodeURI(valueToSend);

		$.get('updateItem/' + field + '/' + valueToSend + '/' + table + '/' +itemId, function(data) {
			/*optional stuff to do after success */
		});

		
		$(this).siblings('.editable').text(value);
		$(this).siblings('.editable').show();
		$(this).remove();

	});

	$(document).on('keyup', '.editing', function(event) {
		if (event.which == 13) {
            $('.editing').blur();
        }
	});
	 
});


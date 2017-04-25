$(function() {

	var editing = false;

	$(document).on('dblclick', '.editableSelect', function(event) {
		event.preventDefault();

		var field = 'listened';
		var table = 'item';
		var itemId = $(this).parents('tr').attr('data-id');
		var current = $(this).attr('data-value');
		var element = $(this);

		if (current == 1) {
			// Listened
			valueToSend = 0;
		} else {
			valueToSend = 1;
		}

		$.get('updateItem/' + field + '/' + valueToSend + '/' + table + '/' +itemId, function(data) {
			
			if (current == 1) {
				$(element).text('');
				$(element).text('No');
				$(element).attr('data-value', 0);
			} else {
				$(element).text('');
				$(element).text('Yes');
				$(element).attr('data-value', 1);
				$.get('/addListen/' + itemId, function(data) {
					if(data == '1') {
						console.log('Listen Added');
					} else {
						console.log('Could not add the listen');
					}
				});
			}

		});


		// if (!editing) {
		// 	editing = true;




		// 	var text = $(this).text();
		// 	var elementType = $(this).prev().prop('nodeName');
		// 	var element = $(this);
		// 	var id = $(this).parent('tr').attr('data-id');

		// 	$(this).before('\
		// 		<select name="listened" class="form-control editingSelect" data-id="'+ id +'" required="required">\
		// 			<option value="1"> Yes </option>\
		// 			<option value="0"> No </option>\
		// 		</select>\
		// 	');
		// 	$('.editingSelect').focus();
		// 	$(this).hide();
		// } else {
		// 	alert('Finish editing current element');
		// }
		
	});


	// $(document).on('change', '.editingSelect', function(event) {
	// 	event.preventDefault();
	// 	editing = false;

	// 	var field = 'listened';
	// 	var value = $(this).val();
	// 	var table = 'library';
	// 	var itemId = $(this).attr('data-id');

	// 	valueToSend = value.replace(/[/]/g, '-slash-');

	// 	$.get('updateItem/' + field + '/' + valueToSend + '/' + table + '/' +itemId, function(data) {
	// 		/*optional stuff to do after success */
	// 	});

		
	// 	$(this).siblings('.editableSelect').text(value);
	// 	$(this).siblings('.editableSelect').show();
	// 	$(this).remove();

	// });

	// $(document).on('keyup', '.editingSelect', function(event) {
	// 	if (event.which == 13) {
 //            $('.editingSelect').blur();
 //        }
	// });
	 
});


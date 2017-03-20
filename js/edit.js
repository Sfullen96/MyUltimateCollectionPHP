$(function() {

	var editing = false;

	$(document).on('dblclick', '.editable', function(event) {
		event.preventDefault();

		if (!editing) {
			editing = true;
			var text = $(this).text();
			var elementType = $(this).prev().prop('nodeName');
			var element = $(this);

			$(this).before('<input type="text" class="form-control editing" value="'+ text +'" />');
			$('.editing').focus();
			$(this).hide();
		} else {
			alert('Finish editing current element');
		}
		
	});


	$(document).on('blur', '.editing', function(event) {
		event.preventDefault();
		editing = false;

		var value = $(this).val();
		var field = $(this).siblings('.editable')
		$.get('updateItem', function(data) {
			/*optional stuff to do after success */
		});

		
		$(this).siblings('.editable').text(newText);
		$(this).siblings('.editable').show();
		$(this).remove();

	});
});


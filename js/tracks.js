$(function() {

	var editing = false;

	$(document).on('dblclick', '.editableTrack', function(event) {
		event.preventDefault();

		if (!editing) {
			editing = true;
			var text = $(this).text();
			var elementType = $(this).prev().prop('nodeName');
			var element = $(this);

			$(this).before('<input type="text" class="form-control editingTrack" data-id="'+ $(this).attr('id') +'" data-trackid="'+ $(this).attr('data-trackid') +'" data-itemid="'+ $(this).attr('data-itemid') +'" value="'+ text +'" data-order="'+ $(this).attr('data-order') +'" />');
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
		var itemId = $(this).attr('data-itemid');
		var order = $(this).attr('data-order');

		console.log(order);

		valueToSend = value.replace(/[/]/g, '-slash-');
		valueToSend = encodeURIComponent(valueToSend);

		$.get('/updateTrack/' + field + '/' + valueToSend + '/' + itemId + '/' + order, function(data) {
			/*optional stuff to do after success */
		});

		
		$(this).parents('tr').find('#' + field).text(value);
		$(this).parents('tr').find('#' + field).show();
		$(this).remove();

	});

	$(document).on('keyup', '.editingTrack', function(event) {
		if (event.which == 13) {
            $('.editingTrack').blur();
        }
	});

	$(document).on('click', '.addTrack', function(event) {
		event.preventDefault();
		if ($(this).parents('tr').find('input[name=trackName]').val() && $(this).parents('tr').find('input[name=duration]').val()) {
			var trackName = $(this).parents('tr').find('input[name=trackName]').val();
			var duration = $(this).parents('tr').find('input[name=duration]').val();
			var itemId = $(this).parents('tr').attr('data-itemid');
			var order = $(this).parents('tr').attr('data-id');
			var artist_id = $(this).parents('tr').attr('data-artist');
			var nextId = parseInt(order) + 1;
			var element = $(this).parents('tr');


			$.post('/track/addNewTrack', {
				trackName: trackName,
				duration: duration,
				itemId: itemId,
				order: order,
				artist: artist_id
			}, function(data) {
				if (data > 0) {

					$('.tracks').append($(element)[0].outerHTML);

					$(element).find('input[name=trackName]').parents('td').text(trackName);
					$(element).find('input[name=trackName]').remove();

					$(element).find('input[name=duration]').parents('td').text(duration);
					$(element).find('input[name=duration]').remove();

					$(element).find('i.fa-plus').replaceWith('<i class="fa fa-times deleteTrack"></i>');
					$(element).attr('data-trackid', data);
					$(element).removeAttr('id');
					$(element).removeAttr('data-id')

					$('#newTrackTr').find('td:first-child').text(nextId);
					$('#newTrackTr').find('td:first-child').attr('data-id', nextId);
					$('#newTrackTr').attr('data-id', nextId);

				} else {
					alert('Unable to add');
				}
			});
		} else {
			alert('Please fill in required fields');
		}
	});

	$(document).on('click', '.deleteTrack', function(event) {
		event.preventDefault();
		var id = $(this).parents('tr').attr('data-trackid');
		var element = $(this).parents('tr');
		var dataId = $(this).parents('tr').find('td:first-child').text();

		var newId = parseInt(dataId);

		$.post('/track/deleteTrack', {id: id}, function(data) {
			if (data == 1) {
				$(element).hide(400);
				$('#newTrackTr').attr('data-id', newId);
				$('#newTrackTr').find('td:first-child').attr('data-id', newId);
				$('#newTrackTr').find('td:first-child').text(newId);
			} else {
				alert('Unable to delete');
			}
		});
	});
	 
});


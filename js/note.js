$(function() {

	$(document).on('click', '.addNote', function(event) {
		event.preventDefault();
		
		if($('.noteText').val() > '') {
			var note = $('.noteText').val();
			var item_id = $('.noteText').attr('data-id');

			var dateData, dateObject, dateReadable;

			dateData = "07-21-14"; //For example

			dateObject = new Date(Date.parse(dateData));

			dateReadable = dateObject.toDateString();

			$.get('/add-note/' + item_id + '/' + note, function(data) {
				$('.noteText').val('');
				$('.notes').prepend('<div class="note"><p> '+ note +' | <small> '+ data +' </small> </p><hr></div>');
			});
		} else {
			alert('Please enter a note');
		}

	});

});
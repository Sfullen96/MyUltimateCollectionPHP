$(function() {

	$(document).on('change', '.gigDate', function(event) {

		var date = $(this).val();
		var artistName = $('#artistName').val();

		$.get('/gig/getGigByDate/' + date + '/' + artistName, function(data) {

			var obj = JSON.parse(data);
			var tour = obj.tour[0];
			var venue = obj.venue[0];
			var city = obj.city[0];
			var country = obj.country[0];
			var setlist_id = obj.setlist_id[0];

			// if(obj.setlist) {
			// 	console.log(obj.setlist);
				
			// 	obj.setlist.forEach(function(key, value) {
			// 		console.log(key);
			// 		console.log(value);
			// 	});
			// }
			
			$('input[name=venue]').removeAttr('disabled').removeAttr('title').val(venue);
			$('input[name=city]').removeAttr('disabled').removeAttr('title').val(city);
			$('input[name=tour]').removeAttr('disabled').removeAttr('title').val(tour);
			$('input[name=country]').removeAttr('disabled').removeAttr('title').val(country);
			$('input[name=setlist_id]').val(setlist_id);


		});

	});

});
$(function() {

	$(document).on('change', '.gigDate', function(event) {

		var date = $(this).val();
		var artistName = $('#artistName').val();
        $('input[name=venue]').removeAttr('disabled').removeAttr('title').val('');
        $('input[name=city]').removeAttr('disabled').removeAttr('title').val('');
        $('input[name=tour]').removeAttr('disabled').removeAttr('title').val('');

		$.get('/gig/getGigByDate/' + date + '/' + artistName, function(data) {

			if( !data || !$.trim( data ) > '' ) {

				$('input[name=venue]').removeAttr('disabled').removeAttr('title').val('');
				$('input[name=city]').removeAttr('disabled').removeAttr('title').val('');
				$('input[name=tour]').removeAttr('disabled').removeAttr('title').val('');
				$('input[name=country]').removeAttr('disabled').removeAttr('title').val('UK');
				$('input[name=setlist_id]').val('0');

			} else {

				var obj = JSON.parse(data);
				var tour = obj.tour[0];
				var venue = obj.venue[0];
				var city = obj.city[0];
				var country = obj.country[0];
				var setlist_id = obj.setlist_id[0];


				if(venue) {
					$('input[name=venue]').removeAttr('disabled').removeAttr('title').animate({
						'background-color': '#333',
						'color' : '#fff'
					},
					700, function() {
						$('input[name=venue]').animate({
							'background-color' : '#fff',
							'color' : '#333'
						}, 700)
					}).val(venue);
				} else {
					$('input[name=venue]').removeAttr('disabled');
				}

				if(city) {
					$('input[name=city]').removeAttr('disabled').removeAttr('title').animate({
						'background-color': '#333',
						'color' : '#fff'
					},
					700, function() {
						$('input[name=city]').animate({
							'background-color' : '#fff',
							'color' : '#333'
						}, 700)
					}).val(city);
				} else {
					$('input[name=city]').removeAttr('disabled');
				}

				if(tour) {
					$('input[name=tour]').removeAttr('disabled').removeAttr('title').animate({
						'background-color': '#333',
						'color' : '#fff'
					},
					700, function() {
						$('input[name=tour]').animate({
							'background-color' : '#fff',
							'color' : '#333'
						}, 700)
					}).val(tour);
				} else {
					$('input[name=tour]').removeAttr('disabled');		
				}

				if(country) {
					$('input[name=country]').removeAttr('disabled').removeAttr('title').val(country);
				} else {
					$('input[name=country]').removeAttr('disabled').removeAttr('title').val('UK');
				}

				$('input[name=setlist_id]').val(setlist_id);

			}

		});

	});

	$(document).on('click', '.addSetTrack', function(event) {

		var currentTrack = $(this).parents('tr').find('.setOrder').text();
		nextTrack = parseInt(currentTrack) + 1;

		if ($(this).parents('tr').find('.setName input').val() > '') {

			var name = $(this).parents('tr').find('input').val();


			// $(this).parents('tr').find('input').attr('type', 'hidden');
			// $(this).parents('tr').find('.setName').text(name);

			$(this).parents('table').append('<tr>\
					<td class="setOrder"> '+ nextTrack +' </td>\
					<td class="setName"><input type="text" name="tracks[]" class="form-control"></td>\
					<td><i class="fa fa-plus addSetTrack"></i></td>\
				</tr>');
		} else {
			alert('Please enter a track name');
		}

	});

});
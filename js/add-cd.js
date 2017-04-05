$(function(){

	$(document).on('keyup', '.existingArtist', function(event) {

		var text = $(this).val();

		$.post('/artist/ajaxFindArtist', {'text' : text}, function(data, textStatus, xhr) {
			if(data != 'no data') {
				if(text > '') {
					$('.existingArtist').parent().find('.options').remove();
					$('.existingArtist').parent().append('<div class="options">'+ data +'</div>');
				} else {
					$('.existingArtist').val('');
					$('.existingArtist').attr('value', '');
				}
			} else {
				$('.existingArtist').parent().find('.options').remove();
			}	
		});
	});

	$(document).on('click', '.options .option', function(event) {
		event.preventDefault();
		var text = $(this).text();
		var id = $(this).attr('value');
		
		$('.existingArtist').val(text);
		$('.existingArtist').attr('value', id);

		$('.options').remove();
	});

	$(document).on('change', '#title', function(event) {
		ajaxLookup();
	});

	$(document).on('change', '.existingArtist', function(event) {
		ajaxLookup();
	});

    $( "#datepicker" ).datepicker({
    	dateFormat: 'dd-mm-yy',
    	changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1970:2017'
    });

});


function ajaxLookup() {
	if ($('#title').val() > '' && $('.existingArtist').val() > '') {
		var artist = $('.existingArtist').val();
		var album = $('#title').val();

		$.post('/LastFmApi/getInfo', 
			{
				'artist': artist,
				'album': album
			}, 
			function(data, textStatus, xhr) {
				var obj = JSON.parse(data);

				if(obj.album.hasOwnProperty('wiki')) {
					if(obj.album.wiki.hasOwnProperty('content')) {
						$('#summary').val(obj.album.wiki.content);
					}
				}

				var count = 0;

				if(obj.album.hasOwnProperty('tracks')) {
					if (obj.album.tracks.hasOwnProperty('track')) {
						obj.album.tracks.track.forEach(function(key, value) {
							var name = key.name;
							var duration = key.duration;
							var order = key['@attr'].rank;
							var minutes = Math.floor(duration / 60);
							var seconds = duration - minutes * 60;

							var finalTime = minutes + ':' + seconds;

							if(finalTime == '0:0') {
								finalTime = '0:00';
							}

							$('.tracks tbody').append(
								'<tr id="newTrackTr" data-id="" data-itemid="" data-artist="">\
									<td><input type="text" class="form-control" placeholder="Order" name="track['+ count +'][order]" id="order" value="'+ order +'" /></td>\
									<td><input type="text" class="form-control" placeholder="Track Name" name="track['+ count +'][name]" id="trackName" value="'+ name +'" /></td>\
									<td><input type="text" class="form-control" placeholder="Track Duration" name="track['+ count +'][duration]" value="'+ finalTime +'" /></td>\
								</tr>\
							');

							count++;

						});
					}
				}

				if(obj.album.hasOwnProperty('image')) {
					obj.album.image.forEach(function(key, value) {
						if(key.size == 'large') {
							$('.albumImage').append('<img src="'+ key['#text'] +'" class="img-responsive" width="250px">');
							$('.albumImage').append('<input type="hidden" name="image" value="'+ key['#text'] +'" />');
							$('.albumImage').show();
						}
					});
				}
			}
		);

		// $.get('http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=797d57115973701485bcb92ebb8ea847&artist=' + encodeURIComponent(artist) + '&album=' + encodeURIComponent(album) + '&format=json', function(data) {
		// 	var obj = JSON.parse(data);

		// 	console.log(obj.album.name);
		// });
	} else {
		// alert('Please fill in both an album and album title');
	}
}
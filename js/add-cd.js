$( function() {

	$( document ).on( 'keyup', '.existingArtist', function( event ) {

		var text = $( this ).val();

		$.post( '/artist/ajaxFindArtist', { 'text' : text }, function( data ) {
			data = $.trim( data );
			if( data != 'false' ) {
				if( text > '' ) {
					$( '.existingArtist' ).parent().find( '.options' ).remove();
					$( '.existingArtist' ).after( '<div class="options">'+ data +'</div>' );
					$( 'input[name=artist_az], #az' ).hide();
				} else {
					$( '.existingArtist' ).val( '' );
					$( '.existingArtist' ).attr( 'value', '' );
					$( 'input[name=artist_az], #az' ).show();
					$( '.options' ).remove();
				}
			} else {
				$( 'input[name=artist_az], #az' ).show();
				$( '.existingArtist' ).parent().find( '.options' ).remove();
			}	
		});
	});

	$( document ).on( 'click', '.options .option', function( event ) {
		event.preventDefault();
		var text = $( this ).text();
		var id = $( this ).attr( 'value' );
		
		$( '.existingArtist' ).val( text );
		$( '.existingArtist' ).attr( 'value', id );
		$( '.options' ).remove();
	});

	$( document ).on( 'change', '#title', function() {
		ajaxLookup();
	});

	$( document ).on( 'change', '.existingArtist', function( event ) {
		ajaxLookup();
	});

    $( "#datepicker" ).datepicker( {
    	dateFormat: 'dd-mm-yy',
    	changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: '1970:2017'
    } );

    var currentStep = 1;

    $( document ).on( 'click', '.btn-next', function() {

        if ( !validateStep( currentStep ) ) {
            showError( currentStep );
            event.preventDefault();
        } else {
            if ( currentStep > 1 ) {
                $( 'form' ).submit();
            }
            hideError( currentStep );
            switchStep( 'next', currentStep );
            currentStep++;
        }
    } );

    $( document ).on( 'click', '.btn-back', function() {

        switchStep( 'back', currentStep );
        currentStep--;

    } );

    // $( document ).on( 'submit', 'form', function() {
    //
    //     $( 'input' )
    //
    // } );

});

function showError( currentStep ) {
    $( '.addError' ).find( '#errorStep' + currentStep ).remove();
    $( '.addError' ).append( '<p id="errorStep' + currentStep + '"> Please fill in all fields </p>' );
    $( '.addError' ).show( 500 );
    $( 'html, body' ).animate({
        scrollTop: $( ".addError" ).offset().top
    }, 500);
}

function hideError( currentStep ) {
    $( '.addError' ).find( '#errorStep' + currentStep ).remove();
    var errorCount = $( '.addError' ).find( 'p' ).length;

    if ( errorCount < 1 ) {
        $( '.addError' ).hide( 500 );
    }
}

function validateStep( step ) {

    var errCount = 0;
    $( '.step' + step ).find( 'input:visible' ).each( function() {
        if ( !$( this ).val() > '' )
            errCount++;
    } );

    if ( errCount > 0 ) {
        return false;
    } else {
        return true;
    }

}

function switchStep( direction, step ) {

    if ( direction === 'next' ) {
        $( '.btn-back' ).show();
        $( '.step' + step ).hide( 500 );
        var nextStep = step += 1;
        $( '.step' + nextStep ).show( 500 );
    } else {
        $( '.btn-back' ).hide();
        $( '.step' + step ).hide( 500 );
        var nextStep = step -= 1;
        $( '.step' + nextStep ).show( 500 );
    }

}

function ajaxLookup() {
	if ( $('#title' ).val() > '' && $( '.existingArtist' ).val() > '') {
		var artist = $( '.existingArtist' ).val();
		var album = $( '#title' ).val();

		$.post('/LastFmApi/getInfo', 
			{
				'artist': artist,
				'album': album
			}, 
			function( data, textStatus, xhr ) {
				var obj = JSON.parse( data );

				if( obj.album.hasOwnProperty('wiki') ) {
					if( obj.album.wiki.hasOwnProperty('content') ) {
						$( '#summary' ).val( obj.album.wiki.content );
					}
				}

				var count = 0;

				if( obj.album.hasOwnProperty( 'tracks' ) ) {
					if ( obj.album.tracks.hasOwnProperty( 'track' ) ) {
						obj.album.tracks.track.forEach( function( key, value ) {
							var name = key.name;
							var duration = key.duration;
							var order = key['@attr'].rank;
							var minutes = Math.floor(duration / 60);
							var seconds = duration - minutes * 60;

							var finalTime = minutes + ':' + seconds;

							if( finalTime == '0:0' ) {
								finalTime = '0:00';
							}

							$( '.tracks tbody' ).append(
								'<tr id="newTrackTr" data-id="" data-itemid="" data-artist="">\
									<td><input type="text" class="form-control" placeholder="Order" name="track['+ count +'][order]" id="order" value="'+ order +'" /></td>\
									<td><input type="text" class="form-control" placeholder="Track Name" name="track['+ count +'][name]" id="trackName" value="'+ name +'" /></td>\
									<td><input type="text" class="form-control" placeholder="Track Duration" name="track['+ count +'][duration]" value="'+ finalTime +'" /></td>\
								</tr>\
							' );

							// $( '#step3Header, .step3' ).show();

							count++;

						});
					}
				}

				if( obj.album.hasOwnProperty( 'image' ) ) {
					obj.album.image.forEach(function(key, value) {
						if( key.size == 'large' ) {
							$( '.albumImage' ).append( '<img src="'+ key['#text'] +'" class="img-responsive" width="250px">' );
							$( '.albumImage' ).append( '<input type="hidden" name="image" value="'+ key['#text'] +'" />' );
							$( '.albumImage' ).show();
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
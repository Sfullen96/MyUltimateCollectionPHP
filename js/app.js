$(function(){

	var currentItem = 0; // Always gonna be 0 to start with
	var running = true; // Boolean used to pause on hover

	// The interval used for sliding the recently played on and off screen on /home
	setInterval(function() {	
		if(running === true) { // If not paused
			switchItem(currentItem); 
			if (currentItem < 4) {
				currentItem++;
			} else {
				currentItem = 0;
			}
		}
	}, 3000);
	
	// Pause the above interval if hovered
	$(document).on('mouseover', '.left', function(event) {
		running = false;
	});

	$(document).on('mouseleave', '.left', function(event) {
		running = true;
	});

	$(document).on('mouseover', '.ratingContainer i.fa', function(event) {

			var starNum = $(this).attr('id');

			starNum = starNum.replace('star', '');
			starNum = parseInt(starNum);
			starNum = starNum + 1;

			for (var i = 0; i < 10; i++) {
				if (i < starNum) {
					$('#star' + i).addClass('fa-star');
					$('#star' + i).removeClass('fa-star-o');
				} else {
					$('#star' + i).addClass('fa-star-o');
					$('#star' + i).removeClass('fa-star');
				}
				
			}

	});

	$(document).on('mouseleave', '.ratingContainer i.fa', function(event) {

			var starNum = $(this).attr('data-original-rating');

			starNum = starNum.replace('star', '');
			starNum = parseInt(starNum);

			for (var i = 0; i < 10; i++) {
				if (i < starNum) {
					$('#star' + i).addClass('fa-star');
					$('#star' + i).removeClass('fa-star-o');
				} else {
					$('#star' + i).addClass('fa-star-o');
					$('#star' + i).removeClass('fa-star');
				}
				
			}

	});

	$(document).on('click', '.ratingContainer i.fa', function(event) {
		var newRating = $(this).attr('id');
		newRating = newRating.replace('star', '');
		newRating = parseInt(newRating);
		newRating = newRating + 1;

		var item_id = $(this).attr('data-id');

		$.get('/update-rating/' + newRating + '/' + item_id, function(data) {
			$('.ratingContainer i.fa').each(function(index, el) {
				$(this).attr('data-original-rating', newRating);
			});
		});
	});

});

function switchItem(currentItem) {
	if (currentItem < 4) {
		var nextItem = currentItem + 1;
	} else {
		var nextItem = 0;
	}

	$('#item' + currentItem).stop().toggle("slide", { direction: 'left' }, 500, function(){
		$('#item' + nextItem).stop().toggle("slide", { direction: 'right' }, 500);
	});

}

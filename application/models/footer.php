
<!-- <script src="js/jquery.simplemodal.js"></script> -->
<script src="js/basic.js"></script>
<script>
	(function($) {
		var videoPanel = $('#videoProfile .tab-content');
		var firstPanel = $('.settings-section .settings-tab .tab-content:first');
		var allPanels = $('.settings-section .settings-tab .tab-content').hide();
		var button = $('.settings-section > .settings-tab');
		    
		$(' .settings-tab > .tab-head').click(function(event) {
		  	event.preventDefault();
			if ($(this).parent().hasClass('active')) {
				//console.log('testti');
				button.removeClass('active');
				$(this).next().slideUp();
			}

			else {
		    allPanels.slideUp();
		    button.removeClass('active');
		    $(this).parent().addClass('active')
		    $(this).next().slideDown(function(){
			
			
			$("html, body").animate({ scrollTop: $('.active').offset().top-131 }, 500);
			
			});
				
			}

			
			
			
			
			
			
		    return false;
		});
		
		<?= ($_GET['video'] ? 'videoPanel.slideDown();videoPanel.parent().addClass("active");' : 'firstPanel.slideDown();firstPanel.parent().addClass("active");') ?>
		
		
	})(jQuery);
	
	
	
$(function() {
	$('.edit').imgPicker({ // Apply the plugin to edit button
		el: '.avatar', // Image selector
		type: 'avatar', // Image identificator
		complete: function(image){
			
			$('#imagesrc').val(image);
			$('.avatar2').attr('src','/images/outside-directors/'+image);
			// alert(image);
			//$.get('includes/ajax/change-profile-picture.php?img='+image);                  
		}
	});

	$('.editSponsor').imgPicker({ // Apply the plugin to edit button
		el: '.avatar2', // Image selector
		type: 'avatar', // Image identificator
		
		complete: function(image){
			
			$('#imagesrc2').val(image);
			$('.avatar2').attr('src','/images/outside-directors/'+image);
			// alert(image);
			//$.get('includes/ajax/change-profile-picture.php?img='+image);                  
		}
	});
});
	
	
	
</script>
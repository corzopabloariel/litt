$(document).ready(function(){
	console.log('listo');

	$('.user-options').on('click', function(){
		console.log('click');
		$('.user-panel').slideToggle('slow');
	});


	$('input[type="file"]').change(function(){

		var fileSel = $('input[type="file"]').val();

		$(this).parent().parent().parent().find('input[type="text"]').val(fileSel);

	});

	$('.u-data-edit').on('click', function(){
		$('.u-data-panel').find('input').removeAttr('disabled');
		$('.u-data-panel').find('input').css("background", "#ccc");
	});

	$('.u-data-save').on('click', function(){
		$('.u-data-panel').find('input').attr('disabled', true);
		$('.u-data-panel').find('input').css("background", "none");
	});

	$('.c-data-edit').on('click', function(){
		$('.c-data-panel').find('input').removeAttr('disabled');
		$('.c-data-panel').find('input').css("background", "#ccc");
	});

	$('.c-data-save').on('click', function(){
		$('.c-data-panel').find('input').attr('disabled', true);
		$('.c-data-panel').find('input').css("background", "none");
	});
});
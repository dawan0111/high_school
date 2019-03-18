$(function(){
	// boothLayout
	$('#Layer_2 g').on('click', function(){
		boothFormReset();
		$(this).find('text').css('fill','#FFF').end().find('rect').css('fill','#EC008C');
		$(this).find('text').css('fill','#FFF').end().find('polyline').css('fill','#EC008C');
		$('#BoothNo').val($(this).find('text').text());
	});
	var boothFormReset = function(){
		$('#Layer_2 g').find('text').css('fill','#EC008C').end().find('rect').css('fill','#FBD9E8');
		$('#Layer_2 g').find('text').css('fill','#EC008C').end().find('polyline').css('fill','#FBD9E8');
	}

	$('[type="reset"]').on('click', function(){
		boothFormReset();
	});

	// calendarInput
	$( "#start" ).on('keyup',function(){
		$(this).val('');
	}).datepicker({
		minDate:0,
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
			if(selectedDate){
				$( "#end" ).datepicker( "option", "minDate", selectedDate );
			}
		}
	});
	$( "#end" ).on('keyup',function(){
		$(this).val('');
	}).datepicker({
		minDate:1,
		dateFormat:'yy-mm-dd',
		numberOfMonths: 1,
		onClose: function( selectedDate ) {
			$( "#start" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
});


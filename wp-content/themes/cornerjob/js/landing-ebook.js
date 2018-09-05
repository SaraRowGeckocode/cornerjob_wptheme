(function ($, root, undefined) {

	$(document).on( 'nfFormReady', function( e, layoutView ) {
		$('.nf-field-container.label-hidden').each(function(){
			var label = $(this).find('.nf-field-label label').text();
			$(this).find('.nf-field-element input:not([type="checkbox"]), .nf-field-element textarea').attr('placeholder', label);
		});
		$('.checkbox-container').each(function(){
			$(this).find('.nf-field-element').append('<span class="fake-check"></span>');
		})
		$('.checkbox-wrap').click(function(){
			$(this).find('.nf-field-element input').click();
		})
	});
	
})(jQuery, this);

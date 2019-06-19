$(function () {

	$('.tab').on('click', function () {
		let tab = $(this).data('tab');
		$('.tab').removeClass('tab_active');
		$('.tab-content').removeClass('tab-content_active');
		$(this).addClass('tab_active');
		$('.tab-content[data-tab="'+ tab +'"]').addClass('tab-content_active');
	})

})
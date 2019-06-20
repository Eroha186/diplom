$(function () {

	$('.tab').on('click', function () {
		let tab = $(this).data('tab');
		$('.tab').removeClass('tab_active');
		$('.tab-content').removeClass('tab-content_active');
		$(this).addClass('tab_active');
		$('.tab-content[data-tab="' + tab + '"]').addClass('tab-content_active');
	});

	$('.head').on('click', function () {
		$('.head').not(this).parent('.questions__acord').children('.body').removeClass('body_active');
		$('.head').not(this).children('.arrow').removeClass('arrow_active');
		$(this).parent('.questions__acord').children('.body').toggleClass('body_active');
		$(this).children('.arrow').toggleClass('arrow_active');
	})
});
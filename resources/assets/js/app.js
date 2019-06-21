$(function () {
 /*
  *  Для элементов, которые являются вкладками табов класс прописывается следующим образом
  * class=" name_class tab".
  * И никак иначе
 */
	$('.tab').on('click', function () {
		let tab = $(this).data('tab');
		let className = $(this).attr('class')
		className = className.split(' ');
		className = className[0];
		$('.tab').removeClass(''+ className +'_active');
		$('.tab-content').removeClass('content_active');
		$(this).addClass(''+ className +'_active');
		$('.tab-content[data-tab="' + tab + '"]').addClass('content_active');
	});

	$('.head').on('click', function () {
		$('.head').not(this).parent('.questions__acord').children('.body').removeClass('body_active');
		$('.head').not(this).children('.arrow').removeClass('arrow_active');
		$(this).parent('.questions__acord').children('.body').toggleClass('body_active');
		$(this).children('.arrow').toggleClass('arrow_active');
	})
});
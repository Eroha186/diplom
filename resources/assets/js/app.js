$(function () {
 /*
  *  Для элементов, которые являются вкладками табов класс прописывается следующим образом
  * class=" name_class tab".
  * И никак иначе
 */
	$('.tab').on('click', function () {
		let tab = $(this).data('tab');
		let className = $(this).attr('class');
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
	});

	$('.filter-name').on('click', function () {
		let condition = $(this).data('condition')+'';
		$(this).addClass('filter-name_active');
		switch (condition) {
			case '1':
				console.log('1');
				$(this).parent().children('.arrow-up').show();
				$(this).data('condition', '2');
				break;
			case '2':
				$(this).parent().children('.arrow-up').hide();
				$(this).parent().children('.arrow-down').show();
				$(this).data('condition', '3');
				break;
			case '3':
				$(this).parent().children('.arrow-down').hide();
				$(this).removeClass('filter-name_active');
				$(this).data('condition', '1');
				break;
		}
	});
});
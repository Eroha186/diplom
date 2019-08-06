global.$ = require('jquery');
global.select2 = require('select2');
global.Quill = require('quill');
$(function () {
    setOrder($('.filter-name[data-condition != 1]'), 1);

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
        $('.tab').removeClass('' + className + '_active');
        $('.tab-content').removeClass('content_active');
        $(this).addClass('' + className + '_active');
        $('.tab-content[data-tab="' + tab + '"]').addClass('content_active');
    });

    $('.head').on('click', function () {
        $('.head').not(this).parent('.questions__acord').children('.body').removeClass('body_active');
        $('.head').not(this).children('.arrow').removeClass('arrow_active');
        $(this).parent('.questions__acord').children('.body').toggleClass('body_active');
        $(this).children('.arrow').toggleClass('arrow_active');
    });

    $('.filter-name').on('click', function () {
        let column = $(this).attr('data-column');
        let condition = setOrder($(this));

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/publications/orderBy/' + column + '/' + condition,
            dataType: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#search').trigger('click');
            }
        });
    });

    $('.radio-button').on('click', function () {
        $('.radio-button').removeClass('radio-button_active');
        $(this).addClass('radio-button_active');
        if($(this).hasClass('by-diplom')) {
            console.log('ok');
            $('.payment-block').addClass('payment-block_active')
        } else {
            console.log('no')
            $('.payment-block').removeClass('payment-block_active')
        }
    });

    $('.search-competitions').keypress(function (e) {
        if (e.ctrlKey || e.keyCode == 13) {
            $('#search').trigger("click");
        }
    });



    $('.select2').select2();

    function setOrder(condition, flag = 0) {
        let a = 0;
        if (flag) {
            a = condition.attr('data-condition');
            a -= 1;
            a += '';
        } else {
            a = condition.attr('data-condition') + '';
        }

        $('.filter-name').removeClass('filter-name_active');
        $('.arrow-up').hide();
        $('.arrow-down').hide();
        $('.filter-name').not(condition).attr('data-condition', '1');
        condition.addClass('filter-name_active');

        if (a === NaN) {
            return
        }

        switch (a) {
            case '1':
                condition.parent().children('.arrow-up').show();
                condition.attr('data-condition', '2');
                break;
            case '2':
                condition.parent().children('.arrow-up').hide();
                condition.parent().children('.arrow-down').show();
                condition.attr('data-condition', '3');
                break;
            case '3':
                condition.parent().children('.arrow-down').hide();
                condition.removeClass('filter-name_active');
                condition.attr('data-condition', '1');
                break;
        }
        return condition.attr('data-condition');
    }

    if ($('*').is('#editor')) {
        let quill = new Quill('#editor', {
            modules: {
                toolbar: '#toolBar'
            },
            placeholder: 'Введите полное описание текста...',
            theme: 'snow'
        });
        $('.form-publication').on('submit', function () {
            let about = $('input[name=text]');
            about.val(JSON.stringify(quill.getContents()));
        });
    }

    if ($('*').is('#publication-content__text')) {
        let textPublication = JSON.parse($('#publication-content__text').val());
        let readable = new Quill('#readable');
        readable.disable();
        readable.setContents(textPublication);
    }

    let inputs = document.querySelectorAll('#upload');
    Array.prototype.forEach.call(inputs, function (input) {
        let label = document.querySelector('.file-display'),
            labelVal = label.innerHTML;
        input.addEventListener('change', function (e) {
            let fileName = '';
            if (this.files && this.files.length > 1)
                fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            else
                fileName = e.target.value.split('\\').pop();
            if (fileName)
                document.querySelector('.file-display').innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });
    });
});
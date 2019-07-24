// import('vendor.js');
global.$ = require('jquery');
global.select2 = require('select2');
global.Quill = require('quill');
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
        let condition = $(this).attr('data-condition') + '';
        let column = $(this).attr('data-column');

        $('.filter-name').removeClass('filter-name_active');
        $('.arrow-up').hide();
        $('.arrow-down').hide();
        $('.filter-name').not($(this)).attr('data-condition', '1');
        $(this).addClass('filter-name_active');

        switch (condition) {
            case '1':
                $(this).parent().children('.arrow-up').show();
                $(this).attr('data-condition', '2');
                break;
            case '2':
                $(this).parent().children('.arrow-up').hide();
                $(this).parent().children('.arrow-down').show();
                $(this).attr('data-condition', '3');
                break;
            case '3':
                $(this).parent().children('.arrow-down').hide();
                $(this).removeClass('filter-name_active');
                $(this).attr('data-condition', '1');
                break;
        }

        condition = $(this).attr('data-condition') + ''

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
                $('.publications-list > .container').html(response);
            }
        });
    });

    $('.radio-button').on('click', function () {
        $('.radio-button').removeClass('radio-button_active');
        $(this).addClass('radio-button_active');
    });

    $('.form-publication').on('submit', function () {
        let about = $('input[name=text]');
        about.val(JSON.stringify(quill.getContents()));
    });

    $('.search-competitions').keypress(function (e) {
        if (e.ctrlKey || e.keyCode == 13) {
            $('#search').trigger("click");
        }
    });

    $('#search').on('click', function () {
        let request = $('.search-competitions').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'publications/search/' + request,
            dataType: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                if(!response.status) {
                    $('.publications-list > .container').html('<div class="error-search">'+ response.error +'</div>');
                } else {
                    $('.publications-list > .container').html(response);
                }
            }
        });
    });

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


    $('.select2').select2();

    if ($('*').is('#editor')) {
        let quill = new Quill('#editor', {
            modules: {
                toolbar: '#toolBar'
            },
            placeholder: 'Введите полное описание текста...',
            theme: 'snow'
        });
    }

    if ($('*').is('#publication-content__text')) {
        let textPublication = JSON.parse($('#publication-content__text').val());
        let readable = new Quill('#readable');
        readable.disable();
        readable.setContents(textPublication);
    }

});
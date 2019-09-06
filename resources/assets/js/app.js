global.$ = require('jquery');
global.select2 = require('select2');
global.Quill = require('quill');
$(function () {
    setOrder($('.filter-name[data-condition != 1]'), 1);

    function countCash() {
        let elementWithMoney = $('.payment-cash');
        let priceForService = [];
        let countCash = 0;
        elementWithMoney.each(function () {
            priceForService.push($(this).text());
        });
        priceForService.forEach((i) => {
            countCash += +i;
        });
        return countCash;
    }

    let maxValue = 0;
    let cashElement = '';
    let cash = 0;
    if ($('*').is('.payment')) {
        cash = countCash();
        cashElement = $('#cash');
        maxValue = $('#coins-number').attr('max');
        cashElement.text(cash);
    }

    if ($('*').is('#editor')) {
        let quill = new Quill('#editor', {
            modules: {
                toolbar: '#toolBar'
            },
            placeholder: 'Введите полное описание текста...',
            theme: 'snow'
        });
        let value = $('input[name=text]').attr('data-value');
        if(value) {
            quill.setContents(JSON.parse(value));
        }
        let radioButton = $('input[type=radio]');
        radioButton.each(function() {
            if(this.getAttribute('data-check')) {
                this.parentNode.classList.toggle('radio-button_active');
                if(this.getAttribute('data-check')) {
                    this.setAttribute('checked', 'checked');
                }
                if(this.value != 1){
                    $('.payment-block').removeClass('payment-block_active')
                }
            }
        })

        $('.form-publication').on('submit', function () {
            let about = $('input[name=text]');
            about.val(JSON.stringify(quill.getContents()));
        });

        $('#login-form-publication').on('submit', function (e) {
            let about = $('input[name=text]');
            about.val(JSON.stringify(quill.getContents()));
            console.log($('.form-publication').serialize());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/publicationSaveSession',
                type: 'POST',
                data: $('.form-publication').serialize(),
            });
        })
    }


    if ($('*').is('#publication-content__text')) {
        let textPublication = JSON.parse($('#publication-content__text').val());
        let readable = new Quill('#readable');
        readable.disable();
        readable.setContents(textPublication);
    }

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

    $('.filter-name-publications').on('click', function () {
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

    $('.filter-name-competitions').on('click', function () {
        let column = $(this).attr('data-column');
        let condition = setOrder($(this));
        console.log('ok');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/competitions/orderBy/' + column + '/' + condition,
            dataType: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#search').trigger('click');
            }
        });
    });

    $('.filter-name-express').on('click', function () {
        let column = $(this).attr('data-column');
        let condition = setOrder($(this));
        console.log('ok');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/express-competitions/' + column + '/' + condition,
            dataType: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                $('#search').trigger('click');
            }
        });
    });

    $('.filter-name-competition').on('click', function () {
        let column = $(this).attr('data-column');
        let condition = setOrder($(this));
        console.log('ok');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/competition/orderBy/' + column + '/' + condition,
            dataType: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                $('.search-competition').submit();
            }
        });
    });


    $('.radio-button').on('click', function () {
        $('.radio-button').removeClass('radio-button_active');
        $(this).addClass('radio-button_active');
        if ($(this).hasClass('by-diplom')) {
            $('.payment-block').addClass('payment-block_active')
        } else {
            $('.payment-block').removeClass('payment-block_active')
        }
    });

    $('.search-competitions').keypress(function (e) {
        if (e.ctrlKey || e.keyCode == 13) {
            $('#search').trigger("click");
        }
    });

    $('#coins-number').bind('keyup mouseup', function () {
        if ($('#uses-coins').is(':checked')) {
            let numberCoins = $(this).val();
            console.log(numberCoins);
            console.log(maxValue);
            if (numberCoins > +maxValue) {
                console.log('ok')
                cashElement.text(+cash - maxValue);
            } else {
                cashElement.text(+cash - numberCoins);
            }
        }
    });

    $('#uses-coins').on('click', function () {
        if ($(this).hasClass('click')) {
            $(this).attr('value', 0);
            $('#coins-number').prop('readonly', true);
        } else {
            $(this).attr('value', 1);
            $('#coins-number').prop('readonly', false);
        }

        $(this).toggleClass('click')
    });

    $('#submit-form-publication').on('click', function (e) {
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/authCheck/' + $('#email').val(),
            dataType: 'json',
            type: 'POST',
            contentType: false,
            processData: false,
            success: function (response) {
                response = response['auth'];
                console.log(response)
                switch (response) {
                    case 0:
                    case 1:
                        $('.form-publication').submit();
                        break;
                    case 2:
                        $('.modal').show();
                        break;
                }
            }
        });
    });


    $('.close').on('click', function () {
        $('.modal').hide();
    });

    $('.select2').select2();

    $('.filter-nomination').on('click', function () {
        $('.filter-nomination').removeClass('filter-nomination_active');
        $(this).addClass('filter-nomination_active');
        let value = $(this).attr('data-value');
        console.log(value);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/competition-filter/' + value,
            type: 'POST',
            success: function (response) {
                $('.search-competition').submit();
            }
        })
    })

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
            return false;
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
    };


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
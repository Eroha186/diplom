global.$ = require('jquery');
window.$ = window.jQuery = require('jquery');
window.jQuery = $;
const fancybox = require('@fancyapps/fancybox');
const fancyboxCSS = require('@fancyapps/fancybox/dist/jquery.fancybox.min.css');

// window.Popper = require('popper.js/dist/umd/popper.js').default;
global.bootstrap = require('bootstrap');
global.select2 = require('select2');
global.Quill = require('quill');
global.dmUploader = require('dm-file-uploader');
import Headroom from "headroom.js";
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
    let cashInput = '';
    let cash = 0;
    if ($('*').is('.payment')) {
        cash = countCash();
        cashElement = $('#cash');
        cashInput = $('#cash_input');
        maxValue = $('#coins-number').attr('max');
        cashElement.text(cash);
        cashInput.val(cash);
    }



    const header = document.querySelector("header");
    
    const headroom = new Headroom(header);
    headroom.init();

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

     $('.filter-name-arch-competitions').on('click', function () {
        let column = $(this).attr('data-column');
        let condition = setOrder($(this));
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/arch-competition/orderBy/' + column + '/' + condition,
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
            if (numberCoins > +maxValue) {
                cashElement.text(+cash - maxValue);
                cashInput.val(+cash - maxValue)
            } else {
                cashElement.text(+cash - numberCoins);
                cashInput.val(+cash - numberCoins)
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


     $('.nav-link-dropdown').on('click', function(e){
        e.preventDefault();
        $(this).parent().find('.dropdown-mmenu').slideToggle();
    })

     // $('a[data-fancybox="gallery"]').fancybox();
    // $('li.dropdown').on('click', function(){
    //     $(this).children('.dropdown-menu').toggleClass('show');
    // })

    $('.hamburger').on('click', function(){
        $('.mmenu').toggleClass('menu_active');
        $(this).toggleClass('is-active');
        $('#wrapper').toggleClass('content-active');
        $('body').toggleClass('body_overflow');
    })


    $('.close').on('click', function () {
        $('.modal').hide();
    });

    $('.select2').select2();
    $('.select-filter').select2();

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

    $('.adding').on('click', function () {
        $('.list-body__item').removeClass('list-body__item_active');
        $('.edition-form').removeClass('form_active');
        $('.add-form').addClass('form_active');
    })
    /*
        РЕАЛИЗОВАТЬ
        Удаление некольких объектов
        Если выделенно больше одного объекта, то их можно удалить кучей
        */
        $('.list-body').on('click', '.list-body__item', function () {
            $('.list-body__item').not(this).removeClass('list-body__item_active');
            $(this).addClass('list-body__item_active');
            $('.add-form').removeClass('form_active');
            $('.edition-form').addClass('form_active');
            let value = $(this).text();
            let data_id = $(this).attr('data-id');
            $('#theme').val(value);
            $('#theme').attr('data-id', data_id);
        })

        $('.publication-themes-form button.add').on('click', function (e) {
            e.preventDefault();
            let val = $('#themes').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data: val},
                url: 'publication/change-themes/add',
                type: 'POST',
                success: function (e) {
                    resetList(e);
                }
            })
        })

        $('.publication-themes-form button.del').on('click', function (e) {
            e.preventDefault();
            let data_id = $('#theme').attr('data-id');
            let val = $('#theme').val();
            if (confirm('Вы желаете удалить запись?')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: data_id,
                    },
                    url: 'publication/change-themes/del',
                    type: 'POST',
                    success: function (e) {
                        resetList(e);
                    }
                })
            }
        })

        $('.publication-themes-form button.editing').on('click', function (e) {
            e.preventDefault();
            let data_id = $('#theme').attr('data-id');
            let val = $('#theme').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: data_id,
                    val: val
                },
                url: 'publication/change-themes/change',
                type: 'POST',
                success: function (e) {
                    resetList(e);
                }
            })
        })

        $('.competition-type-form button.add').on('click', function (e) {
            e.preventDefault();
            let val = $('#themes').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {data: val},
                url: 'competition/change-type/add',
                type: 'POST',
                success: function (e) {
                    resetList(e);
                }
            })
        })

        $('.competition-type-form button.del').on('click', function (e) {
            e.preventDefault();
            let data_id = $('#theme').attr('data-id');
            let val = $('#theme').val();
            if (confirm('Вы желаете удалить запись?')) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: data_id,
                    },
                    url: 'competition/change-type/del',
                    type: 'POST',
                    success: function (e) {
                        resetList(e);
                    }
                })
            }
        })

        $('.competition-type-form button.editing').on('click', function (e) {
            e.preventDefault();
            let data_id = $('#theme').attr('data-id');
            let val = $('#theme').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: data_id,
                    val: val
                },
                url: 'competition/change-type/change',
                type: 'POST',
                success: function (e) {
                    resetList(e);
                }
            })
        })


        function resetList(e) {
            let layout = '';
            e.forEach((res) => {
                layout += '<li class="list-body__item" data-id="' + res.id + '">' + res.name + '</li>'
            });
            $('.list-body').html('');
            $('.list-body').html(layout);
        }

        $('.place').on('change', function () {
            let place = $(this).val();
            let id = $(this).attr('data-id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'place/' + place + '/' + id,
                type: 'GET',
                success: function (e) {
                    let id = e.id;
                    $('.wrap-a-work[data-id=' + id + ']').html('<span>Место успешно добавлено</span>');
                    setTimeout(() => {
                        $('.wrap-a-work[data-id=' + id + ']').remove();
                    }, 1000)
                }
            });
        });

    // Показ подложки в админк
    $('#substrate').on('change', function () {
        let val = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'view-substrate',
            data: {val: val},
            type: 'POST',
            success: function (e) {
                const [path,] = e.url;
                if (!(path === undefined)) {
                    $('.img-example').html(`<img src="/storage/${path.url}" alt="" id="example-substrate"> <br> <h5 class="mt-lg-3">Выбранная подложка</h5>`);
                } else {
                    $('.img-example').html('');
                }
            }
        })
    });

    // показ письма
    $('#template').on('change', function () {
        let val = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'load-template',
            data: {val: val},
            type: 'POST',
            success: function (e) {
                console.log(e);
                let layout = '';
                $.each(e, function (index, value) {

                    layout += value.content.split('contenteditable="true"').join('');
                });
                $('.mail-demo').html(layout);
            }
        })
    });

    $('#education').on('change', function() {
        let val = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/ajaxLoadKinds/' + val,
            type: 'POST',
            success: function (e) {
                let layout = '';
                let data_option = $('#kind').data('option');
                if(e.length == 0) {
                    layout += '<option value="0" disabled selected style="color: #757575">Выберите уровень образования </option>'
                } else {
                    e.forEach((item) => {
                        layout += `<option `;
                        if (data_option != "" && data_option == item.id) {
                            layout += "selected"
                        }
                        layout += `value="${item.id}">${item.name}</option>`
                    })
                }
                $("#kind").html(layout);
            }
        })
    })

    $('#type').on('change', function() {
        let val = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'ajaxLoadNumberSymbolsInRelationOnType/' + val,
            type: 'POST',
            success: function (e) {
                if(e !== '') {
                    let last = e.number_symbols.toString().slice(-1);
                    let layout = '';
                    if (last === '1') {
                        layout = `(Не менее ${e.number_symbols} символа)`;
                    } else {
                        layout = `(Не менее ${e.number_symbols} символов)`;
                    }
                    $('.number-symbols').html(layout);
                }
            }
        })
    });

    $('#competition').on('change', function() {
        let val = $(this).val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'ajaxLoadNomination/' + val,
            type: 'POST',
            success: function (e) {
                let nominations = e.nominations
                let layout = '<option value="0">Номинация</option>';
                nominations.forEach((item) => {
                    layout += `<option value="${item.id}">${item.name}</option>`
                })


                $("#nomination").html(layout)
            }
        })
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

    $("#uploaderpubl").dmUploader({
        url: '/uploadfilepubl',
        //... More settings here...

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

        onInit: function(){

        },

        onNewFile: function(id, file){
            clearHtml();
            let list = $('.file-list').html();
            $('.file-list').html(list + `<div class="file-display" id="${id}">${addDotName(file.name)}</div>`)
        },

        onUploadSuccess: function(id, data) {
            createListUpload(id, data);
        }

    });

    function createListUpload (id, data){
        let element = $('#' + id);
        if(data.errors) {
            element.addClass('error-file').attr('title', data.errors).text(element.text() + ' - Ошибка загрузки');
            element.removeClass('file-display');
            return true;
        }
        element.addClass('ready-file').text(element.text() + ' - Изображение загружено');
        element.removeClass('file-display');
        $('#fileId').html(
            $('#fileId').html() + `<input type="text" name="filesId[]" class="hide" value="${data}">`
            );
    }

    function clearHtml() {
        if ($('.not_select').length > 0) {
            $('.not_select').remove();
        }
        return true;
    }

    function addDotName(name) {
        if(name.length >= 17) {
            return name.slice(0,14) + '...';
        }
        return name
    }




    if ($('*').is('#editor')) {
       const quill = new Quill('#editor', {
          bounds: '#editor',
          modules: {
            toolbar: {
                container : '#toolBar',
            }
        },
        placeholder: 'Полное описание работы...',
        theme: 'snow'
    });

       let value = $('input[name=text]').attr('data-value');
       if (value) {
        quill.setContents(JSON.parse(value));
    }

    $('#education').trigger('change');
    $('#type').trigger('change');



    $('.form-publication').on('submit', function () {
        let about = $('input[name=text]');
        about.val(JSON.stringify(quill.getContents()));
    });

    $('#login-form-publication').on('submit', function (e) {
        let about = $('input[name=text]');
        about.val(JSON.stringify(quill.getContents()));
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/publicationSaveSession',
            type: 'POST',
            data: $('.form-publication').serialize(),
        });
    })


      /**
   * Step1. select local image
   *
   */
   function selectLocalImage() {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.click();

  // Listen upload local image and save to server
  input.onchange = () => {
    const file = input.files[0];
    // file type is only image.
    if (/^image\//.test(file.type)) {
      saveToServer(file);
  } else {
      console.warn('Вы можете загрузить только изображения.');
  }
};
}

/**
 * Step2. save to server
 *
 * @param {File} file
 */
 function saveToServer(file) {
  const fd = new FormData();
  fd.append('image', file);

  console.log(file);
  $.ajax({
    url : 'publicationImageSave',
    processData: false,
    contentType: false,
    method : 'POST', 
    data : fd,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (e) {
     
     insertToEditor(e);
 }

})
}

/**
 * Step3. insert image url to rich editor.
 *
 * @param {string} url
 */
 function insertToEditor(url) {

  // push image url to rich editor.
  const range = quill.getSelection();
  quill.insertEmbed(range.index, 'image', location.origin+'/storage/'+url['path']);
  $('#fileId').append('<input type="text" name="filesId[]" class="hide" value="'+url['id']+'">')
}

// quill editor add image handler
quill.getModule('toolbar').addHandler('image', () => {
  selectLocalImage();
});

}



});
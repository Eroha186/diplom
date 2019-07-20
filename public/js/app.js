webpackJsonp([1],[
/* 0 */,
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(2);
__webpack_require__(3);
module.exports = __webpack_require__(4);


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(global) {// import('vendor.js');
global.$ = __webpack_require__(0);
global.select2 = __webpack_require__(12);
global.Quill = __webpack_require__(6);
$(function () {
    /*
     *  Для элементов, которые являются вкладками табов класс прописывается следующим образом
     * class=" name_class tab".
     * И никак иначе
    */
    $('.tab').on('click', function () {
        var tab = $(this).data('tab');
        var className = $(this).attr('class');
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
        var condition = $(this).data('condition') + '';
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

    $('.radio-button').on('click', function () {
        $('.radio-button').removeClass('radio-button_active');
        $(this).addClass('radio-button_active');
    });

    $('.form-publication').on('submit', function () {
        var about = $('input[name=text]');
        about.val(JSON.stringify(quill.getContents()));
    });

    var inputs = document.querySelectorAll('#upload');
    Array.prototype.forEach.call(inputs, function (input) {
        var label = document.querySelector('.file-display'),
            labelVal = label.innerHTML;
        input.addEventListener('change', function (e) {
            var fileName = '';
            if (this.files && this.files.length > 1) fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);else fileName = e.target.value.split('\\').pop();
            if (fileName) document.querySelector('.file-display').innerHTML = fileName;else label.innerHTML = labelVal;
        });
    });

    $('.select2').select2();

    var quill = new Quill('#editor', {
        modules: {
            toolbar: '#toolBar'
        },
        placeholder: 'Введите полное описание текста...',
        theme: 'snow'
    });

    if ($('*').is('#publication-content__text')) {
        var textPublication = JSON.parse($('#publication-content__text').val());
        var readable = new Quill('#readable');
        readable.disable();
        readable.setContents(textPublication);
    }
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(8)))

/***/ }),
/* 3 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 4 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
],[1]);
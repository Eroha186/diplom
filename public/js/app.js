/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(2);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

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
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_assets_js_components_Select2_js"],{

/***/ "./resources/assets/js/components/Select2.js":
/*!***************************************************!*\
  !*** ./resources/assets/js/components/Select2.js ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm.js");
 // Vue.component('select2', require('./Select2.vue').default)

vue__WEBPACK_IMPORTED_MODULE_0__.default.use(function () {
  return Promise.resolve(/*! import() */).then(__webpack_require__.t.bind(__webpack_require__, /*! select2 */ "./node_modules/select2/dist/js/select2.js", 23));
});
$(function () {
  // jshint ignore:line
  $(document).ready(function () {
    $('.select2').select2({
      theme: 'bootstrap',
      tags: false,
      width: '100%' //minimumResultsForSearch: Infinity,

    });
    $('.select2-tag').select2({
      theme: 'bootstrap',
      tags: true,
      width: '100%'
    });
  });
});

/***/ })

}]);
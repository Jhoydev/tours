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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ 7:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(8);


/***/ }),

/***/ 8:
/***/ (function(module, exports) {

var customer = new Vue({
    el: '#customer',
    data: {
        first_name: '',
        last_name: '',
        document_type_id: '',
        document: '',
        email: '',
        phone: '',
        mobile: '',
        address: '',
        address2: '',
        city_id: '',
        state_id: '',
        zip_code: '',
        country_id: '',
        profession: '',
        workplace: '',
        password: '',
        password_confirmation: '',
        show_password: false,
        btn_password_class: false,
        btn_password_text: '¿Cambiar contraseña?'
    },
    computed: {},
    created: function created() {},
    mounted: function mounted() {
        this.first_name = document.querySelector("#inp_first_name").value;
        this.last_name = document.querySelector("#inp_last_name").value;
        this.document_type_id = document.querySelector("#inp_document_type_id").value;
        this.document = document.querySelector("#inp_document").value;
        this.email = document.querySelector("#inp_email").value;
        this.phone = document.querySelector("#inp_phone").value;
        this.mobile = document.querySelector("#inp_mobile").value;
        this.address = document.querySelector("#inp_address").value;
        this.address2 = document.querySelector("#inp_address2").value;
        this.city_id = document.querySelector("#inp_city_id").value;
        this.state_id = document.querySelector("#inp_state_id").value;
        this.zip_code = document.querySelector("#inp_zip_code").value;
        this.country_id = document.querySelector("#inp_country_id").value;
        this.profession = document.querySelector("#inp_profession").value;
        this.workplace = document.querySelector("#inp_workplace").value;

        if ($('#password_error').val() && $.trim($('#password_error').val()) != "") {
            this.show_password = true;
            this.btn_password_class = true;

            this.btn_password_text = "Cancelar";
            this.password = '';
            this.password_confirmation = '';
        } else {
            this.password = $('#pass_secret').val();
            this.password_confirmation = $('#pass_secret').val();
        }
    },

    methods: {
        change_password: function change_password() {
            this.show_password = !this.show_password;
            this.btn_password_class = !this.btn_password_class;
            if (this.show_password) {
                this.btn_password_text = "Cancelar";
                this.password = '';
                this.password_confirmation = '';
            } else {
                this.btn_password_text = "¿Cambiar contraseña?";
                this.password = $('#pass_secret').val();
                this.password_confirmation = $('#pass_secret').val();
            }
        }
    }
});

/***/ })

/******/ });
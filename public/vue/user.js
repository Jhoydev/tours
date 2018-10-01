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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ 5:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(6);


/***/ }),

/***/ 6:
/***/ (function(module, exports) {

var user = new Vue({
    el: '#user',
    data: {
        url_permissions: '',
        roles: [],
        permissions: [],
        permission_role: [],
        permission_user: [],
        checked_permissions: [],
        rolepicked: '',
        role_user: '',
        user_id: '',
        show_permissions: false,
        show_password: false,
        btn_password_text: '¿Cambiar contraseña?',
        btn_password_class: false,
        password: '',
        c_password: '',
        oldpassword: '',
        image: '',
        delete_avatar: false
    },
    created: function created() {
        this.permissions = JSON.parse($('#permissions').val());
        this.roles = JSON.parse($('#list_roles').val());
        this.password = $('#pass_secret').val();

        if ($('#img_src').val().indexOf('default') < 0) {
            this.image = $('#img_src').val();
        }

        this.c_password = this.password;
        if ($('#error_password').text()) {
            this.change_password();
        }

        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
            for (var _iterator = this.permissions[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                var permission = _step.value;

                Vue.set(permission, 'checked', false);
                Vue.set(permission, 'disabled', false);
            }
        } catch (err) {
            _didIteratorError = true;
            _iteratorError = err;
        } finally {
            try {
                if (!_iteratorNormalCompletion && _iterator.return) {
                    _iterator.return();
                }
            } finally {
                if (_didIteratorError) {
                    throw _iteratorError;
                }
            }
        }

        this.oldpassword = $('#password').val();
        this.role_user = this.rolepicked = $('#user_role_id').val();
        this.user_id = $('#user_id').val();
        this.url_permissions = $('#url_permissions').val();
        if (this.user_id != '' && this.role_user != '') {
            this.getPermissions();
        }
    },
    mounted: function mounted() {
        $("#inp_country").change(function () {
            var id = this.value;
            var url = $('#url_states').val() + "/" + id;
            var text = "";
            var sel = $('#state_id');
            if (id) {
                blockInputsLocation(true);
                $.get(url, function (res) {
                    sel.html(text);
                    text += '<option value=""></option>';
                    $(res).each(function (index, val) {
                        text += '<option value="' + val.id + '">' + val.name + '</option>';
                    });
                    sel.html(text);
                    blockInputsLocation(false);
                    $('#city_id').html('');
                });
            }
        });
        $("#state_id").change(function () {
            var id = this.value;
            var url = $('#url_cities').val() + "/" + id;
            var text = "";
            var sel = $('#city_id');
            if (id) {
                blockInputsLocation(true);
            }
            $.get(url, function (res) {
                sel.html(text);
                text += '<option value=""></option>';
                $(res).each(function (index, val) {
                    text += '<option value="' + val.id + '">' + val.name + '</option>';
                });
                sel.html(text);
                blockInputsLocation(false);
            });
        });
    },

    methods: {
        setInputChecked: function setInputChecked() {
            var permi = [];
            permi = this.permissions.filter(function (el) {
                return el.checked === true && el.disabled === false;
            });
            permi = permi.map(function (el) {
                return el.id;
            });
            this.checked_permissions = permi;
        },
        getPermissions: function getPermissions() {
            var _this = this;

            var _iteratorNormalCompletion2 = true;
            var _didIteratorError2 = false;
            var _iteratorError2 = undefined;

            try {
                for (var _iterator2 = this.permissions[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
                    var permission = _step2.value;

                    permission.disabled = false;
                    permission.checked = false;
                }
            } catch (err) {
                _didIteratorError2 = true;
                _iteratorError2 = err;
            } finally {
                try {
                    if (!_iteratorNormalCompletion2 && _iterator2.return) {
                        _iterator2.return();
                    }
                } finally {
                    if (_didIteratorError2) {
                        throw _iteratorError2;
                    }
                }
            }

            this.show_permissions = true;
            axios.get(this.url_permissions, {
                params: {
                    "role_id": this.rolepicked,
                    "user_id": this.user_id
                }
            }).then(function (response) {
                _this.show_permissions = false;
                user.permission_role = response.data.role;
                user.permission_user = response.data.user;
                _this.setPermissions();
                _this.setInputChecked();
            }).catch(function (error) {
                console.log(error);
            });
        },
        setPermissions: function setPermissions() {
            if (this.rolepicked == 1) {
                var _iteratorNormalCompletion3 = true;
                var _didIteratorError3 = false;
                var _iteratorError3 = undefined;

                try {
                    for (var _iterator3 = this.permissions[Symbol.iterator](), _step3; !(_iteratorNormalCompletion3 = (_step3 = _iterator3.next()).done); _iteratorNormalCompletion3 = true) {
                        var permission = _step3.value;

                        Vue.set(permission, 'checked', true);
                        Vue.set(permission, 'disabled', true);
                    }
                } catch (err) {
                    _didIteratorError3 = true;
                    _iteratorError3 = err;
                } finally {
                    try {
                        if (!_iteratorNormalCompletion3 && _iterator3.return) {
                            _iterator3.return();
                        }
                    } finally {
                        if (_didIteratorError3) {
                            throw _iteratorError3;
                        }
                    }
                }
            } else {
                var _iteratorNormalCompletion4 = true;
                var _didIteratorError4 = false;
                var _iteratorError4 = undefined;

                try {
                    for (var _iterator4 = this.permissions[Symbol.iterator](), _step4; !(_iteratorNormalCompletion4 = (_step4 = _iterator4.next()).done); _iteratorNormalCompletion4 = true) {
                        var _permission = _step4.value;
                        var _iteratorNormalCompletion5 = true;
                        var _didIteratorError5 = false;
                        var _iteratorError5 = undefined;

                        try {
                            for (var _iterator5 = this.permission_role[Symbol.iterator](), _step5; !(_iteratorNormalCompletion5 = (_step5 = _iterator5.next()).done); _iteratorNormalCompletion5 = true) {
                                var permission_r = _step5.value;

                                if (_permission.slug === permission_r.slug) {
                                    Vue.set(_permission, 'checked', true);
                                    Vue.set(_permission, 'disabled', true);
                                }
                            }
                        } catch (err) {
                            _didIteratorError5 = true;
                            _iteratorError5 = err;
                        } finally {
                            try {
                                if (!_iteratorNormalCompletion5 && _iterator5.return) {
                                    _iterator5.return();
                                }
                            } finally {
                                if (_didIteratorError5) {
                                    throw _iteratorError5;
                                }
                            }
                        }

                        if (this.rolepicked == this.role_user) {
                            var _iteratorNormalCompletion6 = true;
                            var _didIteratorError6 = false;
                            var _iteratorError6 = undefined;

                            try {
                                for (var _iterator6 = this.permission_user[Symbol.iterator](), _step6; !(_iteratorNormalCompletion6 = (_step6 = _iterator6.next()).done); _iteratorNormalCompletion6 = true) {
                                    var permission_u = _step6.value;

                                    if (_permission.slug === permission_u.slug) {
                                        Vue.set(_permission, 'checked', true);
                                        Vue.set(_permission, 'disabled', false);
                                    }
                                }
                            } catch (err) {
                                _didIteratorError6 = true;
                                _iteratorError6 = err;
                            } finally {
                                try {
                                    if (!_iteratorNormalCompletion6 && _iterator6.return) {
                                        _iterator6.return();
                                    }
                                } finally {
                                    if (_didIteratorError6) {
                                        throw _iteratorError6;
                                    }
                                }
                            }
                        }
                    }
                } catch (err) {
                    _didIteratorError4 = true;
                    _iteratorError4 = err;
                } finally {
                    try {
                        if (!_iteratorNormalCompletion4 && _iterator4.return) {
                            _iterator4.return();
                        }
                    } finally {
                        if (_didIteratorError4) {
                            throw _iteratorError4;
                        }
                    }
                }
            }
        },
        change_password: function change_password() {
            this.show_password = !this.show_password;
            this.btn_password_class = !this.btn_password_class;
            if (this.show_password) {
                this.btn_password_text = "Cancelar";
                this.password = '';
                this.c_password = '';
            } else {
                this.btn_password_text = "¿Cambiar contraseña?";
                this.password = $('#pass_secret').val();
                this.c_password = $('#pass_secret').val();
            }
        },
        onFileChange: function onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length) return;
            this.createImage(files[0]);
            this.delete_avatar = false;
        },
        createImage: function createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = function (e) {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function removeImage(e) {
            this.image = '';
            this.delete_avatar = true;
        }

    }
});

/***/ })

/******/ });
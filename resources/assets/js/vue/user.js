var user = new Vue({
    el: '#user',
    data: {
        url_permissions: '',
        roles:[],
        permissions:[],
        permission_role:[],
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
    created() {
        this.permissions = JSON.parse($('#permissions').val());
        this.roles = JSON.parse($('#list_roles').val());
        this.password = $('#pass_secret').val();

        if ($('#img_src').val().indexOf('default') < 0){
            this.image = $('#img_src').val();
        }

        this.c_password = this.password;
        if  ($('#error_password').text()){
            this.change_password();
        }

        for (let permission of this.permissions) {
            Vue.set(permission, 'checked', false);
            Vue.set(permission, 'disabled', false);
        }
        this.oldpassword = $('#password').val();
        this.role_user = this.rolepicked = $('#user_role_id').val();
        this.user_id = $('#user_id').val();
        this.url_permissions = $('#url_permissions').val();
        if (this.user_id != '' && this.role_user != ''){
            this.getPermissions();
        }
    },
    methods: {
        setInputChecked(){
            var permi = [];
            permi = this.permissions.filter(el => el.checked === true && el.disabled === false);
            permi = permi.map(el => el.id);
            this.checked_permissions = permi;
        },
        getPermissions: function(){
            for (let permission of this.permissions){
                permission.disabled = false;
                permission.checked = false;
            }
            this.show_permissions = true;
            axios.get(this.url_permissions,{
                params : {
                    "role_id" : this.rolepicked,
                    "user_id" : this.user_id,
                }
            }).then(response => {
                this.show_permissions = false;
                user.permission_role = response.data.role;
                user.permission_user = response.data.user;
                this.setPermissions();
                this.setInputChecked();
            }).catch(function (error) {
                console.log(error);
            });

        },
        setPermissions: function () {
            if (this.rolepicked == 1) {
                for (let permission of this.permissions) {
                    Vue.set(permission, 'checked', true);
                    Vue.set(permission, 'disabled', true);
                }
            }else {
                for (let permission of this.permissions) {
                    for (let permission_r of this.permission_role) {
                        if (permission.slug === permission_r.slug) {
                            Vue.set(permission, 'checked', true);
                            Vue.set(permission, 'disabled', true);
                        }
                    }
                    if (this.rolepicked == this.role_user){
                        for (let permission_u of this.permission_user) {
                            if (permission.slug === permission_u.slug) {
                                Vue.set(permission, 'checked', true);
                                Vue.set(permission, 'disabled', false);
                            }
                        }
                    }
                }
            }
        },
        change_password:function (){
            this.show_password = !this.show_password;
            this.btn_password_class = !this.btn_password_class;
            if (this.show_password){
                this.btn_password_text = "Cancelar";
                this.password = '';
                this.c_password = '';
            }else{
                this.btn_password_text = "¿Cambiar contraseña?";
                this.password = $('#pass_secret').val();
                this.c_password = $('#pass_secret').val();
            }
        },
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.createImage(files[0]);
            this.delete_avatar = false;
        },
        createImage(file) {
            var image = new Image();
            var reader = new FileReader();
            var vm = this;

            reader.onload = (e) => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        removeImage: function (e) {
            this.image = '';
            this.delete_avatar = true;
        }

    }
})
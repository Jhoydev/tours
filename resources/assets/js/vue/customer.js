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
    created: function created() {
    },
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
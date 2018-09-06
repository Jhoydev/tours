var attendee = new Vue({
    el: '#attendee',
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
        city: '',
        state: '',
        zip_code: '',
        country: '',
        profession: '',
        workplace: '',
        password: '',
    },
    computed: {

    },
    mounted() {
        this.first_name = document.querySelector("#inp_first_name").value;
        this.last_name = document.querySelector("#inp_last_name").value;
        this.document_type_id = document.querySelector("#inp_document_type_id").value;
        this.document = document.querySelector("#inp_document").value;
        this.email = document.querySelector("#inp_email").value;
        this.phone = document.querySelector("#inp_phone").value;
        this.mobile = document.querySelector("#inp_mobile").value;
        this.address = document.querySelector("#inp_address").value;
        this.address2 = document.querySelector("#inp_address2").value;
        this.city = document.querySelector("#inp_city").value;
        this.state = document.querySelector("#inp_state").value;
        this.zip_code = document.querySelector("#inp_zip_code").value;
        this.country = document.querySelector("#inp_country").value;
        this.profession = document.querySelector("#inp_profession").value;
        this.workplace = document.querySelector("#inp_workplace").value;
        this.password = document.querySelector("#inp_password").value;
    }
});
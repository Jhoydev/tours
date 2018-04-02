
var roles = new Vue({
    el: '#roles',
    data: {
        roles: [],
        list_permissions:[],
        permissions:'',
        url_roles:'',
        url_permissions:'',
        rolepicked    : ''
    },
    methods:{
        getPermissions: function () {
            axios.get(this.url_roles + "/" + this.rolepicked).then(response => {
                for (let permission of this.list_permissions){
                    permission.checked = false;
                    permission.disabled = false;
                }
                this.permissions = response.data;
                this.setPermissions();
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        setPermissions: function () {
            if (this.rolepicked == 1){
                for (let permission of this.list_permissions){
                    permission.checked = true;
                }
            }else{
                for( let permission_rol of this.permissions){
                    for (let permission of this.list_permissions){
                        if (permission.slug == permission_rol){
                            permission.checked = true;
                            permission.disabled = true;
                        }
                    }
                }
            }
        }
    },
    mounted() {
        this.url_roles = $('#url_roles').val();
        this.url_permissions = $('#url_permissions').val();

        axios.get(this.url_roles).then(response => {
            this.roles = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });

        axios.get(this.url_permissions).then(response => {
            this.list_permissions = response.data;
            for (permission of this.list_permissions){
                Vue.set(permission,'checked',false);
                Vue.set(permission,'disabled',false);
            }
        })
        .catch(function (error) {
            console.log(error);
        });

    }
})
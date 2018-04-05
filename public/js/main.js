var roles = new Vue({
    el: '#roles',
    data: {
        url_roles:'',
        url_permissions:'',
        roles: [],
        list_permissions:[],
        permissions:{},
        rolepicked    : ''
    },
    computed:{
        checked_permission(){
            let list = [];
            if (this.permissions.length){
                for (item of this.list_permissions){
                    if (item.checked && item.disabled == false && this.rolepicked != 1){
                        list.push(item.id);
                    }
                }
            }
            return list.join();
        }
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
                        if (permission.slug == permission_rol.slug){
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
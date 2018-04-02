
var roles = new Vue({
    el: '#roles',
    data: {
        roles: [],
        permissions:[],
        url_roles:'',
        url_permissions:'',
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
            this.permissions = response.data;
        })
        .catch(function (error) {
            console.log(error);
        });

    }
})
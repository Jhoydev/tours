var role = new Vue({
    el: '#role',
    data: {
        name: '',
        description: '',
        permissions: []
    },
    computed: {
        nameToSlug(){
            return this.name.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        },
        permissionsCheked(){
            return this.permissions;
        }
    },
    mounted() {
        this.name = document.querySelector("#inp_name").value;
        this.description = document.querySelector("#inp_description").value;

        var inp_permissions = document.querySelector("#inp_permissions").value;
        if (inp_permissions.length > 0){
            inp_permissions = inp_permissions.split(";");
            inp_permissions.map((el) => {
                this.permissions.push( $("#"+el).val());
            });
        }

    }
});
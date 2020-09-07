<template>

</template>

<script>
    import AppStorage from "../../Helpers/AppStorage";

    export default{
        mounted(){
            AppStorage.clear();
            this.$router.push({ name : 'login' });
            Toast.fire({
                type: 'success',
                title: 'Logout Successfully!!'
            })
        }
    }

</script>

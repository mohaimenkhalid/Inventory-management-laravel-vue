<template>
    <div>
        Home
    </div>
</template>

<script>
    import User from "../Helpers/User";

    export default{
        name: 'Home',
        mounted(){
            if (!User.loggedIn()) { 	//check login or not
                this.$router.push({ name: 'login' });
            }
        },
    }

</script>

<style>

</style>

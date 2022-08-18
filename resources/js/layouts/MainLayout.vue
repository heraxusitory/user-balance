<template>
    <!--        <router-view></router-view>-->
    <div>
        <Navbar/>
        <router-view/>
        <!--        <SignUp></SignUp>-->
    </div>
</template>

<script>
import Navbar from "../components/Navbar/Navbar";
import SignUp from "../views/SignIn";

export default {
    name: "MainLayout",
    components: {Navbar, SignUp}
}
</script>

<style scoped>

</style>

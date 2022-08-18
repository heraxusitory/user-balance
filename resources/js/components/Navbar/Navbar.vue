<template>
    <div>
        <b-navbar type="dark" variant="dark">
            <b-navbar-nav>
               <b-nav-item to="/profile">Профиль</b-nav-item>
                <router-link to="/operations"><b-nav-item>История операций</b-nav-item></router-link>
<!--                <router-link to="/sign-out"><b-nav-item>Выйти</b-nav-item></router-link>-->
                <router-link to="/sign-in"><b-nav-item>Логин</b-nav-item></router-link>
            </b-navbar-nav>
        </b-navbar>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Navbar",
    data() {
      return {
      }
    },
    methods: {

    },
    computed: {
        // authenticated() {
        //     console.log(this.$store)
        //     return this.$store.getters.auth.authenticated;
        // }
    }
}
</script>

<style scoped>

</style>

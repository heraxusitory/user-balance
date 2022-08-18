<template>
    <div>
        <b-navbar type="dark" variant="dark">
            <b-navbar-nav>
               <b-nav-item to="/profile">Профиль</b-nav-item>
               <b-nav-item to="/operations">История операций</b-nav-item>
               <b-nav-item to="/sign-in">Логин</b-nav-item>
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

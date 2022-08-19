<template>
    <div>
        <b-navbar type="dark" variant="dark">
            <b-navbar-nav>
                <b-nav-item v-if="!authenticated" to="/sign-in">Логин</b-nav-item>
                <template v-else>
                    <b-nav-item to="/profile">Профиль</b-nav-item>
                    <b-nav-item to="/operations">История операций</b-nav-item>
                    <b-nav-item @click="logout">Выйти</b-nav-item>
                </template>
            </b-navbar-nav>
        </b-navbar>
    </div>
</template>

<script>

import {mapActions, mapGetters} from "vuex";
import axios from "axios";

export default {
    name: "Navbar",
    data() {
        return {}
    },
    methods: {
        ...mapActions({
            signOut: 'auth/logout'
        }),
       async logout() {
                axios.post('api/auth/logout', this.form).then((data) => {
                    this.signOut()
                    this.$router.push('/sign-in');
                }).catch((error) => {
                    console.log(error)
                }).finally(() => {
                    this.processing = false
            });
        },
    },
    computed: {
        ...mapGetters('auth', [
            'authenticated',
            // ...
        ])
    }
}
</script>

<style scoped>

</style>

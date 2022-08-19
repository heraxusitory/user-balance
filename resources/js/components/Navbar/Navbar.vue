<template>
    <div>
        <b-navbar type="dark" variant="dark">
            <b-navbar-nav>
                <b-nav-item v-if="!authenticated" to="/sign-in">Логин</b-nav-item>
                <template v-else>
                    <b-nav-item to="/profile">Профиль</b-nav-item>
                    <b-nav-item to="/operations">История операций</b-nav-item>
                </template>
            </b-navbar-nav>
        </b-navbar>
    </div>
</template>

<script>

import {mapGetters} from "vuex";

export default {
    name: "Navbar",
    data() {
        return {}
    },
    methods: {},
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

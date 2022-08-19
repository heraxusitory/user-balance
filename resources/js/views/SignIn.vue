<template>
    <div class="form-signin">
        <div class="card-body">
            <form @submit.prevent>
                <div class="form-group">
                    <input type="email" class="form-control form-control-lg" placeholder="Почта" v-model.trim="form.email"/>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" placeholder="Пароль" v-model.trim="form.password"/>
                </div>

                <button class="w-100 btn btn-lg btn-primary" @click="submit">Войти</button>
            </form>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
            processing: false,
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        async submit(event) {
            event.preventDefault()
            this.processing = true
            await axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('api/auth/login', this.form).then(({data}) => {
                    this.signIn()
                    this.$router.push('/profile');
                }).catch(({response: {data}}) => {
                }).finally(() => {
                    this.processing = false
                })
            });
        }
    }
}
</script>

<style lang="css" scoped>
body {
    display: flex;
    padding-top: 60px;
    padding-bottom: 60px;
    align-items: center;
    background-color: #f6f6f6;
}

.form-signin {
    width: 100%;
    max-width: 450px;
    margin: 20px auto;
}

.form-group {
    margin-bottom: 10px;
}

label {
    font-weight: 600;
}
</style>

<template>
    <div>
        <div>
            <b-avatar size="72px"></b-avatar>
        </div>
        <div class="main-wrapper">
            <div>
                <h3>{{ user.name }}</h3>
                <span>Почта: {{ user.email }}</span>
            </div>
            <div style="margin-left: 20px">
                <h3>Баланс</h3>
                <div v-for="(balance, key) in balances">{{
                        balance.currency.toUpperCase() + ': ' + balance.amount
                    }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import axios from "axios";

export default {
    name: "Profile",
    data() {
        return {
            balances: [],
            query: {
                limit: 5,
            }
        }
    },
    computed: {
        ...mapGetters({
            user: 'auth/user',
        })
    },
    methods: {
        async fetchBalance() {
            axios.get('api/balance').then((data) => {
                this.balances = data.data;
            }).catch((error) => {
                console.log(error)
            }).finally(() => {
                this.processing = false
            })
        },
        async fetchLastOperations() {
            axios.get('api/operations', {params: this.query}).then((data) => {
                this.operations = data.data;
            }).catch((error) => {
                console.log(error)
            }).finally(() => {
                this.processing = false
            })
        }
    },
    created() {
        this.fetchBalance();
        this.fetchLastOperations();
    },
}
</script>

<style scoped>
.main-wrapper {
    display: flex;
}
</style>

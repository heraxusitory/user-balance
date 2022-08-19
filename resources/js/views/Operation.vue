<template>
    <b-table striped hover
             :fields="fields"
             :items="operations"
             :sort-by.sync="sortBy"
             :sort-desc.sync="sortDesc">
    </b-table>
</template>

<script>
import axios from "axios";

export default {
    name: "Operation",
    data() {
        return {
            sortBy: 'created_at',
            sortDesc: false,
            operations: [],
            fields: [
                { key: 'id', sortable: false },
                { key: 'created_at', sortable: true },
                { key: 'user_balance_id', sortable: false },
                { key: 'amount', sortable: false },
                { key: 'amount_total', sortable: false },
                { key: 'amount_total_usd', sortable: false },
                { key: 'currency', sortable: false },
                { key: 'status', sortable: false },
                { key: 'vat_rate', sortable: false },
                { key: 'is_vat_inclusive', sortable: false },
                { key: 'type', sortable: false },
            ],
        }
    },
    methods: {
        async fetchLastOperations() {
            axios.get('api/operations').then((data) => {
                this.operations = data.data;
            }).catch((error) => {
            }).finally(() => {
                this.processing = false
            })
        }
    },
    created() {
        this.fetchLastOperations();
    },
}
</script>

<style scoped>

</style>

<template>
    <div class="container mt-4">
        <h1>Ajouter une commande</h1>
        <form v-on:submit="submit" class="mt-4">
            <div class="form-group">
                <label for="customers">Selectionnez un acheteur</label>
                <select v-model="selectedCustomer" class="form-control" id="customers">
                    <option v-for="customer in customers" v-bind:key="customer.id" v-bind:value="customer.id">{{ customer.firstname | capitalize }} {{ customer.lastname | capitalize }}</option>
                </select>
            </div>
            <div v-for="product in products" v-bind:key="product.sku" class="form-group row ">
                <label v-bind:for="product.sku" class="col-sm-6 col-form-label">{{ product.name }} - {{ product.price | currency }}</label>
                <div class="col-sm-3">
                    <input type="number" min="0" class="form-control" v-bind:id="product.sku" v-model="product.quantity">
                </div>
                <div class="col-sm-3 text-right">{{ product.price * product.quantity | currency }}</div>
            </div>
            <hr>
            <div class="d-flex justify-content-end">total : {{ products.reduce((sum, p) => sum + p.price * p.quantity, 0) | currency }}</div>
            <button v-bind:disabled="!gotAtLeastOneProduct" type="submit" class="btn btn-primary">Créer</button>
        </form>
        <my-loader v-if="loading" />
    </div>
</template>

<script>

    import { HumansixApi } from '../utils/CustoFetch'

    export default {
        name: 'AddOrder',
        data() {
            return {
                products: [],
                customers: [],
                selectedCustomer: null,
                loading: true
            }
        },
        computed: {
            gotAtLeastOneProduct: function () {
                return this.products.some(p => p.quantity > 0) && this.selectedCustomer !== null
            }
        },
        filters: {
            currency(value) {
                return parseFloat(value).toFixed(2).toString().concat('€')
            },
            capitalize(str) {
                return str.charAt(0).toUpperCase().concat(str.slice(1));
            }
        },
        mounted() {
            const promises = []
            promises.push(HumansixApi.products())
            promises.push(HumansixApi.customers())
            Promise.all(promises)
                .then(data => {
                    this.products = data[0].map(p => { p.quantity = 0; return p })
                    this.customers = data[1]
                    this.loading = false
                })
        },
        methods: {
            submit(e) {
                this.loading = true
                HumansixApi.createOrder({
                    customer: this.selectedCustomer,
                    products: this.products.filter(p => p.quantity > 0)
                }).then(() => {
                    this.loading = true
                })
                e.preventDefault()
            }
        }
    }
</script>

<style>
    select.form-control.multiple {
        overflow: auto;
        border-top: none;
        border-right: none;
        border-bottom: none;
        border-radius: 0;
        border-left-width: 2px;
        outline: none !important;
        box-shadow: none !important;
    }

    select option {
        height: 25px;
        line-height: 25px;
    }
</style>
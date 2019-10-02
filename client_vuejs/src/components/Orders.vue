<template>
    <div class="container mt-4">
        <h1>Orders</h1>
        <table class="table orders mt-4">
            <thead>
                <tr v-bind:class="[sortedCol, sortedDirAsc ? 'asc' : 'desc']">
                    <th class="noSort" scope="col">#</th>
                    <th class="orderDate" v-on:click="filterBy('orderDate')" scope="col">Date de commande</th>
                    <th class="status" v-on:click="filterBy('status')" scope="col">Status de la commande</th>
                    <th class="price" v-on:click="filterBy('price')" scope="col">Prix de la commande</th>
                    <th class="noSort" scope="col">Produits (quantité)</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="order in sortedOrder" v-bind:key="order.id">
                    <th scope="row">{{ order.id }}</th>
                    <td>{{ order.orderDate }}</td>
                    <td>{{ order.status }}</td>
                    <td>{{ order.price | currency }}</td>
                    <td>{{ order.cart.product | arrayOfProduct }}</td>
                </tr>
            </tbody>
        </table>
        <my-loader v-if="loading" />
    </div>
</template>

<script>

    import {HumansixApi} from '../utils/CustoFetch'

    export default {
        name: 'Orders',
        data() {
            return {
                sortedCol: "#",
                sortedDirAsc: false,
                orders: [],
                loading: true
            }
        },
        filters: {
            currency(value) {
                return parseFloat(value).toFixed(2).toString().concat('€')
            },
            arrayOfProduct(products) {
                return products.map(p => p.name.concat(' (', p.quantity, ')')).join(', ')
            }
        },
        methods: {
            filterBy(col) {
                if (this.sortedCol === col) {
                    this.sortedDirAsc = !this.sortedDirAsc
                } else {
                    this.sortedCol = col
                    this.sortedDirAsc = false
                }
            }
        },
        computed: {
            sortedOrder:function() {
                return this.orders.sort((a, b) => {
                    if (a[this.sortedCol] < b[this.sortedCol]) return this.sortedDirAsc ? 1 : -1
                    if (a[this.sortedCol] > b[this.sortedCol]) return this.sortedDirAsc ? -1 : 1
                    return 0
                })
            }
        },
        mounted() {
            HumansixApi.orders().then(orders => {
                this.orders = orders
                this.loading = false
            })
        },
    }
</script>

<style>
    .orders thead th:not(.noSort) {
        cursor: pointer;
        position: relative;
    }

    .orders thead th {
        user-select: none;
    }

    .orders .id>.id::after,
    .orders .orderDate>.orderDate::after,
    .orders .status>.status::after,
    .orders .price>.price::after {
        position: absolute;
        content: "\2191";
        right: 0;
        transition: .2s transform ease;
    }

    .orders .id.desc>.id::after,
    .orders .orderDate.desc>.orderDate::after,
    .orders .status.desc>.status::after,
    .orders .price.desc>.price::after {
        transform: rotate(-180deg);
    }
</style>
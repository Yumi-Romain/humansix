<template>
    <div class="w-100 h-100 position-relative d-flex flex-column">
        <nav v-if="loggedIn" class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Humansix</a>
            <div class="btn-group" role="group" aria-label="Basic example">
                <router-link class="btn btn-outline-primary" to="/">Liste des commandes</router-link>
                <router-link class="btn btn-outline-primary" to="/addOrder">Commander</router-link>
                <router-link class="btn btn-outline-primary" to="/importOrder">Importer des commandes</router-link>
            </div>
            <button v-on:click="logout" type="button" class="btn btn-danger ml-3">Déconnexion</button>
        </nav>
        <div class="position-relative flex-fill">
            <router-view/>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'App',
        data() {
            return {
                loggedIn: false
            }
        },
        watch: {
            $route(to) {
                if (to.path === '/login') {
                    this.loggedIn = false
                } else {
                    this.loggedIn = true
                }
            }
        },
        methods: {
            logout() {
                localStorage.clear();
                this.$router.push('/login')
            }
        },
        mounted() {
            this.loggedIn = this.$route.path !== '/login'
        }
    }
</script>
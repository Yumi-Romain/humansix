<template>
    <div style="max-width: 90%; width: 600px; margin-top: 10%" class="container">
        <h1>Login</h1>
        <form v-on:submit="submit">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input v-on:change="usernameChanges" v-model="username" v-bind:class="usernameError ? 'is-invalid' : ''" type="text" class="form-control" id="username" placeholder="Nom d'utilisateur">
                <div class="invalid-feedback" v-if="usernameError">Nom d'utilisateur incorrect</div>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input v-on:change="passwordChanges" v-model="password" v-bind:class="passwordError ? 'is-invalid' : ''" type="password" class="form-control" id="password" placeholder="Mot de passe">
                <div class="invalid-feedback" v-if="passwordError">Mot de passe incorrect</div>
            </div>
            <button type="submit" class="btn btn-primary">Connexion</button>
        </form>
    </div>
</template>

<script>
    import { HumansixApi } from '../utils/CustoFetch'

    export default {
        name: 'Login',
        data: function() {
            return {
                usernameError: false,
                passwordError: false,
                username: null,
                password: null
            };
        },
        methods: {
            submit(e) {
                if (!this.username || this.username.length <= 0) this.usernameError = true
                if (!this.password || this.password.length <= 0) this.passwordError = true
                if (!this.passwordError || !this.usernameError) {
                    HumansixApi.login(this.username, this.password)
                        .then(token => {
                            localStorage.setItem('token', token)
                            this.$router.push('/')
                        }).catch(() => {
                            this.usernameError = true
                            this.passwordError = true
                        })
                }
                e.preventDefault()
            },
            usernameChanges() {
                if (this.usernameError) this.usernameError = false
            },
            passwordChanges() {
                if (this.passwordError) this.passwordError = false
            }
        }
    }
</script>
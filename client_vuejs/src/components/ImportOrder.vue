<template>
    <div class="container mt-4">
        <h1>Importer des commandes via XML</h1>
        <form class="was-validated mt-4" v-on:submit="uploadFile">
            <div class="custom-file">
                <input v-on:change="changeHandler" type="file" class="custom-file-input" id="file" required>
                <label class="custom-file-label" for="file">{{ label }}</label>
            </div>
            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
        <my-loader v-if="loading"/>
    </div>
</template>

<script>

    import { HumansixApi } from '../utils/CustoFetch'

    export default {
        name: 'ImportOrder',
        data() {
            return {
                label: 'Choisissez un fichier xml',
                loading: false
            }
        },
        methods: {
            uploadFile(e) {
                const input = document.getElementById('file')
                if (input && input.files.length > 0) {
                    this.loading = true
                    const file = input.files[0]
                    const form = new FormData()
                    form.append('xml', file)
                    HumansixApi.uploadFile(form)
                        .then(() => {
                            this.$router.push('/')
                            this.loading = false
                        })
                        .catch(() => {
                            alert('Une erreur est survenue ... :(')
                            this.loading = false
                        })
                }
                e.preventDefault()
            },
            changeHandler() {
                const input = document.getElementById('file')
                if (input && input.files.length > 0) {
                    this.label = input.files[0].name
                } else {
                    this.label = 'Choisissez un fichier xml'
                }
            }
        }
    }
</script>

<style>
    .custom-file-label::after {
        content: "Choisir un fichier"
    }
</style>
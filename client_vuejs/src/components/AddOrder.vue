<template>
    <div style="max-width: 90%; width: 600px" class="container">
        <form v-on:submit="uploadFile">
            <div class="form-group">
                <label for="file">Example file input</label>
                <input type="file" class="form-control-file" id="file">
                <button type="submit" class="btn btn-primary">Connexion</button>
            </div>
        </form>
    </div>
</template>

<script>

    import { HumansixApi } from '../utils/CustoFetch'

    export default {
        name: 'AddOrders',
        methods: {
            uploadFile(e) {
                const input = document.getElementById('file')
                if (input && input.files.length > 0) {
                    const file = input.files[0]
                    var form = new FormData()
                    form.append('xml', file)
                    HumansixApi.uploadFile(form).then(console.log).catch(console.log)
                }
                e.preventDefault()
            },
            changeHandler(e) {
                alert(e.target.file.name)
            }
        }
    }
</script>
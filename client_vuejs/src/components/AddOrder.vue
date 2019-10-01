<template>
    <div style="max-width: 90%; width: 600px" class="container">
        <form v-on:submit="uploadFile">
            <div class="form-group">
                <label for="file">Example file input</label>
                <input type="file" class="form-control-file" id="file">
                <input type="submit" value="submit">
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
                alert(document.getElementById('file').file.name)
                // HumansixApi.uploadFile()
                e.preventDefault()
            },
            changeHandler(e) {
                alert(e.target.file.name)
            }
        }
    }
</script>
<template>
    <div class="loader-container">
        <div class="lds-dual-ring"></div>
    </div>
</template>

<script>
    export default {
        name: "Loader"
    }
</script>

<style scoped>
    .loader-container {
        position: absolute;
        height: 100%;
        top: 0;
        left: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, .33);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .lds-dual-ring {
        display: inline-block;
        width: 64px;
        height: 64px;
    }
    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 46px;
        height: 46px;
        margin: 1px;
        border-radius: 50%;
        border: 5px solid;
        border-color: #fff transparent #fff transparent;
        animation: lds-dual-ring 1.2s linear infinite;
    }
    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>
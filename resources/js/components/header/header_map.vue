<template>
    <div>
        <div class="header_main">
            <div class="header_main-in">
                <div class="header_main-in-back" @click="close"></div>
                <div class="header_main-in-title">Адрес доставки</div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "header_map",
        methods: {
            close() {
                this.$emit('close',false);
            }
        }
    }
</script>

<style scoped>
    .header_main {
        position: fixed;
        background: transparent !important;
        z-index: 20;
    }
    .header_main-in {
        background: transparent !important;
        border-bottom: none;
    }
</style>

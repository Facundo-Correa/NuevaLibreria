<template>
    <a href="javascript:void(0)" @click="click(data.permalink)">Ir a la publicacion {{ this.itemid }}</a>
</template>

<script>
export default {
    props: {
        data: {},
        name: {},
        click: {
            type: Function,
            default: () => {},
        },
        classes: {
            type: Object,
            default: () => ({
                btn: true,
                'btn-danger': true,
                'btn-sm': true,
            }),
        },
    },
    data() {
        return {
            itemid: '',
        };
    },

    mounted() {
    },
};
</script>

<style>
</style>
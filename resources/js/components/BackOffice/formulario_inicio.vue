<template>
    <div>
        <form id="000-FI">
            <input type="hidden" name="_token" :value="CSRF" style="position:absolute;">          
            <itemSelector  RequestUrl="/admin/exposiciones/obtener" ModelType="exposiciones" :ModelId="exposicion_model" Parent="inicio" :parent_id="id"></itemSelector>
            <itemSelector  RequestUrl="/admin/nuestra-editorial/obtener" ModelType="nuestra-editorial" :ModelId="nuestra_editorial_model" Parent="inicio" :parent_id="id"></itemSelector>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import itemSelector from './item-selector.vue';
export default {
    name: 'formulario_inicio',
    data() {
        return {
            CSRF: '',
        }
    },

    methods: {
        getCSRF(){
            this.CSRF = document.head.querySelector('meta[name="csrf-token"]').content;
        },
    },

    mounted() {
        this.getCSRF();
    },

    props: {
        exposicion_model: {
            type: String,
            required: false
        },
        sobre_nosotros_model: {
            type: String,
            required: false
        },
        nuestra_editorial_model: {
            type: String,
            required: false
        },
        id: {
            type: String,
            required: true
        }
    },
    components: {
        itemSelector
    }
}
</script>

<style>
</style>
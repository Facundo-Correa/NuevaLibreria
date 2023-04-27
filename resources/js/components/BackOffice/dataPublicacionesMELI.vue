<template>
    <div>
        <data-table :data="data" :columns="columns" @on-table-props-changed="reloadTable">
            <div slot="filters" slot-scope="{ tableFilters, perPage }">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <!-- <select class="form-control" v-model="tableFilters.length">
                            <option :key="page" v-for="page in perPage">{{ page }}</option>
                        </select> -->
                    </div>

                    <div class="col-md-4">
                        <!--<add :accion="accion" @closeDialog="close"></add>-->
                    </div>

                    <!-- <div class="col-md-4">
                        <input
                            name="name"
                            class="form-control"
                            v-model="buscar"
                            placeholder="Buscar publicacion"
                        /> -->
                        <!--
                        <div style="float: right; margin: 10px; margin-right: 0">
                            <button type="button" class="btn btn-outline-secondary" @click="previousPage">
                                Anterior
                            </button>
                            <button type="button" class="btn btn-outline-secondary" @click="nextPage">Siguiente</button>
                        </div>
                    -->
                    <!-- </div> -->
                </div>
            </div>
        </data-table>
    </div>
</template>

<script>
import { click } from 'dom7';
import publicacionesmelibtnverpubliVue from './publicacionesmelibtnverpubli.vue';
export default {
    data() {
        return {
            columns: [
                {
                    label: '',
                    name: 'id',
                    orderable: false,
                    event: 'click',
                    handler: this.goToPubli,
                    
                    component: publicacionesmelibtnverpubliVue,

                },
                {
                    label: 'Producto',
                    name: 'title',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
                {
                    label: 'Precio',
                    name: 'price',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
                {
                    label: 'Stock',
                    name: 'available_quantity',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
                {
                    label: 'Vendidos',
                    name: 'sold_quantity',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
            ],
            data: {},
        };
    },
    props: ['NULL', 'dprop', 'bus'],
    mounted() {
        let tempData = JSON.parse(this.dprop);
        let tempdata = [];
        tempData.map((d) => {
            tempdata.push(d.body);
        });
        this.data = {
            data: tempdata,
        };
    },
    methods: {
        reloadTable(props) {
            // || Para el tema de los filtrados, utilizar directamente el array y buscar en el || //
            // || ['Tom Harry','Tom John','John Glen','Tom Harward'].filter(function(name){return name.match(/Tom H/);}); || //

            if (props.search != '') {
                getSearchedData(props);
            } else {
            }
        },
        reload(){
            location.reload();
        },
        nextPage() {},
        previousPage() {},
        getSearchedData(props) {},
        getFilteredData(props) {},
        goToPubli(data) {
            window.open(data, "_blank");
        
        }
    },
    components: {
        publicacionesmelibtnverpubliVue,
    },
};
</script>

<style>
</style>
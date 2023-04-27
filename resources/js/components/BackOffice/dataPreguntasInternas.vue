<template>
    <div>
        <data-table :data="data" :columns="columns" @on-table-props-changed="reloadTable">
            <div slot="filters" slot-scope="{ tableFilters, perPage }">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select class="form-control" v-model="tableFilters.length">
                            <option :key="page" v-for="page in perPage">{{ page }}</option>
                        </select>

                        <button @click="eliminar" type="button" class="btn btn-danger" style="margin-top: 10px">
                            Eliminar
                        </button>
                    </div>

                    <div class="col-md-4">
                        <!--<add :accion="accion" @closeDialog="close"></add>-->
                    </div>

                    <div class="col-md-4">
                        <input
                            name="name"
                            class="form-control"
                            v-model="tableFilters.search"
                            placeholder="Buscar pregunta"
                        />

                        <div style="float: right; margin: 10px; margin-right: 0">
                            <button type="button" class="btn btn-outline-secondary" @click="previousPage">
                                Anterior
                            </button>
                            <button type="button" class="btn btn-outline-secondary" @click="nextPage">Siguiente</button>
                        </div>
                    </div>
                </div>
            </div>
        </data-table>


        <preguntasResponderModalVue
            ref="preguntasResponderModal"
        >
        </preguntasResponderModalVue>


    </div>
</template>

<script>
import dataPreguntasMELIVue from './dataPreguntasMELI.vue';
import preguntasResponderVue from './preguntasResponder.vue';
import preguntasResponderModalVue from './preguntasResponderModal.vue';
export default {
    data() {
        return {
            user: {},
            productos: [],
            estadoData: {},
            seleccionados: [],
            currentPage: 1,
            totalLength: 1,
            columns: [
                {
                    label: '',
                    name: '',
                    orderable: false,
                    /*event: 'click',
                    handler: ,
                    component: ,*/
                },
                {
                    label: 'ID',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'Usuario',
                    name: 'nombreCliente',
                    orderable: true,
                },
                {
                    label: 'Publicacion',
                    name: 'productos',
                    orderable: false,
                    classes: {
                        /*
                        btn: true,
                        'btn-success': true,
                        'btn-sm': true,
                        'btn-cls': true,
                        */
                    },
                    /* || Crear componente para ver productos || */
                    /*event: 'click',
                    handler: '',
                    component: ''*/
                },
                {
                    label: 'Estado',
                    name: 'estado',
                    orderable: true,
                },
                
                {
                    label: 'Acciones',
                    name: 'acciones',
                    orderable: false,
                    classes: {
                        /*
                        btn: true,
                        'btn-success': true,
                        'btn-sm': true,
                        'btn-cls': true,
                        */
                    },
                    /* || Crear componente para ver productos || */
                    event: 'click',
                    handler: this.openResponderModal,
                    component: preguntasResponderVue,
                },
            ],

            // || Recibir todos los objetos, meterlos en un array y asignarlos a objeto data en prop data: || //

            data: {},
            sinResponder: [],
            contestadas: [],
            showModal: false,
            tableProps: {
                length: 10,
                column: 'id',
                dir: 'DESC',
                search: '',
            },
        };
    },
    methods: {
        getData() {
            axios.post('/api/preguntas/get', {}).then((response) => {
                console.log(response);
                this.sinResponder = response.data.sinResponder.data;
                this.contestadas = response.data.contestadas.data;

                var localData = [];
                this.sinResponder.map((pregunta) => {
                    var tempData = {
                        'id': pregunta.id,
                        'nombreCliente': pregunta.Nombre_y_apellido,
                        'productos': pregunta.publicacion,
                        'estado': pregunta.respuestas == null ? 'Sin responder' : 'Respondida',
                        'pregunta': ''
                    };
                    localData.push(tempData);
                });
                
                this.contestadas.map((pregunta) => {
                    var tempData = {
                        'id': pregunta.id,
                        'nombreCliente': pregunta.Nombre_y_apellido,
                        'productos': pregunta.publicacion,
                        'estado': pregunta.respuestas == null ? 'Sin responder' : 'Respondida',
                        'pregunta': ''
                    };
                    localData.push(tempData);
                });

                this.data = {
                    data:localData
                };
            });
        },
        
        reloadTable() {

        },

        eliminar(){},
        previousPage(){},
        nextPage(){},
        seleccionar(){},
        openResponderModal(pregunta){
            this.$refs.preguntasResponderModal.open(pregunta);
        },

    },

    mounted() {
        this.getData();
    },

    components: {
        preguntasResponderVue,
        preguntasResponderModalVue
    }
};
</script>

<style></style>

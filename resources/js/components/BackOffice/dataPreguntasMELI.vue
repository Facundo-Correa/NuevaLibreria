<template>
    <div>
        <data-table :data="data" :columns="columns" @on-table-props-changed="reloadTable">
            <div slot="filters" slot-scope="{ tableFilters, perPage }">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select class="form-control" v-model="tableFilters.length">
                            <option :key="page" v-for="page in perPage">{{ page }}</option>
                        </select>
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
                        <!--
                        <div style="float: right; margin: 10px; margin-right: 0">
                            <button type="button" class="btn btn-outline-secondary" @click="previousPage">
                                Anterior
                            </button>
                            <button type="button" class="btn btn-outline-secondary" @click="nextPage">Siguiente</button>
                        </div>
                    --></div>
                </div>
            </div>
        </data-table>

        <modalpreguntasmeli
            :pregunta="this.modalPregunta"
            :respuesta="this.modalRespuesta"
            :user="this.modalUser"
            :id="this.modalId"
            :token="this.token"
            ref="modalpreguntasmeli"
        ></modalpreguntasmeli>
    </div>
</template>

<script>
import meliopenmodalpreguntavue from './meliopenmodalpregunta.vue';
export default {
    data() {
        return {
            config: {},
            data: {},
            columns: [
                {
                    label: 'Usuario',
                    name: 'user',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
                {
                    label: 'Producto',
                    name: 'producto',
                    orderable: true,
                    event: 'click',
                    // handler: this.seleccionar,
                    // component: checkboxVue,
                },
                {
                    label: 'Pregunta',
                    name: 'pregunta',
                    orderable: true,
                    event: 'click',
                    handler: this.openMELIpreguntaModal,
                    component: meliopenmodalpreguntavue,
                },
            ],
            modalPregunta: '',
            modalRespuesta: '',
            modalUser: '',
            modalId: 0,
        };
    },
    props: {
        dprop: {},
        token: '',
    },
    methods: {
        reloadTable(props) {},
        openMELIpreguntaModal(data) {
            //console.log(data);
            this.modalId = data.idPregunta;
            this.modalPregunta = data.pregunta;
            this.modalRespuesta = data.respuesta;
            this.modalUser = data.user;

            this.$refs.modalpreguntasmeli.open();
        },
    },
    mounted() {
        this.config = {
            headers: { Authorization: `Bearer ${this.token}` },
        };
        let tempdata = JSON.parse(this.dprop);

        let fdata = [];

        tempdata.questions.map((pregunta) => {
            //console.log(pregunta);
            var producto = null;
            var nickname = null;
            // || Get the user
            axios.get(`https://api.mercadolibre.com/users/${pregunta.from.id}`, {}, this.config).then((response) => {
                nickname = response.data.nickname;

                // || Get the product
                axios.get(`https://api.mercadolibre.com/items?ids=${pregunta.item_id}`).then((response2) => {
                    producto = response2.data[0].body.title;

                    var respuesta = '';
                    if (pregunta.status != 'UNANSWERED') {
                        respuesta = pregunta.answer.text;
                    }

                    var tmp = {
                        user: nickname,
                        producto: producto,
                        pregunta: pregunta.text,
                        respuesta: respuesta,
                        idPregunta: pregunta.id,
                        fecha: Date.parse(pregunta.date_created),
                    };
                    fdata.push(tmp);
                    fdata.sort((a, b) => {
                        if (a.fecha == b.fecha) {
                            return 0;
                        }

                        if (a.fecha > b.fecha) {
                            return -1;
                        }

                        return 1;
                    });

                    //console.log(fdata);

                    this.data = {
                        data: fdata,
                    };
                });
            });
        });
    },
    component: {
        meliopenmodalpreguntavue,
    },
};
</script>

<style>
.laravel-vue-datatable-thead,
.laravel-vue-datatable-tbody-tr {
    text-align: center;
}
</style>
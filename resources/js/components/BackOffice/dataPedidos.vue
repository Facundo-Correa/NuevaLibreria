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
                            placeholder="Buscar pedido"
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

        <ModalClientesVue ref="modalClientes" :data="this.user"></ModalClientesVue>
        <ModalProductosVue
            ref="modalProductos"
            :data="this.productos"
            :nombre="this.user.first_name + ' ' + this.user.last_name"
        ></ModalProductosVue>
        <ModalEstadoVue ref="modalEstado" :data="this.estadoData"></ModalEstadoVue>
    </div>
</template>

<script>
import axios from 'axios';
import checkboxVue from '../checkbox.vue';
import CambiarEstadoVue from './CambiarEstado.vue';
import etiquetasAndreaniVue from './etiquetasAndreani.vue';
import ModalClientesVue from './ModalClientes.vue';
import ModalEstadoVue from './ModalEstado.vue';
import ModalProductosVue from './ModalProductos.vue';

import verClienteVue from './VerClientes.vue';
import VerProductosVue from './VerProductos.vue';

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
                    event: 'click',
                    handler: this.seleccionar,
                    component: checkboxVue,
                },
                {
                    label: 'ID',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'Nombre del usuario',
                    name: 'nombreCliente',
                    orderable: true,
                },
                {
                    label: 'Productos',
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
                    event: 'click',
                    handler: this.verProductos,
                    component: VerProductosVue,
                },
                {
                    label: 'Costo del envio',
                    name: 'costoEnvio',
                    orderable: true,
                },
                {
                    label: 'Costo Total',
                    name: 'costoTotal',
                    orderable: true,
                },
                {
                    label: 'Dirección envio',
                    name: 'direccionEnvio',
                    orderable: true,
                },
                {
                    label: 'Estado',
                    name: 'estadoEnvio',
                    orderable: true,
                },
                {
                    label: 'Cliente',
                    name: 'cliente',
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
                    handler: this.verCliente,
                    component: verClienteVue,
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
                    handler: this.verCambiarEstado,
                    component: CambiarEstadoVue,
                },
                {
                    label: 'Envio',
                    name: 'etiquetas',
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
                    handler: this.descargarEtiquetas,
                    component: etiquetasAndreaniVue,
                },
            ],

            // || Recibir todos los objetos, meterlos en un array y asignarlos a objeto data en prop data: || //

            data: {},
            showModal: false,
            tableProps: {
                length: 10,
                column: 'id',
                dir: 'DESC',
                search: '',
            },
        };
    },
    mounted() {
        this.getData('/api/pedidos/');
    },
    methods: {
        reloadTable(props) {
            this.getData('/api/pedidos/', props);
        },
        eliminar() {
            let self = this;
            if (self.seleccionados.length == 0) {
                return null;
            }
            axios.post('/api/eliminar-pedidos', { ids: self.seleccionados }).then(() => {
                location.reload();
            });
        },
        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.getData('/api/pedidos/', this.props, this.currentPage);
            }
        },
        nextPage() {
            console.log(this.currentPage, this.totalLength);
            if (this.currentPage < this.totalLength) {
                this.currentPage++;
                this.getData('/api/pedidos/', this.props, this.currentPage);
            }
        },
        getData(url, props, pagina) {
            let self = this;
            axios.post(url, { props: props, pagina: pagina }).then((response) => {
                console.log(response);
                let responseData = response.data;
                let localData = [];

                if (props != null) {
                    responseData.data.data.map((info) => {
                        var data = {
                            nombreCliente: info.nombreCliente,
                            productos: 'Ver productos',
                            costoEnvio: '$' + info.costoEnvio,
                            costoTotal: '$' + info.costoTotal,
                            direccionEnvio: info.direccionEnvio,
                            estadoEnvio: info.estadoEnvio,
                            cliente: 'Ver cliente',
                            acciones: 'Cambiar Estado',
                            id: info.clienteID,
                            pedidoID: info.id,
                        };
                        localData.push(data);
                    });

                    self.totalLength = response.data.total;
                } else {
                    responseData.data.data.map((info) => {
                        var data = {
                            nombreCliente: info.nombreCliente,
                            productos: 'Ver productos',
                            costoEnvio: '$' + info.costoEnvio,
                            costoTotal: '$' + info.costoTotal,
                            direccionEnvio: info.direccionEnvio,
                            estadoEnvio: info.estadoEnvio,
                            cliente: 'Ver cliente',
                            acciones: 'Cambiar Estado',
                            id: info.clienteID,
                            pedidoID: info.id,
                        };
                        localData.push(data);
                    });
                    self.totalLength = response.data.total;
                }
                self.data = {
                    data: localData,
                };
            });
        },
        verCliente(data) {
            let self = this;
            axios.post('/api/obtener-usuario', { id: data.id }).then((response) => {
                self.user = response.data;
                self.openModalUser();
            });
        },
        openModalUser() {
            this.$refs.modalClientes.showModal();
        },

        verProductos(data) {
            let self = this;

            axios.post('/api/obtener-usuario', { id: data.id }).then((response) => {
                self.user = response.data;
            });

            axios.post('/api/obtener-pedidos-usuario', { id: data.pedidoID }).then((response) => {
                self.productos = JSON.parse(response.data.productos);

                setTimeout(() => {
                    self.openProductosModal();
                }, 300);
            });
        },
        openProductosModal() {
            this.$refs.modalProductos.showModal();
        },

        verCambiarEstado(data) {
            // || 6 posibles estados || //
            /*
            
                1- Pendiente
                2- Confirmado
                3- Enviado
                4- Entregado
                5- En devolucion
                6- Devuelto
            
            */

            this.estadoData = {
                estadoActual: data.estado,
                usuario: data.nombreCliente,
                estados: ['Pendiente', 'Confirmado', 'Enviado', 'Entregado', 'En devolucion', 'Devuelto'],
                idPedido: data.pedidoID,
            };

            this.openEstadoModal();
        },
        openEstadoModal() {
            setTimeout(() => {
                this.$refs.modalEstado.showModal();
            }, 100);
        },

        seleccionar(data) {
            if (this.seleccionados.includes(data.pedidoID)) {
                let index = this.seleccionados.indexOf(data.pedidoID, 0);
                this.seleccionados.splice(index, 1);
            } else {
                this.seleccionados.push(data.pedidoID);
            }
        },
        descargarEtiquetas(data) {
            axios.post('/api/andreani/download', {pedidoID: data.pedidoID}).then((response)=> {
                console.log(response);
            });
        },
    },
    components: {
        verClienteVue,
        ModalClientesVue,
        VerProductosVue,
        ModalProductosVue,
        CambiarEstadoVue,
        ModalEstadoVue,
        checkboxVue,
        etiquetasAndreaniVue,
    },
};
</script>

<style>
.laravel-vue-datatable-tbody-tr {
    text-align: center;
}

.pagination-prev-nav,
.pagination-next-nav {
    visibility: hidden;
}
</style>

<template>
    <div>
        <!-- Componente table -->
        <data-table :data="data" :columns="columns" @on-table-props-changed="reloadTable">

        </data-table>
    </div>
</template>

<script>
    import datapromoeditar from "./dataPromoEditar";
    import datapromoact from "./datapromoact";

    export default {
        mounted() {
            // || Preparar los mas vendidos, las novedades y los recomendados en data

            var mvModel = this.getModel(1);
            var novedadesModel;
            var recomendadosModel;

            // || this.data = { [ objetos{} ] } // A la hora de editar promo, enviar modelo completo como parametro.
            var localData = [
                {
                    'modelo': mvModel,
                    'nombre': 'Mas vendidos',
                    'promo_code': 1,
                },
                {
                    'modelo': novedadesModel,
                    'nombre': 'Novedades',
                    'promo_code': 2,
                },
                {
                    'modelo': recomendadosModel,
                    'nombre': 'Recomendados',
                    'promo_code': 3,
                },

            ];

            this.data = {
                data:localData
            }
        },
        data() {
            return {
                data: {},
                columns: [
                    {
                        label: 'Promocion',
                        name: 'nombre',
                        orderable: false,
                    },
                    {
                        label: 'Editar',
                        name: 'editarPromo',
                        orderable: false,
                        event: 'click',
                        handler: this.editarPromo,
                        component: datapromoeditar
                    },
                    {
                        label: 'Actualizar',
                        name: 'actualizarPromo',
                        orderable: false,
                        event:'click',
                        handler: this.updatePromo,
                        component: datapromoact
                    },
                ],
            }
        },

        methods: {
            reloadTable() {
                // || Llamar a actualización de tabla
            },

            updatePromo(data) {
                // || Actualizar promo segun codigo, luego reload table
                // || Llamar a cargado de promo si no existe.
                axios.post('/api/updateImportedPromo', {promo_code: data.promo_code}).then(function(response) {
                    location.reload();
                });

            },

            editarPromo(data) {
                axios.get(`/admin/promocions/${data.promo_code}/edit`).then((response) => {
                    window.location = `/admin/promocions/${data.promo_code}/edit`;
                });

            },

            getModel(code) {
                // || console.log(code);
            },

        },

        components: {
            datapromoact
        }
    }
</script>

<style scoped>

</style>

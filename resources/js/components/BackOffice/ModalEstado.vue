<template>
  <div class="modalEstadoBack">
      <div class="modalEstado">
            <div class="modalEstado-title">
                <h3 style="margin-top: 1.5em;">Estado del envio</h3>
                <p style="margin:0;">{{this.data.usuario}}</p>
                <p style="text-shadow: 0 0 black;">Nro. pedido: #{{this.data.idPedido}}</p>
                <b>Estado actual</b>
                <p>{{this.data.estadoActual}}</p>
            </div>

            <div class="contenedorModalEstado" style="margin-bottom: 10px;">
                <div class="row" style="display:flex; justify-content: center; align-items:center;">
                    <div class="col-4">
                        <select class="form-select estadosModal" v-model="nuevoEstado">
                            <option v-for="estado in this.data.estados" :key="estado" :value="estado">{{estado}}</option>
                        </select>
                    </div>
                </div>
            </div>

            <button @click="closeModal()" type="button" class="btn btn-success">Confirmar</button>

      </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            a: '',
            b: '',
            nuevoEstado: 0
        }
    },
    props: {
        data: Object,
        
    },
    methods: {
        showModal() {
            this.a = document.querySelector('.modalEstadoBack');
            this.b = document.querySelector('.modalEstado');

            if(this.a == null&& this.b == null ){
                this.a = document.querySelector('.modalEstadoBack-closed');
                this.b = document.querySelector('.modalEstado-closed');
            }
            
            this.a.setAttribute('class', 'modalEstadoBack-active');
            this.b.setAttribute('class', 'modalEstado-active');
        },
        closeModal() {
            this.a.setAttribute('class', 'modalEstadoBack-closed');
            this.b.setAttribute('class', 'modalEstado-closed');

            
            axios.post('/api/cambiar-estado-pedido', {id: this.data.idPedido, estado: this.nuevoEstado}).then((response) => {
                this.$parent.reloadTable();    
            });
        }
    },
}
</script>

<style>
.modalEstadoBack {
    position: fixed;
    width: 100vw;
    height: 100vh;

    pointer-events: none;
}
.modalEstado {
    position: absolute;
    top: 50%;
    left: -100%;

    text-align: center;

    width: 800px;
    height: 550px;
}

.modalEstado-active {
    position: absolute;
    top: 50%;
    left: 50%;

    text-align: center;
    pointer-events: all;

    transform: translate(-50%, -50%);

    background: white;
    box-shadow: 0 0 10px black;

    width: 800px;
    height: 550px;

    animation-name: open;
    animation-duration: 1s;
}

.modalEstado-closed {
    position: absolute;
    top: 50%;
    left: -100%;

    text-align: center;
    pointer-events: all;

    transform: translate(-50%, -50%);

    background: white;
    box-shadow: 0 0 10px black;

    width: 800px;
    height: 550px;

    animation-name: close;
    animation-duration: 1s;
}



</style>
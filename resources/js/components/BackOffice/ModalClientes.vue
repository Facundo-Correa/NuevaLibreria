<template>
    <div>
        <div class="modal-back" style="position: fixed; top:0; left:0; width: 100vw; height: 100vh; pointer-events: none;">
            <div class="modalCliente">
                <div class="modalClienteNombre">
                    <h3>{{ this.data.first_name }} {{ this.data.last_name }}</h3>
                </div>

                <div class="modalClienteInfo">
                    <b>Email</b>
                    <br>

                    {{this.data.email}}
                    <br>

                    <b>Numero de telefono</b>
                    <br>

                    {{this.data.phone}}
                    <br>
                    
                    <b>Localidad</b>
                    <br>
                    
                    {{this.data.locale}}
                    <br>

                    <b>Ciudad</b>
                    <br>

                    {{this.data.city}}
                    <br>

                    <b>Calle</b>
                    <br>

                    {{this.data.street}}
                    <br>

                    <b>Numero</b>
                    <br>

                    {{this.data.number}}
                    <br>

                    <b>Codigo postal</b>
                    <br>

                    {{this.data.postal_code}}

                    <br/>
                    <br/>

                    <a target="_blank" :href="'https://web.whatsapp.com/send?phone=54'+this.data.phone+'&text='">Hablar por whatsapp</a>
                    
                    <br/>
                    <button @click="closeModal()" type="button" class="cerrar-modal btn btn-success" style="margin-top:10px;">Cerrar</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['data'],
    mounted() {},
    methods: {
        showModal() {
            document.querySelector('.modal-back').setAttribute('class', 'modal-back modal-backActive');
            document.querySelector('.modalCliente').setAttribute('class', 'modalCliente modalCliente-active');
        },
        closeModal() {
            document.querySelector('.modal-back').setAttribute('class', 'modal-back modal-backclose');
            document.querySelector('.modalCliente').setAttribute('class', 'modalCliente modalCliente-close');
        }
    },
};
</script>

<style>

.modalCliente {
    height: 550px;
    
    transform: translate(-100%, 15%);
}

.modal-backActive {
    background: rgba(0, 0, 0, 0.459);
}

.modalCliente-close {
    position: absolute;
    width: 800px;
    height: 550px;


    background: white;
    padding-top: 2em;

    animation-name: close;
    animation-duration: 1s;
    transform: translate(-100%, 15%);
    box-shadow: 0 0 10px black;

}

.modalCliente-active {
    position: absolute;
    width: 800px;
    height: 550px;


    background: white;
    padding-top: 2em;

    pointer-events: all;

    left: 50%;
    top: 50%;

    animation-name: open;
    animation-duration: 1s;
    transform: translate(-50%, -50%);

    box-shadow: 0 0 10px black;

}


.modalCliente-active> .modalClienteNombre {
    text-align: center;
    margin-bottom: 2em;
}

.modalCliente-active> .modalClienteInfo {
    text-align: center;
}

.cerrar-modal {
    
}



</style>
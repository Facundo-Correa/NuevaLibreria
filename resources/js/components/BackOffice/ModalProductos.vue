<template>
    <div>
        <div
            class="back-modal-productos"
            style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; pointer-events: none"
        >
            <div class="modal-productos">
                <div class="titulo">
                    <h3 style="margin-top: 1.5em; 0">Productos</h3>
                    <p>{{this.nombre}}</p>
                </div>
                <div class="content-productos">
                    <div v-for="producto in productos" :key="producto.content.title">
                        <!--|| Recordatorio: agregar href despues de modificar el enrutado ||-->
                        <a href="#" style="margin-bottom: 0.3em"
                            >{{ producto.content.title }} x {{ producto.quantity }} ${{ producto.price }}</a
                        >
                    </div>
                </div>

                <br />
                <h4>Total</h4>
                <b>${{this.total}}</b>
                <br />
                <br />
                <button type="button" @click="closeModal()" class="btn btn-success">Cerrar</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            total: 0,
            productos: [],
        };
    },
    props: {
        data: Array,
        nombre: String
    },
    methods: {
        showModal() {
            if (this.data.length == 0) {
                // || Vacio || //
            } else {
                // || Proseguir || //

                // || Activar modal
                let mpa = document.querySelector('.back-modal-productos');
                let mpb = document.querySelector('.modal-productos');

                if(mpa == null && mpb == null){
                    let mpa = document.querySelector('.back-modal-productos-closed');
                    let mpb = document.querySelector('.modal-productos-closed');

                    mpa.setAttribute('class', 'back-modal-productos-active');
                    mpb.setAttribute('class', 'modal-productos-active');
                }
                else {
                    mpa.setAttribute('class', 'back-modal-productos-active');
                    mpb.setAttribute('class', 'modal-productos-active');
                }

                this.productos = this.data;

                // || Calcular total || //
                let self = this;
                this.total = 0;
                this.productos.map((producto) => {
                    self.total += producto.price;
                });
            }
        },
        closeModal() {
            document.querySelector('.back-modal-productos-active').setAttribute('class', 'back-modal-productos-closed');
            document.querySelector('.modal-productos-active').setAttribute('class', 'modal-productos-closed');
        },
    },
};
</script>

<style>
.back-modal-productos {

}

.modal-productos {
    top: -100%;
    left: -100%;
    visibility: hidden;
}

.back-modal-productos-active {
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.459);
}

.modal-productos-active {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 800px;
    height: 550px;

    transform: translate(-50%, -50%);
    background: white;

    text-align: center;
    pointer-events: all;

    animation-name: open;
    animation-duration: 1s;
    box-shadow: 0 0 10px black;
}
.modal-productos-closed {
    position: absolute;
    width: 800px;
    height: 550px;

    transform: translate(-50%, -50%);
    background: rgb(255, 255, 255);

    text-align: center;
    pointer-events: all;

    animation-name: close;
    animation-duration: 1s;

    top: 50%;
    left: -100%;

}

.content-productos {
    min-height: 260px;
    max-height: 260px;
    overflow-y: scroll;
}

@keyframes open {
    0% {
        left: 0;
    }

    100% {
        top: 50%;
        left: 50%;
        box-shadow: 0 0 10px black;
    }
}

@keyframes close {
    0% {
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
    }

    100% {
        transform: translate(-50%, -50%);
        top: 50%;
        left: -100%;
    }
}


</style>
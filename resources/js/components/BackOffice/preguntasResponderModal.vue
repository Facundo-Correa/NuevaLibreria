<template>
    <div>
        <div
            class="back-modal-pregunta"
            style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; pointer-events: none"
        >
            <div class="modal-pregunta">
                <div class="titulo">
                    <h3 style="margin-top: 1.5em; 0; text-align:center;">Pregunta</h3>
                    <p style="margin-bottom: 0.2rem">{{ this.usuario }}</p>
                    <p style="margin-bottom: 0.2rem">{{ this.pregunta }}</p>
                </div>
                <div class="content-pregunta" style="padding-left: 14px">
                    <div v-if="this.respuestas == null">
                        <br />
                        <br />
                        <label for="textarea_preg" style="text-align: center; width: 100%">
                            Máximo 2000 caracteres </label
                        ><br />
                        <textarea
                            id="textarea_preg"
                            cols="80"
                            rows="6"
                            style="resize: none"
                            maxlength="2000"
                            v-model="respuesta"
                        ></textarea>
                    </div>

                    <div v-else>
                        <br />
                        <br />
                        <div style="min-height: 260px; max-height: 260px; text-align:center;">
                            <p>{{ this.respuestas.es }}</p>
                        </div>
                    </div>
                </div>

                <br />

                <br />
                <br />
                <div v-if="this.respuestas == null">
                    <button type="button" style="margin-bottom:.2rem;" @click="responder()" class="btn btn-success">Responder</button><br />
                </div>
                <button type="button" @click="closeModal()" class="btn btn-success">Cerrar</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pregunta: {},
            usuario: {},
            publicacion: {},
            respuestas: {},
            respuesta: '',
            id: '',
        };
    },
    methods: {
        open(pregunta) {
            axios.post('/api/preguntas/get/id', { id: pregunta.id }).then((response) => {
                this.pregunta = response.data.body.es;
                this.usuario = response.data.Nombre_y_apellido;
                this.publicacion = response.data.publicacion;
                this.respuestas = JSON.parse(response.data.respuestas);
                this.id = response.data.id;
                console.log(response);

                if (this.pregunta == {}) {
                    // || Vacio || //
                } else {
                    // || Proseguir || //
                    console.log(' NO VACIO');

                    // || Activar modal
                    let mpa = document.querySelector('.back-modal-pregunta');
                    let mpb = document.querySelector('.modal-pregunta');

                    console.log(mpa);

                    if (mpa == null && mpb == null) {
                        let mpa = document.querySelector('.back-modal-pregunta-closed');
                        let mpb = document.querySelector('.modal-pregunta-closed');

                        mpa.setAttribute('class', 'back-modal-pregunta-active');
                        mpb.setAttribute('class', 'modal-pregunta-active');
                    } else {
                        mpa.setAttribute('class', 'back-modal-pregunta-active');
                        mpb.setAttribute('class', 'modal-pregunta-active');
                    }

                    // || Calcular total || //
                }
            });
        },
        closeModal() {
            document.querySelector('.back-modal-pregunta-active').setAttribute('class', 'back-modal-pregunta-closed');
            document.querySelector('.modal-pregunta-active').setAttribute('class', 'modal-pregunta-closed');
        },
        responder() {
            axios.post('/api/pregunta/responder', { id: this.id, respuesta: this.respuesta }).then((response) => {
                this.closeModal();
                show('Pregunta respondida!');
                location.reload();
            });
        },
    },
};
</script>

<style>
.back-modal-pregunta {
}

.modal-pregunta {
    top: -100%;
    left: -100%;
    visibility: hidden;
}

.back-modal-pregunta-active {
    width: 100vw;
    height: 100vh;
    z-index: 1000 !important;
    background: rgba(0, 0, 0, 0.459);
}

.modal-pregunta-active {
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
.modal-pregunta-closed {
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

.content-pregunta {
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

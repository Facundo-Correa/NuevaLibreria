<template>
    <div class="back-modal-closed">
        <div class="modal">
            <div class="modal-title">
                <h3>Pregunta</h3>
                <p>{{ this.user }}</p>
            </div>

            <div v-if="this.respuesta != ''" class="modal-content">
                <div>
                    <h5>{{ this.pregunta }}</h5>
                    <p>{{ this.respuesta }}</p>
                </div>
            </div>

            <div v-else class="modal-content" style="height: 20% !important">
                <div>
                    <h5>{{ this.pregunta }}</h5>
                </div>
            </div>

            <div v-if="this.respuesta == ''">
                <br />
                <br />
                <label for="textarea_preg" style="text-align: left; width: 100%"> Máximo 2000 caracteres </label><br />
                <textarea id="textarea_preg" cols="80" rows="3" style="resize: none" maxlength="2000"></textarea>
            </div>

            <div v-if="this.respuesta == ''">
                <button @click="responder()" type="button" class="btn btn-success responderButtom">Responder</button>
            </div>

            <button @click="close()" type="button" class="btn btn-primary cerrarButtom">Cerrar</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            respuestaDin: '',
            ma: {},
            mb: {},
            config: {}
        };
    },
    props: {
        pregunta: String,
        respuesta: String,
        user: String,
        id: Number,
        token: String,
    },
    methods: {
        open(data) {
            this.ma = document.querySelector('.back-modal-closed');
            this.mb = document.querySelector('.modal');

            if (this.mb == null) {
                this.mb = document.querySelector('.modal-closed');
            }

            this.ma.setAttribute('class', 'back-modal-active');
            this.mb.setAttribute('class', 'modal-active');
        },
        close() {
            this.ma.setAttribute('class', 'back-modal-closed');
            this.mb.setAttribute('class', 'modal-closed');
        },
        responder() {
            this.config = {
                /*
                header.Add("Access-Control-Allow-Origin", "*")
                header.Add("Access-Control-Allow-Methods", "DELETE, POST, GET, OPTIONS")
                header.Add("Access-Control-Allow-Headers", "Content-Type, Authorization, X-Requested-With")*/
            };

            // || https://api.mercadolibre.com/answers || //
            let resp = document.querySelector('#textarea_preg').value;
            axios.post('/api/mercado-libre/contestar', {question_id: this.id, text: resp}).then((response) => {
                this.close();
            });
            
        },
    },
};
</script>

<style>
.back-modal-active {
    position: fixed;
    pointer-events: none;

    width: 100vw;
    height: 100vh;

    top: 0;
    left: 0;

    background: rgba(0, 0, 0, 0.329);
}

.modal {
    position: absolute;
    pointer-events: all;

    width: 800px;
    height: 550px;
    background: white;

    top: 0;
    left: 0%;
    transform: translate(-100%, -100%);

    display: flex;
    flex-direction: column;

    align-items: center;

    text-align: center;
    border-radius: 10px;
}
.modal-active {
    position: absolute;
    pointer-events: all;

    width: 800px;
    height: 550px;
    background: white;

    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);

    display: flex;
    flex-direction: column;

    align-items: center;

    text-align: center;
    border-radius: 10px;

    animation-name: open;
    animation-duration: 1s;
}
.modal-closed {
    position: absolute;
    pointer-events: all;

    width: 800px;
    height: 550px;
    background: white;

    top: 0;
    left: 0%;
    transform: translate(-100%, -100%);

    display: flex;
    flex-direction: column;

    align-items: center;

    text-align: center;
    border-radius: 10px;

    animation-name: close;
    animation-duration: 1s;
}

.modal-title {
    margin-top: 2em;
    margin-bottom: 1em;
}

.modal-content {
    width: 80%;
    border-radius: 10px;
    border: 1px solid black;

    padding: 1em;

    display: flex;
    justify-content: center;

    flex-direction: column;

    height: 60%;
    overflow-y: scroll;
}

.responderButtom {
    margin-top: 2em;
}

.cerrarButtom {
    margin-top: 1em;
}

/* Hide scrollbar for Chrome, Safari and Opera */
.modal-content::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.modal-content {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
</style>
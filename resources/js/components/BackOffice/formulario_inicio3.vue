<template>
  <div id="fi1">
      <form action="">
            <br/>
            <label for="Promociones">Promociones</label><br>
            <select class="form-select" id="Promociones">
                <option v-for="item in promociones" :key="item.id">
                    {{item.name}}
                </option>
            </select>
            <br/>            

            <label for="Publicidades">Publicidades</label><br>
            <select class="form-select" id="Publicidades">
                <option v-for="item in publicidades" :key="item.id">
                    {{item.name}}
                </option>
            </select>
            <br/>

            <label for="SobreNosotros">Sobre nosotros</label><br>
            <select class="form-select" id="SobreNosotros">
                <option v-for="item in sobreNosotros" :key="item.id">
                    {{item.name}}
                </option>
            </select>
            <br/>

            <label for="Carrusel">Carrusel</label><br>
            <select class="form-select" id="Carrusel">
                <option v-for="item in carruseles" :key="item.id">
                    {{item.name}}
                </option>
            </select>
            <br/>

            <label for="Exposicion">Exposicion</label><br>
            <select class="form-select" id="Exposicion">
                <option v-for="item in exposiciones" :key="item.id">
                    {{item.name}}
                </option>
            </select>
            <br/>

            <button type="button" class="btn btn-success">Confirmar</button>
            <br/>
      </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'formulario_inicio',
    data() {
        return {
            promociones: [],
            publicidades: [],
            sobreNosotros: [],
            carruseles: [],
            exposiciones: [],
        }
    },

    methods: {
        loadPromociones(){
            let self = this;
            axios.post('/admin/booklists/promos/obtener').then(function(response){
                self.promociones = response.data;
            });
        },
        loadPublicidades(){
            let self = this;
            axios.post('/admin/booklists/publicidades/obtener').then(function(response){
                self.publicidades = response.data;
            });
        },
        loadSobreNosotros(){
            let self = this;
            axios.post('/admin/sobre-nosotros/obtener').then(function(response){
                self.sobreNosotros = response.data;
            });
        },
        loadCarruseles(){
            let self = this;
            axios.post('/admin/booklists/carousels/obtener').then(function(response){
                self.carruseles = response.data;
            });
        },
        loadExposiciones(){
            let self = this;
            axios.post('/admin/exposiciones/obtener').then(function(response){
                self.exposiciones = response.data;
            });
        }
    },

    mounted() {
        this.loadExposiciones();
        this.loadSobreNosotros();
    },

    props: {

    }
}
</script>

<style>

</style>
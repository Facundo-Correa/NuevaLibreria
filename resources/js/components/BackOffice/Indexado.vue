<template>
  <div>

      <form :action="'/admin/' + obj_type + '/crear/'" method="POST">           
        <!--Gracias a esto tenemos un crud oculto y seguro-->
        <input type="hidden" name="_token" :value="csrf" style="position:absolute;">             
        <button type="submit" class="btn btn-primary btn-sm" style="display:flex; align-items: center; justify-content: center; height: 2.5em; padding: 0 1%;">
            <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="text-white-50 me-2">
                <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z">
                </path>
            </svg>
            Añadir
        </button>
        <br/>
        
      </form>
      
  <div style="display:flex; margin-bottom: 5%;">
    
      <input class="form-control me-2" type="text" placeholder="Busqueda" aria-label="Search" v-model="input_search" id="000-SIND"
      style="width:90%; margin-top:2%; margin-right:2%;">
      <button class="btn btn-outline-success" style="margin-top:2%; margin-right:2%;" v-on:click="search()">Buscar</button>
    
  </div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Acciones</th>
      <th scope="col">Estado</th>
    </tr>
  </thead>
  <tbody>
        <tr v-for="item in resultado" :key="item.id">
            <th scope="row">{{item.id}}</th>  
            <td>
                <a href="#">{{item.name}}</a>
            </td>
            <td>
                
                <div class="action-form" style="display:flex;">
                    <form :action="'/admin/' + obj_type + '/editar/'" method="POST">

                        <!--Gracias a esto tenemos un crud oculto y seguro-->
                        <input type="hidden" name="_token" :value="csrf" style="position:absolute;">

                        <input type="text" style="visibility: hidden; position: absolute;" :value="item.id" name="id">
                        <button type="submit" class="btn btn-warning btn-sm" style="margin-right:3px;">Editar</button>
                    </form>
                
                    <form :action="'/admin/' + obj_type + '/eliminar/'" method="POST">

                        <!--Gracias a esto tenemos un crud oculto y seguro-->
                        <input type="hidden" name="_token" :value="csrf" style="position:absolute;">

                        <input type="text" style="visibility: hidden; position: absolute;" :value="item.id" name="id">
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>

            </td>

            <td>

                <BSwitch :status="item.estado" :id="item.id" :state_url=" obj_type +'/cambiar-estado'"></BSwitch>
                
            </td>
        </tr>
  </tbody>

</table>

  </div>
</template>

<script>
import axios from 'axios';
import BSwitch from './BSwitch.vue';
export default {

    name: 'Indexado',
    data() {
        return {
            response: [],
            resultado: [],
            csrf: "",
            input_search: "",
        }
    },
    methods: {
        getCsrf(){
            this.csrf = document.head.querySelector('meta[name="csrf-token"]').content;
        },
        search(input){
            let self = this;
            let separacion = input.split(' ');
            if(input != '' && input != ""){
                self.resultado = [];

                self.response.map(function(item) {
                    separacion.map(function(word){
                        if(item.name.indexOf(word) != -1){
                            if(!self.resultado.includes(item)){
                                self.resultado.push(item);
                            }
                        }
                    });
                });
            }
            else {
                self.resultado = self.response;
            }
        },
    },

    mounted() {
        // || Cargado del csrf
        this.getCsrf();
        let self = this;

        axios.post(self.request_url).then(function (response) {
            self.response = response.data;
            self.resultado = response.data;
        });

        document.getElementById("000-SIND").addEventListener("keyup", function(event){
            self.search(self.input_search);
        });
    },
    
    props: {
        title: {
            type: String,
            required: true
        },
        request_url: {
            type: String,
            required: true
        },
        obj_type: {
            type: String,
            required: true
        },
        // || Modulo para buscar || //
        /*search_module: {
            type: String,
            required: true
        }*/
    },
    components: {
        BSwitch
    }
}
</script>

<style>

</style>
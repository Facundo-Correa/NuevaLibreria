<template>
  <div>
      <form action="" method="POST" id="fned1">
        <br/>
        <!--Gracias a esto tenemos un crud oculto y seguro-->
        <input type="hidden" name="_token" :value="csrf" style="position:absolute;">  
        <button type="button" class="btn btn-primary" v-on:click="addLibroSelect()">Añadir libro</button>
        <button type="button" class="btn btn-success" v-on:click="saveLibros()">Confirmar</button>

      </form>
  </div>
</template>

<script>

import axios from 'axios';

export default {
    data() {
        return {
            csrf: "",
            libros: [],
            elecciones: [],
            librosBaseDatos: [],
            generalIndex: 0

        }
    },
    mounted() {
        this.getLibros();
        this.getCSRF();
        this.loadLibros();
    },
    methods: {
        getCSRF(){
            this.csrf = document.head.querySelector('meta[name="csrf-token"]').content;
        },
        loadLibros(){
            let self = this;
            axios.post('/admin/books/obtener').then(function(response){
                self.libros = response.data;
            });
        },
        addLibroSelect(libro){
            let form = document.getElementById("fned1");

            let div = document.createElement("div");
            div.setAttribute("style", "display:flex;")

            let select = document.createElement("select");
            let foption = document.createElement("option");
            
            if(libro){
                foption.text = libro;
            }
            else {
                foption.text = "Elegir libro";
            }
            select.appendChild(foption);
            select.setAttribute("class", "form-select");
            select.setAttribute("style", "margin-top: 2%; width: 60%;");

            let self = this;
            let localIndex = this.generalIndex;

            
            self.elecciones[localIndex] = select.selectedOptions;
            select.addEventListener("change", function(event){
                self.elecciones[localIndex] = select.selectedOptions;
            });

            for(let i = 0; i<this.libros.length; i++){
                let opt = document.createElement("option");
                opt.text = this.libros[i].title;
                select.appendChild(opt);
            }

            div.appendChild(select);
            this.generalIndex++;


            let eliminar = document.createElement("button");
            eliminar.setAttribute("class", "btn btn-danger");
            eliminar.innerText = "Eliminar";
            eliminar.setAttribute("style", "margin-left: 2%; margin-top:2%;")

            eliminar.addEventListener("click", function(event){
                self.elecciones.pop(localIndex);
                div.remove();
            });

            div.appendChild(eliminar);
            form.appendChild(div);
        },
        saveLibros(){
            let cleanElecciones = [];
            for(let i = 0; i<this.elecciones.length; i++){
                if(this.elecciones[i]){
                    cleanElecciones.push((this.elecciones[i])[0].outerText);
                }
            }
            console.log(cleanElecciones);
            axios.post('/admin/nuestra-editorial/guardar-libros', {
                id: this.id,
                libros: cleanElecciones
            }).then(function(response){
                
            });
        },
        getLibros(){
            let self = this;
            axios.post('/admin/nuestra-editorial/obtener-libros', {
                id: this.id
            }).then(function(response){
                self.librosBaseDatos = response.data;
                for(let i = 0; i<self.librosBaseDatos.length; i++){
                    self.addLibroSelect(self.librosBaseDatos[i]);
                }
            });
        }
    },
    props: {
        id: {
            type: String,
            required: true
        }
    }
}
</script>

<style>

</style>
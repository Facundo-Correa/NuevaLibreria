<template>
  <div id="fe">
      <br/>
      <h4>Agregar imagenes (Carrusel)</h4>
      <br/>
      <a type="button" class="btn btn-primary" v-on:click="addImage()">Añadir imagen</a>
      <a type="button" class="btn btn-success" v-on:click="saveImages()">Confirmar</a>
      <div id="000">

      </div>
  </div>
</template>

<script>
import axios from 'axios';
        
export default {
    name: 'formulario_exposicion',
    data() {
        return {
            imagenes: [],
            imagenesDB: [],
            elecciones: [],
            generalIndex: 0,
        }
    },
    mounted() {
        this.getImages();
        this.loadImages();
    },
    props: {
        id: {
            required: true
        }
    },
    methods: {
        getImages(){
            let self = this;
            axios.post('/imagenes/imagenes').then(function(response){
                if(response.data){
                    self.imagenes = response.data;
                }
            });
        },
        loadImages(){
            let self = this;
            axios.post('/admin/exposiciones/obtener-imagenes', {id: this.id}).then(function(response){
                self.imagenesDB = response.data;
                for(let i = 0; i<self.imagenesDB.length; i++){
                    //if(self.imagenesDB[i] != '.' && self.imagenesDB['..']){
                        self.addImage(self.imagenesDB[i]);
                    //}
                }
            });
        },
        
        addImage(image){
            let self = this;
            let localIndex = self.generalIndex;
            let form = document.getElementById("000");
            let div = document.createElement("div");
            div.setAttribute("style", "display:flex;");
            let select = document.createElement("select");
            select.setAttribute("class", "form-select");
            select.setAttribute("style", "margin-top: 2%; width:60%;");
            let fop = document.createElement("option");
            if(image){
                fop.text = image;
                this.elecciones[localIndex] = select.selectedOptions[0];
            }
            else {
                fop.text = "Seleccione una imagen";
            }
            select.appendChild(fop);
            for(let i = 0; i<self.imagenes.length; i++){
                let op = document.createElement("option");
                op.text = self.imagenes[i];
                select.appendChild(op);
            }
            self.generalIndex++;
            div.appendChild(select);
            form.appendChild(div);
            self.elecciones.push(select.selectedOptions[0]);
            select.addEventListener("change", function(event){
                self.elecciones[localIndex] = this.selectedOptions[0];
            });
            let eliminar = document.createElement("button");
            eliminar.setAttribute("class", "btn btn-danger");
            eliminar.innerText = "Eliminar";
            eliminar.setAttribute("style", "margin-top: 2%; margin-left:2%;");
            div.append(eliminar);
            eliminar.addEventListener("click", function(event){
                div.remove();
                self.elecciones.push(localIndex);
            });
        },
        saveImages(){
            let clean = [];
            let self = this;
            for(let i = 0; i<self.elecciones.length; i++){
                if(self.elecciones[i]){
                   clean.push((self.elecciones[i]).outerText);
                }
            }
            axios.post('/admin/exposiciones/guardar-imagenes', {
                id: this.id,
                imagenes: clean
            }).then(function(response){
                console.log(response);
            });
        }
    },
}
</script>

<style>

</style>
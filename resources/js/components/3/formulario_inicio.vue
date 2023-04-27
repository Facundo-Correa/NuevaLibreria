<template>
  <div id="fi1">
      <form action="" id="000-FI">
          <button type="button" class="btn btn-success" style="margin-top:2%;" v-on:click="save()">Confirmar</button>
      </form>
  </div>
</template>

<script>
import axios from 'axios';
import { options } from 'laravel-mix';

export default {
    name: 'formulario_inicio',
    data() {
        return {
            promociones: [],
            publicidades: [], 
            sobreNosotros: [],
            carruseles: [],
            exposiciones: [], //
            eleccionPRM: [],
            eleccionPUB: [],
            eleccionSBN: [],
            eleccionCAR: [],
            eleccionEXP: [],
            eleccionNED: [],
            GRIND: 0,
        }
    },

    methods: {
        loadExposiciones(){
            let self = this;
            axios.post('/admin/exposiciones/obtener').then(function(response){
                self.exposiciones = response.data;
                self.prepareExposiciones();
                self.loadSobreNosotros();
            });
        },/*
        loadSobreNosotros(){
            axios.post('/admin/sobre-nosotros/obtener').then(function(response){
                this.sobreNosotros = response.data;
                this.prepareSobreNosotros();
            });
        },*/
        prepareExposiciones(){
            let form = document.getElementById("000-FI");
            let select = document.createElement("select");
            let fop = document.createElement("option");
            let div = document.createElement("div");
            if(this.exposicion!=null){
                let self = this;
                axios.post('/admin/exposiciones/GetById', {
                    id: self.exposicion
                }).then(function(response){
                    fop.text = response.data.name;
                });
            }
            else {
                fop.text = "Elegir una exposicion";
            }
            select.appendChild(fop);
            //select.selectedIndex = 0;
            let self = this;
            self.eleccionEXP.push(fop);
            for(let i = 0; i<this.exposiciones.length; i++){
                let opt = document.createElement("option");
                opt.text = self.exposiciones[i].name;
                select.appendChild(opt);
            }
            select.setAttribute("style", "width:60%; margin-top:2%; margin-right:2%;")
            select.setAttribute("class", "form-select");
            div.setAttribute("style", "display:flex;");
            div.appendChild(select);
            form.appendChild(div);
            select.addEventListener("change", function(event){
                self.eleccionEXP[0] = this.selectedOptions[0];
                //console.log(self.eleccionEXP[0].outerText);
            });
        },/*
        prepareSobreNosotros(){
            let form = document.getElementById("000-FI");
            let select = document.createElement("select");
            let fop = document.createElement("option");
            let div = document.createElement("div");
            fop.text = "Seleccione una plantilla Sobre Nosotros";
            this.sobreNosotros.push(fop);
            if(this.sobre_nosotros){
                let self = this;
                axios.post('/admin/sobre-nosotros/GetById', {id: self.sobre_nosotros}).then(function(response){
                    fop.text = response.data.name;
                    self.sobreNosotros[0] = fop;
                });
            }
            select.appendChild(fop);
            for(let i = 0; i<self.sobreNosotros.length; i++){
                let op = document.createElement("option");
                op.text = self.sobreNosotros[i].name;
                select.appendChild(op);
            }
            
        },*/
        save(){
            // || Guardar props
            let self = this;
            let URL = '/admin/inicio/guardar-props';
            let CLNEXP = [];
            let CLNSN = [];
            let CLNNE = [];
            for(let i = 0; i<self.eleccionEXP.length; i++){
                if(self.eleccionEXP[i]){
                    CLNEXP.push(self.eleccionEXP[i].outerText);
                }
            }
            for(let i = 0; i<self.eleccionSBN.length; i++){
                if(self.eleccionSBN[i]){
                    CLNSN.push(self.eleccionSBN[i].outerText);
                }
            }
            for(let i = 0; i<self.eleccionNED.length; i++){
                if(self.eleccionSBN[i]){
                    CLNSN.push(self.eleccionNED[i].outerText);
                }
            }
            axios.post(URL, 
            {
                id: self.id,
                exposicion: CLNEXP,
                sobre_nosotros: CLNSN,
                nuestra_editorial: CLNNE,
                // || Añadir Promociones, publicidades, carrusel
            });
        }
    },

    mounted() {
        this.loadExposiciones();
    },

    props: {
        exposicion: {
            type: String,
            required: true
        },
        sobre_nosotros: {
            type: String,
            required: true
        },
        id: {
            type: String, 
            required: true
        }
    }
}
</script>

<style>

</style>
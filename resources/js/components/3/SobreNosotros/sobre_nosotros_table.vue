<template>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="item in listado" :key="item.id">
      <th scope="row">1</th>
      <td>{{item.name}}</td>
      <td>
        <a :href="'/admin/sobre-nosotros/editar/' + item.name" class="btn btn-light btn-xs ms-1 me-2">
          Editar
        </a>
      </td>

    </tr>
  </tbody>
</table>
</template>

<script>
import axios from 'axios';
export default {
    name: 'sobre_nosotros_table',
    data() {
      return {
        listado: []  
      }
    },
    methods: {
      
    },

    mounted() {
      let self = this;
      axios.post('/sobre-nosotros/obtener').then(function(response){

        // || Obtención de los sobre nosotros emitidos desde el backoffice
        self.listado = response.data;
        
      });
    },

}
</script>

<style>

</style>
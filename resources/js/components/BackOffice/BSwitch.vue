<template>
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" :id="'sw-'+this.id" v-on:click="changeStatus()">
    </div>
</template>

<script>
import axios from 'axios';

export default {
  methods: {
      changeStatus(){
          let self = this;
          axios.post(self.state_url, {
              id: self.id
          }).then(function(response){

          })
      }
  },
    props: {
        status: {
            type: Number,
            required: true
        },
        id: {
            type: Number,
            required: true
        },
        state_url: {
            type: String,
            required: true
        }
    },
    mounted() {
        if(this.status == 1){
            let element = document.getElementById("sw-"+this.id);
            element.setAttribute("checked", "true");
        }
    },
}
</script>

<style>

</style>
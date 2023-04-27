<template>
    <a :href="'/api/andreani/download/' + data.pedidoID" @click="click(data)" class="btn btn-outline-success">Etiquetas</a>
</template>

<script>
export default {
  props: {
    data: {},
    name: {},
    click: {
      type: Function,
      default: () => {}
    },
    classes: {
        
    },
  },

  mounted() {
    
  },
}
</script>

<style scoped>

</style>
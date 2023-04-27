<template>
    <a href="javascript:void(0)" @click="click(data)" class="btn btn-outline-primary">Estado</a>
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
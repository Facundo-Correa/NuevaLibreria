<template>
  <input @click="click(data)" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
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
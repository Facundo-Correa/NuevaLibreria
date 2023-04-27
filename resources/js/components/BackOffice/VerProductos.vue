<template>
  <a :class="classes" class="btn btn-outline-primary" @click="click(data)" href="javascript:void(0)">
      Ver
  </a>

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
      type: Object,
      default: () => ({
        'btn': true,
        'btn-danger': true,
        'btn-sm': true,
      }),
    },
  },

  mounted() {
    
  },
}
</script>

<style scoped>

</style>
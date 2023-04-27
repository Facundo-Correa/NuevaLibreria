<template>
<div>
    <a @click="click(data)" href="javascript:void(0)" class="btn btn-success">Ver productos</a>
</div>
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
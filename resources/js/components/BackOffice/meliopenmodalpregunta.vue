<template>
  <a href="javascript:void(0)" @click="click(data)">Ver pregunta</a>
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
}
</script>

<style>

</style>
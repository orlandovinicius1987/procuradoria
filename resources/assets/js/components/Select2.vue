<template>
  <div>
    <select
      class="form-control select2"
      :value="value"
      :multiple="multiple"
      :disabled="!!disabled"
      :dusk="dusk"
      name="teste"
      :id="dusk"
    >
      <option value="">SELECIONE</option>
      <option v-for="(option, index) in options" :value="index" ref="input">
        {{ option.text }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  props: ['options', 'value', 'multiple', 'disabled', 'dusk'],

  methods: {
    onChange($event) {
      vm.$emit('input', $event.params.data.id)
    },
  },
  mounted: function() {
    var vm = this
    $(this.$el)
      .val(this.value)
      .on('select2:select', function($event) {
        vm.$emit('input', $event.params.data.id)
      })
  },
}
</script>

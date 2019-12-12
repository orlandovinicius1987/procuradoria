<template>
    <div>
        <label :for="idname"> {{ showname }} </label>

        <input type="hidden" :name="idname" :value="polymorphicId">
        <input type="hidden" :name="typename" :value="polymorphicType">

        <select2 :options="all" :value="selected" :multiple="false" v-on:input="refresh($event)" :elementid="idname" :disabled="disabled"></select2>
    </div>
</template>

<script>
export default {
    props: ['idname', 'typename', 'showname', 'disabled', 'selected', 'alljson'],

    data() {
        return {
            selectedElement: null
        }
    },

    methods: {
        refresh($event){
            this.selectedElement = this.all[$event]
        },
    },

    computed: {
        all: {
            get() {
                return JSON.parse(this.alljson)
            },
        },
        polymorphicId: {
            get(){
                return this.selectedElement ? this.selectedElement.hasOwnProperty('id') ? this.selectedElement.id : null : null
            }
        },
        polymorphicType: {
            get(){
                return this.selectedElement ? this.selectedElement.hasOwnProperty('model') ? this.selectedElement.model : null : null
            }
        },
    },

    mounted() {
        this.selectedElement = this.all[this.selected]
    }
}
</script>

const appName = 'appOpinionsForm'

import Vue from 'vue'
import Paginate from 'vuejs-paginate'
import TextHighlight from 'vue-text-highlight'
import PolymorphicSelect from '../components/PolymorphicSelect'
import Select2 from '../components/Select2'

Vue.component('polymorphic-select', PolymorphicSelect)
Vue.component('app-select-2', Select2)

if (jQuery('#' + appName).length > 0) {
  const app = new Vue({
    el: '#' + appName,

    data: {
    },

    methods: {
      f_editar(){
        $('form *').removeAttr('readonly').removeAttr('disabled');
        $( "form *" ).show();
        $('#editar').attr('disabled','disabled');
        $('#gravar').removeAttr('readonly').removeAttr('disabled');
      },

      refresh($event){
        console.log('refresh')
      }
    },
  })
}

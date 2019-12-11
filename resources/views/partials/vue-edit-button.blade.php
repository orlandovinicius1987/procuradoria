@if(isset($model) && ! is_null($model->id))
    <a id="editar" class="btn btn-primary pull-right" v-on:click="f_editar">Editar</a>
@endif

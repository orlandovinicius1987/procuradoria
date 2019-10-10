<div class="form-group pull-right">
    <div class="row">
        <div class="col-xs-2">
            <a href="{{ route($routeCreate) }}" class="btn btn-danger pull-right">
                <i class="fa fa-plus"></i> Novo</a>
        </div>

        <div class="col-xs-8">
            <div class="input-group" role="button">
                <!-- @keyup="typeKeyUp" busca automática desabilitada por enquanto -->
                <input v-model="pesquisa" class="form-control" placeholder="Pesquisar" name="pesquisa" id="pesquisa"  v-on:keyup.enter="refresh">

                <!-- botões iterativos desabilitados por enquanto -->
                <!-- div v-if="!pesquisa" class="input-group-addon" @click="refresh"><i class="fa fa-search"></i></div>
                <div v-if="pesquisa" class="input-group-addon" @click="clearSearch"><i class="fa fa-close text-danger"></i></div-->

                <div  class="input-group-addon" @click="refresh"><i dusk="submit-search" class="fa fa-search"></i></div>
            </div>
            <div>
                <input type="checkbox" v-model="processos_arquivados_incluidos" id="processos_arquivados_incluidos" value="true" @change="processosArquivados" v-bind:true-value="1" v-bind:false-value="0">
                <label for="processos_arquivados_incluidos"> Mostrar arquivados </label>
            </div>
        </div>

        <select
                v-model="perPage"
        >
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="all">TODOS</option>
        </select>
    </div>
</div>

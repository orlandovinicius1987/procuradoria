@if (! $isFilter)
    <button
        type="submit"
        class="btn btn-success pull-right"
        name="gravar"
        id="gravar"
        v-on:click="f_gravar"
        @include('partials.disabled')
    >Gravar
    </button>
@else
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div
                    id="filtrar"
                    class="btn btn-success pull-right"
                    data-dismiss="modal"
                    @click="filter"
                >
                Filtrar
                </div>
            </div>
        </div>
    </div>
@endif

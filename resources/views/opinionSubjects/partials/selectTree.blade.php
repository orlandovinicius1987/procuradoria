<div id="vue-subjectsToTree">
    <div class="row">
        <div class="col-md-5">

            @if($source == 'create')
                <label for="{{$attributeName}}">Dentro de qual assunto?</label>
            @else
                <p>Selecione o assunto</p>
            @endif

            <input name="{{$attributeName}}" type="hidden" value="{{$currentSubject->parent_id ?? $root->id ?? null }}" id="value-input" >
            <input name="label-input" type="hidden" value="{{ $currentSubject->parent->full_name ?? $root->name ?? null }}" id="label-input" >

            <div v-if="refreshing">
                <p class="text-danger">carregando...</p>
            </div>
            <div v-else="refreshing">
                <select name="tree" id="subjectsTreeSelect" style="width:16em" @include('partials.disabled')></select>
            </div>
        </div>

        <div class="col-md-7">
            <p>Será salvo {{$source == 'create' ? 'em' : 'como'}}</p>
                <label for="{{$attributeName}}">@{{ selectedLabel }}</label>
        </div>
    </div>
</div>
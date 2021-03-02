@extends('layouts.app')

@section('content')
    <div id="appOpinionsForm">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-8 col-md-10">
                        <h4>
                            <a href="{{ route('opinions.index') }}">Pareceres</a>

                            @if(is_null($opinion->id))
                                > NOVO
                            @else
                                > {{ $opinion->identifier }}
                            @endif
                        </h4>
                    </div>

                    <div class="col-xs-4 col-md-2">
                        @can('opinions:update')
                            @if(!is_null($opinion->id))
                                {{-- Create --}}
                                @include('partials.save-button')
                                @include('partials.vue-edit-button', ['model' => $opinion])
                            @else
                                {{-- Show --}}
                                @include('partials.save-button')
                                @include('partials.vue-edit-button', ['model' => $opinion])
                            @endIf
                        @endCan
                    </div>
                </div>
            </div>

            <div class="panel-body">
                @include('partials.alerts')

                <form name="formulario" id="formulario" action="{{ is_null($opinion->id) ? route('opinions.store') : route('opinions.update', ['id' => $opinion->id]) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <input name="id" type='hidden' value="{{$opinion->id}}" id="id" >

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="opinion_scope_id">Abrangência</label>
                            <select name="opinion_scope_id" class="select2 form-control" @include('partials.disabled') id="opinion_scope_id">
                                <option value="">SELECIONE</option>
                                @foreach ($opinionScopes as $key => $item)
                                    @if(!is_null($opinion->opinionScope) && $opinion->opinionScope->id == $item['id']
                                    || (!is_null(old('opinion_scope_id')))&& old('opinion_scope_id') == $item['id'])
                                        <option value="{{ $item['id'] ?? null }}" selected="selected">{{ $item['name'] ?? null}}</option>
                                    @else
                                        <option value="{{ $item['id'] ?? null }}">{{ $item['name'] ?? null}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <polymorphic-select alljson="{{ collect($authorables) }}"
                                                selected="{{ $selectedAuthorableKey ?? null }}"
                                                idname="authorable_id" typename="authorable_type" showname="Procurador" disabled="{{$formDisabled}}"></polymorphic-select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="approve_option_id">Aprovado</label>
                            <select name="approve_option_id" class="select2 form-control" @include('partials.disabled') id="approve_option_id">
                                <option value="">SELECIONE</option>
                                @foreach ($approveOptions as $key => $item)
                                    @if(!is_null($opinion->approveOption) && $opinion->approveOption->id == $item['id']
                                    || (!is_null(old('approve_option_id')))&& old('approve_option_id') == $item['id'])
                                        <option value="{{ $item['id'] ?? null }}" selected="selected">{{ $item['name'] ?? null}}</option>
                                    @else
                                        <option value="{{ $item['id'] ?? null }}">{{ $item['name'] ?? null}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="opinion_type_id">Tipo</label>
                            <select name="opinion_type_id" class="select2 form-control" @include('partials.disabled') id="opinion_type_id">
                                <option value="">SELECIONE</option>
                                @foreach ($opinionTypes as $key => $item)
                                    @if(!is_null($opinion->opinionType) && $opinion->opinionType->id == $item['id']
                                    || (!is_null(old('opinion_type_id')))&& old('opinion_type_id') == $item['id'])
                                        <option value="{{ $item['id'] ?? null }}" selected="selected">{{ $item['name'] ?? null}}</option>
                                    @else
                                        <option value="{{ $item['id'] ?? null }}">{{ $item['name'] ?? null}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="suit_number">Número do Processo</label>
                            <input name="suit_number" value="{{is_null(old('suit_number')) ? $opinion->suit_number : old('suit_number')}}" @include('partials.readonly') class="form-control" id="suit_number" aria-describedby="nomeHelp" placeholder="Número do Processo" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="identifier">Identificador</label>
                            <input name="identifier" value="{{is_null(old('identifier')) ? $opinion->identifier : old('identifier')}}" @include('partials.readonly') class="form-control" id="identifier" aria-describedby="nomeHelp" placeholder="Identificador" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="suit_sheet">Folha do Processo</label>
                            <input name="suit_sheet" value="{{is_null(old('suit_sheet')) ? $opinion->suit_sheet : old('suit_sheet')}}" @include('partials.readonly') class="form-control" id="suit_sheet" aria-describedby="nomeHelp" placeholder="Folha do Processo" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="date">Data</label>
                            <input
                                    value="{{ is_null(old('date'))? (! is_null($opinion->id) ? $opinion->date : '' ) :  old('date')}}"
                                    type="date"
                                    class="form-control"
                                    name="date"
                                    id="date" @include('partials.readonly')
                            />
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="party">Interessado</label>
                            <input name="party" value="{{is_null(old('party')) ? $opinion->party : old('party')}}" @include('partials.readonly') class="form-control" id="party" aria-describedby="nomeHelp" placeholder="Interessado" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="opinion">Parecer</label>
                            <textarea name="opinion" class="form-control" @include('partials.readonly') id="opinion"
                                      placeholder="Parecer">{{is_null(old('opinion'))? $opinion->opinion : old('opinion')}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="abstract">Ementa</label>
                            <textarea name="abstract" class="form-control" @include('partials.readonly') id="abstract"
                                      placeholder="Ementa">{{is_null(old('abstract'))? $opinion->abstract : old('abstract')}}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            @if(isset($opinion->file_pdf))
                                <label for="pdf_file_name">PDF</label>
                                <a href="{{$opinion->pdf_file_name }}">Visualizar</a>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            @if(isset($opinion->file_doc))
                                <label for="doc_file_name">DOC</label>
                                <a href="{{$opinion->doc_file_name }}">Visualizar</a>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            @if(!isset($opinion->file_pdf))
                                <label for="pdf_file" style="display: none;">Arquivo .pdf</label>
                                <input style="{{$mode == 'create' ? '' : 'display: none;'}}" name="pdf_file" id="pdf_file" type="file" @include('partials.disabled')/>
                            @endif
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            @if(!isset($opinion->file_doc))
                                <label for="doc_file" style="display: none;">Arquivo .doc</label>
                                <input style="{{$mode == 'create' ? '' : 'display: none;'}}" name="doc_file" id="doc_file" type="file" @include('partials.disabled')/>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="is_active">Ativo</label>
                            <br>
                            <input type="hidden" name="is_active" value="0">
                            <input id="is_active" type="checkbox" name="is_active"
                                    {{
                                                        is_null(old('is_active')) ?
                                                            is_null($opinion->is_active) ?
                                                                true ?
                                                                    'checked="checked"' : ''
                                                                : ($opinion->is_active ?
                                                                    'checked="checked"' : '')
                                                            : (old('is_active') ?
                                                                'checked="checked"' : '')
                                    }}
                                    @include('partials.disabled')>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if(isset($opinion) && !is_null($opinion->id))
        @include('opinions.partials.opinionSubjects')
    @endif
@endsection

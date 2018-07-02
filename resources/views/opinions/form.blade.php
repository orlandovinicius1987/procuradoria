@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-xs-8 col-md-10">
                    <h4>
                        <a href="{{ route('opinions.index') }}">Opiniões</a>

                        @if(is_null($opinion->id))
                            > NOVA
                        @else
                            > {{ $opinion->identifier }}
                        @endif
                    </h4>
                </div>

                <div class="col-xs-4 col-md-2">
                    @include('partials.save-button')
                    @include('partials.edit-button', ['model' => $opinion])
                </div>
            </div>
        </div>

        {{$opinion->pdf_file_name}}

        <div class="panel-body">
            @include('partials.alerts')

            <form name="formulario" id="formulario" action="{{ route('opinions.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <input name="id" type='hidden' value="{{$opinion->id}}" id="id" >

                @foreach($opinionsFormAttributes as $attr)
                    <div class="row">
                        <div class="form-group col-md-6" @include('partials.disabled')>
                            <label for="{{$attr->name}}">{{$attr->showName}}</label>

                            @if($attr->type == 'date')
                                <input
                                        value="{{ is_null(old($attr->name))? (! is_null($opinion->id) ? $opinion->{$attr->name} : '' ) :  old($attr->name)}}"
                                        type="date"
                                        class="form-control"
                                        name="{{$attr->name}}"
                                        id="{{$attr->name}}" @include('partials.readonly')
                                />
                            @endif

                            @if($attr->type == 'string')
                                <input name="{{$attr->name}}" value="{{is_null(old($attr->name)) ? $opinion->{$attr->name} : old($attr->name)}}" @include('partials.readonly') class="form-control" id="{{$attr->name}}" aria-describedby="nomeHelp" placeholder="{{$attr->showName}}" >
                            @endif

                            @if($attr->type == 'id')
                                <select name="{{$attr->name}}" class="select2 form-control" @include('partials.disabled') id="{{$attr->name}}">
                                    <option value="">SELECIONE</option>
                                    @foreach (${$attr->attributeArray} as $key => $item)
                                        @if(!is_null($opinion->{$attr->relationName}) && $opinion->{$attr->relationName}->id == $key
                                        || (!is_null(old($attr->name)))&& old($attr->name) == $key)
                                            <option value="{{ $key }}" selected="selected">{{ $item }}</option>
                                        @else
                                            <option value="{{ $key }}">{{ $item }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif

                            @if($attr->type == 'textarea')
                                <textarea name="{{$attr->name}}" class="form-control" @include('partials.readonly') id="{{$attr->name}}"
                                          placeholder="{{$attr->showName}}">{{is_null(old($attr->name))? $opinion->{$attr->name} : old($attr->name)}}</textarea>
                            @endif

                            @if($attr->type == 'file')
                                <input name="{{$attr->name}}" id="{{$attr->name}}" type="file" @include('partials.disabled')/>
                            @endif

                            @if($attr->type == 'linkImage')
                                <a href="{{$opinion->{$attr->name} }}">
                                    <img border="0" alt="W3Schools" src="{{$attr->imageName}}" width="100" height="100">
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach

                @include('partials.save-button')
            </form>
        </div>
    </div>

    @if(isset($opinion) && !is_null($opinion->id))
        @include('opinions.partials.opinionSubjects')
    @endif
@endsection
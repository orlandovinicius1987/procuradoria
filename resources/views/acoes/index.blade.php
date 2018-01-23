@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    Ações
                </div>

                <div class="col-md-9">
                    @include('acoes.partials.search-form')
                </div>
            </div>
        </div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @include('acoes.partials.search-table')
        </div>
    </div>
@endsection
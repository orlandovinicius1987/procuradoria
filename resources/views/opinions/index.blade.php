@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-3">
                    <h4>Pareceres</h4>
                </div>

                <div class="col-md-9">
                    @include(
                        'layouts.partials.search-form',
                        [
                            'routeSearch' => 'opinions.index',
                            'routeCreate' => 'opinions.create',
                            'newButtonVisible' => Gate::allows('opinions:create'),
                            'checkboxes' => [
                                (object)[
                                    'field' => 'show-inactive',
                                    'caption' => 'Mostrar inativos',
                                    'value' => $checkboxValues['show-inactive'] ?? false,
                                ]
                            ],
                        ]
                    )
                </div>
            </div>
        </div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @include('opinions.partials.table')
        </div>
    </div>
@endsection

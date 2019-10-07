<form action="{{ route($routeSearch) }}" id="searchForm">
    {{ csrf_field() }}

    <div class="form-group pull-right">
        <div class="row">
            <div class="col-xs-4">
                @if (isset($routeCreate) && (!isset($newButtonVisible) || $newButtonVisible))
                    <a href="{{ route($routeCreate) }}" class="btn btn-danger pull-right">
                        <i class="fa fa-plus"></i> Novo
                    </a>
                @endif
            </div>

            <div class="col-xs-8 pull-right">
                <div class="input-group">
                    <input type="text" class="form-control" name="pesquisa" placeholder="Pesquisar" value="{{ $pesquisa ?? '' }}">

                    <div class="input-group-addon" id="searchButton" onClick="javascript:document.getElementById('searchForm').submit();"><i class="fa fa-search"></i></div>
                </div>
            </div>

            <div class="row">
            @if(isset($checkboxes))
                @foreach($checkboxes as $checkbox)
                    <div class="col-xs-4">

                    </div>
                    <div class="col-xs-8 pull-right">
                        <input type="hidden" name="{{$checkbox->field}}" value="0">
                        <input type="checkbox" name="{{$checkbox->field}}" id="{{$checkbox->field}}" {{ $checkbox->value ? 'checked="checked"' : '' }}>
                        <label for="{{$checkbox->field}}"> {{$checkbox->caption}} </label>
                    </div>
                @endForEach
            @endIf
            </div>
        </div>
    </div>
</form>

<div class="panel panel-default">

    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table id="example" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
                    <thead>

                    <tr>
                        <th>Número judicial</th>
                        <th>Número ALERJ</th>
                        <th>Tribunal</th>
                        <th class=".hidden-xs">Distribuído em</th>
                        <th>Ação</th>
                        <th class=".hidden-xs">Autor</th>
                        <th class=".hidden-xs">Objeto</th>
                        <th class=".hidden-xs">Procurador</th>
                        <th class=".hidden-xs">Assessor</th>
                        <th class=".hidden-xs">Estagiário</th>
                    </tr>
                    </thead>

                    @if(isset($processos))
                        @forelse ($processos as $processo)
                            <tr>
                                <td>
                                    <a href="{{ route('processos.show', ['id' => $processo->id]) }}">{{ $processo->numero_judicial }}</a>
                                </td>
                                <td>{{ $processo->numero_alerj ?? 'N/C'  }}</td>
                                <td>{{ $processo->tribunal->nome ?? 'N/C' }}</td>
                                <td class=".hidden-xs">{{ $processo->data_distribuicao_formatado ?? 'N/C' }}</td>
                                <td>{{ $processo->acao->nome ?? 'N/C'}}</td>
                                <td class=".hidden-xs">{{ $processo->autor ?? 'N/C' }}</td>
                                <td class=".hidden-xs">{{ $processo->objeto ?? 'N/C'}}</td>
                                <td class=".hidden-xs">{{ $processo->procurador->name ?? 'N/C'}}</td>
                                <td class=".hidden-xs">{{ $processo->assessor->name ?? 'N/C'}}</td>
                                <td class=".hidden-xs">{{ $processo->estagiario->name ?? 'N/C'}}</td>
                            </tr>
                        @empty
                            <p>Nenhum processo encontrado</p>
                        @endforelse
                        @else
                            <p>Nenhum processo encontrado</p>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

<table id="revisionTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Usuário</th>
            <th>Tabela</th>
            <th>Campo alterado</th>
            <th>Antigo valor</th>
            <th>Novo valor</th>
            <th>Data da alteração</th>
        </tr>
    </thead>

    @forelse ($revisions as $revision)
        <tr>
            <td>
                @if ($revision->link)
                    <a href="{{ $revision->link }}">
                @endif

                {{ $revision->id }}

                @if ($revision->link)
                    </a>
                @endif
            </td>

            <td>{{ is_null($revision->user) ? '' : $revision->user->name }}</td>

            <td>{{ trans('validation.classes.'.$revision->revisionable) }}</td>

            <td>{{ trans('validation.attributes.'.$revision->key) }}</td>

            <td>{{ str_limit($revision->old_value, 50) }}</td>

            <td>{{ str_limit($revision->new_value,50) }}</td>

            <td>{{ $revision->created_at->format('d/m/Y - H:i') }}</td>
        </tr>
    @empty
        <p>Nenhuma revisão encontrada</p>
    @endforelse

    {{ $revisions->links() }}
</table>

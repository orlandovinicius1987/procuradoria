<!-- Button trigger modal -->
@can('opinion-subjects:connect')
    <button type="button" id="relacionar-assunto" class="btn btn-primary; btn btn-primary pull-right" data-toggle="modal"
        data-target="#subjectsModal">
        Relacionar Assunto
    </button>
    @endCan
    
    <!-- Modal -->
    <div class="modal fade" id="subjectsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Relacionar Assunto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    
                <form class="form" id="form_relacionarAssunto" name="form_relacionarAssunto"
                    action="{{ route('opinions.relacionar-assunto', ['opinion_id' => $opinion->id]) }}" method="post"
                    enctype="multipart/form-data">
    
                    <div class="modal-body">
    
                        {{ csrf_field() }}
    
                        <input name="opinion_id" type="hidden" value="{{ $opinion->id }}">
    
                        @include(
                        'opinionSubjects.partials.selectTree',
                        [
                        'root' => $root ?? null,
                        'currentSubject' => null,
                        'attributeName' => 'subject_id',
                        'formDisabled' => false,
                        'source' => 'update'
                        ]
                        )
    
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id='buttonRelacionarLei' class="btn btn-primary">
                            <i class="fa fa-plus"></i> Salvar</button>
                    </div>
    
                </form>
    
            </div>
        </div>
    </div>
    
<!-- Botão de Deletar -->
<button data-bs-toggle="modal" data-bs-target="#confirm-user-deletion-{{ $userId }}" type="button" class="btn-delete" data-id="{{ $user->id }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
    </svg>
</button>

<!-- Modal de Confirmação -->
<div id="confirm-user-deletion-{{ $userId }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('users.destroy', $userId) }}" class="p-4">
                @csrf
                @method('delete')

                <div class="modal-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#F15E5E" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4m.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
                      </svg>
                    <h4 class="mt-3">Tem certeza?</h4>
                    <p class="text-muted mt-3">Você tem certeza que deseja excluir o usuário {{ $userName }}?</p>
                </div>

                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger ms-2">Deletar</button>
                    
                    
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Botão de Deletar -->
<button data-bs-toggle="modal" data-bs-target="#update-post-{{ $postId }}" type="button" class="dropdown-item" data-id="{{ $post->id }}">
    Editar
</button>

<!-- Modal de Confirmação -->
<div id="update-post-{{ $postId }}" class="modal fade" tabindex="-1" aria-labelledby="modal-center-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('posts.update', $postId) }}" class="p-4">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Editar Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-center">
                    <p>MODAL MODAL MODAL MODAL MODAL MODAL MODAL MODAL</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger ms-2">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

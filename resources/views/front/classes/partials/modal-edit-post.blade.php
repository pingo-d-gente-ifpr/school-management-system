<!-- modal-edit-post.blade.php -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPostModalLabel">Editar Postagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPostForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="card">
                            <textarea class="form-control" name="description" rows="5" placeholder="Digite sua mensagem..." id="editDescription" maxlength="1000" style="border: 0 none;"></textarea>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <input hidden name="classe_id" value="{{$class->id}}"></input:>
                    <input hidden name="user_id" value="{{Auth::user()->id}}"></input:>
                    <span class="text-muted" id="charCountEdit" style="opacity: 0.8">0/1000</span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
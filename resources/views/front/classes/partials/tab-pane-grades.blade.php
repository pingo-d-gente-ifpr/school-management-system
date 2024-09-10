<div class=row>
    <!-- TABLE DE ALUNOS -->
    <div class="col-12 col-md-4">
        <div class="border rounded p-2">
            <h3>Alunos</h3>
            <div class="list-group list-group-flush">
                @forelse ($students as $student)
                    <li class="list-group-item list-group-item-action">{{ $student->name }}</li>
                @empty
                    <p>Nenhum aluno cadastrado na turma.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8">
        <h2>Notas</h2>
    </div>
</div>
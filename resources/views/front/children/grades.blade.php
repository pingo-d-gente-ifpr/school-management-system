<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Notas de {{ $child->name }}</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <span class="material-icons breadcrumb-icon">home</span>
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('children.index') }}">Crianças</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Notas</li>
                </ol>
            </nav>
            <hr style="height: 2px; background-color: #FF6B8A; border: none;">
            <div class="bg-white rounded p-4">
                <div class="row">
                    <!-- LISTA DE TURMAS -->
                    <div class="col-12 col-md-4">
                        <div class="border rounded p-3">
                            <h2 class="mb-3">Turmas</h2>
                            <p>Selecione a turma que deseja ver a nota.</p>
                            <div class="overflow-auto mt-3" style="max-height: 450px;">
                                <table class="table table-striped">
                                    <tbody>
                                        @forelse ($classes as $class)
                                            <tr class="linhas align-middle" data-class-id="{{ $class->id }}" onclick="showClassNotes({{ $class->id }})">
                                                <td><img class="rounded-circle" width="50px"
                                                    src="{{ $class->photo
                                                        ? (Storage::exists('public/' . $class->photo)
                                                            ? Storage::url($class->photo)
                                                            : asset('assets/' . $class->photo))
                                                        : asset('assets/images/logo/subject-default.png') }}"></td>
                                                <td>{{ $class->name }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center">Nenhuma turma encontrada.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- TABELA DE NOTAS DO ALUNO -->
                    <div class="col-12 col-md-8">
                        <div class="border rounded p-3">
                            @foreach($classes as $class)
                                <div class="class-note-table" id="notes-for-class-{{ $class->id }}" style="display: none;">
                                    <h2 class="mb-3">Notas da Turma {{ $class->name }}</h2>
                                    <p>Notas do aluno {{ $child->name }}.</p>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Matéria</th>
                                                <th>Nota 1</th>
                                                <th>Nota 2</th>
                                                <th>Nota 3</th>
                                                <th>Nota 4</th>
                                                <th>Média</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($class->subjects as $subject)
                                                @php
                                                    // Encontrar as notas do aluno para a matéria desta turma
                                                    $childrenSubject = App\Models\ChildrenSubject::where('children_id', $child->id)
                                                        ->where('classe_subject_id', $subject->pivot->id)
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <td>{{ $subject->name }}</td>
                                                    <td>{{ $childrenSubject->score1 ?? '-' }}</td>
                                                    <td>{{ $childrenSubject->score2 ?? '-' }}</td>
                                                    <td>{{ $childrenSubject->score3 ?? '-' }}</td>
                                                    <td>{{ $childrenSubject->score4 ?? '-' }}</td>
                                                    <td>
                                                        @if($childrenSubject)
                                                            {{ number_format(($childrenSubject->score1 + $childrenSubject->score2 + $childrenSubject->score3 + $childrenSubject->score4) / 4, 1) }}
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Função para mostrar as notas da turma clicada
    function showClassNotes(classId) {
        // Ocultar todas as tabelas de notas
        document.querySelectorAll('.class-note-table').forEach(function(table) {
            table.style.display = 'none';
        });

        // Mostrar a tabela correspondente à turma clicada
        document.getElementById('notes-for-class-' + classId).style.display = 'block';
    }

    // Função de busca para a lista de turmas
    document.addEventListener('DOMContentLoaded', function() {

        // Mostrar automaticamente as notas da primeira turma ao carregar a página
        const firstClassRow = document.querySelector('.linhas');
        if (firstClassRow) {
            const firstClassId = firstClassRow.getAttribute('data-class-id');
            showClassNotes(firstClassId);
        }
    });
</script>
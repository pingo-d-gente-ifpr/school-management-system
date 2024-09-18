<div class="row">
    <!-- LISTA DE MATÉRIAS -->
    <div class="col-12 col-md-4">
        <div class="border rounded p-3">
            <h2 class="mb-3">Matérias</h2>
            <!-- Barra de Pesquisa -->
            <div class="search-attendance d-flex">
                <input type="search" class="form-attendance" id="searchGrades" placeholder="Procurar Matéria" aria-label="Procurar Matéria">
                <button class="btn" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM6.5 12A5.5 5.5 0 1 1 12 6.5 5.507 5.507 0 0 1 6.5 12z"/>
                    </svg>
                </button>
            </div>

            <!-- Tabela de Matérias -->
            <div class="overflow-auto mt-3" style="max-height: 450px;">
                <table class="table table-striped">
                    <tbody>
                        @forelse ($subjectsForNotes as $subject)
                            <tr class="linhas align-middle" data-subject-id="{{ $subject->pivot->id }}" onclick="showNotes({{ $subject->pivot->id }})">
                                <td><img class="rounded-circle" width="50px"
                                    src="{{ $subject->photo
                                        ? (Storage::exists('public/' . $subject->photo)
                                            ? Storage::url($subject->photo)
                                            : asset('assets/' . $subject->photo))
                                        : asset('assets/images/logo/subject-default.png') }}"></td>
                                <td>{{ $subject->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhuma matéria disponível.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TABELA DE NOTAS -->
    <div class="col-12 col-md-8">
        <div class="border rounded p-3">
            @foreach($subjectsForNotes as $subject)
                <div class="note-table" id="notes-for-{{ $subject->pivot->id }}" style="display: none;">
                    <h2 class="mb-3">Notas de {{ $subject->name }}</h2>
                    <p>Adicione as notas de 0 a 10.</p>
                    <form method="POST" action="{{ route('register.grades') }}">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Aluno</th>
                                    <th>Nota 1</th>
                                    <th>Nota 2</th>
                                    <th>Nota 3</th>
                                    <th>Nota 4</th>
                                    <th>Média</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($students as $student)
                                    @php
                                        $childrenSubject =  App\Models\ChildrenSubject::where('children_id', $student->id)
                                                        ->where('classe_subject_id', $subject->pivot->id)
                                                        ->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            <input type="number" class="form-control" step="0.1" min="0" max="10"
                                                   name="score1[{{ $student->id }}][{{ $subject->pivot->id }}]"
                                                   value="{{ $childrenSubject->score1 ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.1" min="0" max="10"
                                                   name="score2[{{ $student->id }}][{{ $subject->pivot->id }}]"
                                                   value="{{ $childrenSubject->score2 ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.1" min="0" max="10"
                                                   name="score3[{{ $student->id }}][{{ $subject->pivot->id }}]"
                                                   value="{{ $childrenSubject->score3 ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.1" min="0" max="10"
                                                   name="score4[{{ $student->id }}][{{ $subject->pivot->id }}]"
                                                   value="{{ $childrenSubject->score4 ?? '' }}">
                                        </td>
                                        <td>
                                            @php
                                                $media = null;
                                                if ($childrenSubject) {
                                                    $media = ($childrenSubject->score1 + $childrenSubject->score2 + $childrenSubject->score3 + $childrenSubject->score4) / 4;
                                                }
                                            @endphp
                                            <input type="text" class="form-control" id="average-{{ $student->id }}-{{ $subject->pivot->id }}"
                                                   value="{{ $media !== null ? number_format($media, 1) : '' }}" disabled>
                                        </td>
                                    </tr>
                                @empty
                                <tr class="align-middle">
                                    <td colspan="6" class="text-center">Nenhum aluno matriculado nesta turma.</td>
                                </tr>  
                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success mt-3">Salvar Notas</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateAverage(studentId, subjectId) {
            // Obter os valores das notas, ou 0 se não forem preenchidas
            const note1 = parseFloat(document.querySelector(`input[name="score1[${studentId}][${subjectId}]"]`).value) || 0;
            const note2 = parseFloat(document.querySelector(`input[name="score2[${studentId}][${subjectId}]"]`).value) || 0;
            const note3 = parseFloat(document.querySelector(`input[name="score3[${studentId}][${subjectId}]"]`).value) || 0;
            const note4 = parseFloat(document.querySelector(`input[name="score4[${studentId}][${subjectId}]"]`).value) || 0;

            // Calcular a média
            const average = (note1 + note2 + note3 + note4) / 4;

            // Atualizar o campo da média
            document.querySelector(`#average-${studentId}-${subjectId}`).value = average.toFixed(1);
        }

        // Adicionar um evento para calcular a média quando o valor de qualquer nota mudar
        document.querySelectorAll('input[name^="score"]').forEach(input => {
            input.addEventListener('input', function() {
                const [_, studentId, subjectId] = this.name.match(/score[1234]\[(\d+)]\[(\d+)]/);
                calculateAverage(studentId, subjectId);
            });
        });

        // Função para mostrar notas de uma matéria específica
        window.showNotes = function(subjectId) {
            document.querySelectorAll('.note-table').forEach(element => {
                element.style.display = 'none';
            });
            document.getElementById(`notes-for-${subjectId}`).style.display = 'block';
        };
    });
</script>

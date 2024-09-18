<div class="row">
    <!-- LISTA DE MATÉRIAS -->
    <div class="col-12 col-md-4">
        <div class="border rounded p-3">
            <h2 class="mb-3">Matérias</h2>
            <!-- Barra de Pesquisa -->
            <div class="search-attendance d-flex">
                <input type="search" class="form-attendance" id="searchGrades" placeholder="Procurar Matéria"
                    aria-label="Procurar Matéria">
                <button class="btn" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM6.5 12A5.5 5.5 0 1 1 12 6.5 5.507 5.507 0 0 1 6.5 12z" />
                    </svg>
                </button>
            </div>

            <!-- Tabela de Matérias -->
            <div class="overflow-auto mt-3" style="max-height: 450px;">
                <table class="table">
                    <tbody>
                        @forelse ($class->subjects as $subject)
                            <tr class="linhas align-middle" data-subject-id="{{ $subject->pivot->id }}"
                                onclick="showNotes({{ $subject->pivot->id }})">
                                <td><img class="rounded-circle" width="50px"
                                        src="{{ $subject->photo
                                            ? (Storage::exists('public/' . $subject->photo)
                                                ? Storage::url($subject->photo)
                                                : asset('assets/' . $subject->photo))
                                            : asset('assets/images/logo/subject-default.png') }}">
                                </td>
                                <td>{{ $subject->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhuma matéria adicionada na turma.</td>
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
            @foreach ($class->subjects as $subject)
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
                                        $childrenSubject = App\Models\ChildrenSubject::where(
                                            'children_id',
                                            $student->id,
                                        )
                                            ->where('classe_subject_id', $subject->pivot->id)
                                            ->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            <input type="number" class="form-control" step="0.1" min="0"
                                                max="10"
                                                name="score1[{{ $student->id }}][{{ $subject->pivot->id }}]"
                                                value="{{ $childrenSubject->score1 ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.1" min="0"
                                                max="10"
                                                name="score2[{{ $student->id }}][{{ $subject->pivot->id }}]"
                                                value="{{ $childrenSubject->score2 ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.1" min="0"
                                                max="10"
                                                name="score3[{{ $student->id }}][{{ $subject->pivot->id }}]"
                                                value="{{ $childrenSubject->score3 ?? '' }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" step="0.1" min="0"
                                                max="10"
                                                name="score4[{{ $student->id }}][{{ $subject->pivot->id }}]"
                                                value="{{ $childrenSubject->score4 ?? '' }}">
                                        </td>
                                        <td>
                                            @php
                                                $media = null;
                                                if ($childrenSubject) {
                                                    $media =
                                                        ($childrenSubject->score1 +
                                                            $childrenSubject->score2 +
                                                            $childrenSubject->score3 +
                                                            $childrenSubject->score4) /
                                                        4;
                                                }
                                            @endphp
                                            <input type="text" class="form-control"
                                                id="average-{{ $student->id }}-{{ $subject->pivot->id }}"
                                                value="{{ $media !== null ? number_format($media, 1) : '' }}" disabled>
                                        </td>

                                    </tr>
                                @empty
                                    <td colspan="6"class="text-center">Nenhum aluno matriculado nesta turma.</td>
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

<style>
    .linhas.active td {
        background-color: #E9ECEF;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateAverage(studentId, subjectId) {
            // Obter os valores das notas, ou 0 se não forem preenchidas
            const note1 = parseFloat(document.querySelector(`input[name="score1[${studentId}][${subjectId}]"]`)
                .value) || 0;
            const note2 = parseFloat(document.querySelector(`input[name="score2[${studentId}][${subjectId}]"]`)
                .value) || 0;
            const note3 = parseFloat(document.querySelector(`input[name="score3[${studentId}][${subjectId}]"]`)
                .value) || 0;
            const note4 = parseFloat(document.querySelector(`input[name="score4[${studentId}][${subjectId}]"]`)
                .value) || 0;

            // Verificar quais notas são maiores que 0 (preenchidas)
            const notes = [note1, note2, note3, note4].filter(note => note > 0);

            // Calcular a média se houver alguma nota preenchida
            if (notes.length > 0) {
                const total = notes.reduce((sum, note) => sum + note, 0);
                const average = (total / notes.length).toFixed(1); // Média com 1 casa decimal
                document.querySelector(`#average-${studentId}-${subjectId}`).value = average;
            } else {
                document.querySelector(`#average-${studentId}-${subjectId}`).value =
                ''; // Limpa se não houver notas
            }
        }

        // Adicionar eventos para recalcular a média quando as notas forem alteradas
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                const studentId = this.name.split('[')[1].split(']')[
                0]; // Extrai o studentId do name
                const subjectId = this.name.split('[')[2].split(']')[
                0]; // Extrai o subjectId do name
                calculateAverage(studentId, subjectId);
            });
        });
    });

    function showNotes(subjectId) {
        // Esconder todas as tabelas de notas
        document.querySelectorAll('.note-table').forEach(table => {
            table.style.display = 'none';
        });

        // Mostrar a tabela de notas correspondente à matéria clicada
        document.getElementById(`notes-for-${subjectId}`).style.display = 'block';

        // Remover a classe 'active' de todas as linhas
        document.querySelectorAll('.linhas').forEach(row => {
            row.classList.remove('active');
        });

        // Adicionar a classe 'active' à linha clicada
        const clickedRow = document.querySelector(`.linhas[data-subject-id="${subjectId}"]`);
        if (clickedRow) {
            clickedRow.classList.add('active');
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Função para pesquisar nas matérias
        $('#searchGrades').keyup(function() {
            const searchTerm = $(this).val().toLowerCase();
            $('.linhas').each(function() {
                const subjectName = $(this).text().toLowerCase();
                if (subjectName.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>

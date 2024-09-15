<div class="row">
    <div class="col-12 col-md-4">
        <div class="border rounded p-3">
            <h2 class="mb-3">Alunos</h2>
            <div class="search-attendance d-flex">
                <input type="search" class="form-attendance" id="searchGrades" placeholder="Procurar Aluno"
                    aria-label="Procurar Aluno">
                <button class="btn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM6.5 12A5.5 5.5 0 1 1 12 6.5 5.507 5.507 0 0 1 6.5 12z" />
                    </svg>
                </button>
            </div>

            <!-- Tabela de Alunos -->
            <div class="overflow-auto mt-3" style="max-height: 450px;">
                <table class="table table-striped">
                    <tbody>
                        @forelse ($studentsForNotes as $student)
                            <tr class="linhas align-middle" data-student-id="{{ $student->id }}" onclick="showNotes({{ $student->id }})">
                                <td>
                                    <img src="{{ $student->photo
                                        ? (Storage::exists('public/' . $student->photo)
                                            ? Storage::url($student->photo)
                                            : asset('assets/' . $student->photo))
                                        : asset('assets/images/logo/user-default.png') }}"
                                        alt="{{ $student->name }}" class="rounded-circle"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                </td>
                                <td>{{ $student->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Nenhum aluno cadastrado na turma.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TABELAS DE NOTAS -->
    @foreach ($studentsForNotes as $student)
        <div class="col-12 col-md-8 note-table" id="notes-for-{{ $student->id }}" style="display: none;">
            <h2 class="mb-3">Notas de {{ $student->name }}</h2>
            <div class="border rounded p-3">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')
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
                            @forelse($subjectsForNotes as $index => $subject)
                                <tr class="align-middle">
                                    <td>{{ $subject->name }}</td>
                                    <td><input type="number" class="form-control" step="0.1" min="0"
                                            max="10" id="note1-{{ $index }}-{{ $student->id }}"
                                            data-subject="{{ $index }}" data-student="{{ $student->id }}" name="note1"></td>
                                    <td><input type="number" class="form-control" step="0.1" min="0"
                                            max="10" id="note2-{{ $index }}-{{ $student->id }}"
                                            data-subject="{{ $index }}" data-student="{{ $student->id }}" name="note2"></td>
                                    <td><input type="number" class="form-control" step="0.1" min="0"
                                            max="10" id="note3-{{ $index }}-{{ $student->id }}"
                                            data-subject="{{ $index }}" data-student="{{ $student->id }}" name="note3"></td>
                                    <td><input type="number" class="form-control" step="0.1" min="0"
                                            max="10" id="note4-{{ $index }}-{{ $student->id }}"
                                            data-subject="{{ $index }}" data-student="{{ $student->id }}" name="note4"></td>
                                    <td><input type="text" class="form-control" id="average-{{ $index }}-{{ $student->id }}"
                                            disabled></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Nenhuma matéria adicionada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <x-primary-button class="btn btn-success w-auto mt-5">
                            Salvar Notas
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>

<script>
    function showNotes(studentId) {
        document.querySelectorAll('.note-table').forEach(table => {
            table.style.display = 'none';
        });

        document.getElementById(`notes-for-${studentId}`).style.display = 'block';
    }

    document.addEventListener('DOMContentLoaded', function() {
        function calculateAverage(index, studentId) {
            const note1 = parseFloat(document.getElementById(`note1-${index}-${studentId}`).value) || 0;
            const note2 = parseFloat(document.getElementById(`note2-${index}-${studentId}`).value) || 0;
            const note3 = parseFloat(document.getElementById(`note3-${index}-${studentId}`).value) || 0;
            const note4 = parseFloat(document.getElementById(`note4-${index}-${studentId}`).value) || 0;

            const notes = [note1, note2, note3, note4].filter(note => note > 0);

            if (notes.length > 0) {
                const total = notes.reduce((sum, note) => sum + note, 0);
                const average = (total / notes.length).toFixed(1);
                document.getElementById(`average-${index}-${studentId}`).value = average;
            } else {
                document.getElementById(`average-${index}-${studentId}`).value = '';
            }
        }

        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                const index = this.getAttribute('data-subject');
                const studentId = this.getAttribute('data-student');
                calculateAverage(index, studentId);
            });
        });
    });
</script>

<script>
    function searchGrades(value, targetSelector) {
        const lowerCaseValue = value.toLowerCase();
        
        $(targetSelector).each(function () {
            const text = $(this).text().toLowerCase();

            if (text.includes(lowerCaseValue)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    $('#searchGrades').keyup(function () {
        searchGrades($(this).val(), '.linhas');
    });
</script>

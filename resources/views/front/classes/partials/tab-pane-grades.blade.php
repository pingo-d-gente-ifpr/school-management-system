<div class="row">
    <!-- LISTA DE ALUNOS -->
    <div class="col-12 col-md-4">
        <div class="border rounded p-3">
            <h2 class="mb-3">Alunos</h2>

            <!-- Barra de Pesquisa -->
            <div class="mb-3">
                <input type="search" class="form-control" id="search-student" placeholder="Pesquisar aluno..." onkeyup="filterStudents()">
            </div>

            <!-- Lista de Alunos -->
            <div class="list-group list-group-flush overflow-auto" style="max-height: 450px;" id="student-list">
                @forelse ($studentsForNotes as $student)
                    <li class="list-group-item list-group-item-action d-flex align-items-center">
                        <img src="{{ $student->photo
                            ? (Storage::exists('public/' . $student->photo)
                                ? Storage::url($student->photo)
                                : asset('assets/' . $student->photo))
                            : asset('assets/images/logo/user-default.png') }}" alt="{{ $student->name }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                        {{ $student->name }}
                    </li>
                @empty
                    <li class="list-group-item text-center">Nenhum aluno cadastrado na turma.</li>
                @endforelse
            </div>
        </div>
    </div>

    <!-- TABELA DE NOTAS -->
    <div class="col-12 col-md-8">
        <h2 class="mb-3">Notas</h2>
        <div class="border rounded p-3">
            <form action="{{ route('register.grades') }}" method="POST">
                @csrf
                @method('P')
                <table class="table">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th>Disciplina</th>
                            <th>Nota 1</th>
                            <th>Nota 2</th>
                            <th>Nota 3</th>
                            <th>Nota 4</th>
                            <th>Média</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentsForNotes as $student)
                            @foreach($subjectsForNotes as $subject)
                                @php
                                    // Busca as notas do aluno nessa disciplina
                                    $childrenSubject = $childrenSubjects->where('children_id', $student->id)
                                                      ->where('classe_subject_id', $subject->id)
                                                      ->first();
                                @endphp
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>
                                        <input type="number" class="form-control" name="score1[{{ $student->id }}][{{ $subject->id }}]" value="{{ $childrenSubject->score1 ?? '' }}" step="0.1" min="0" max="10">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="score2[{{ $student->id }}][{{ $subject->id }}]" value="{{ $childrenSubject->score2 ?? '' }}" step="0.1" min="0" max="10">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="score3[{{ $student->id }}][{{ $subject->id }}]" value="{{ $childrenSubject->score3 ?? '' }}" step="0.1" min="0" max="10">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control" name="score4[{{ $student->id }}][{{ $subject->id }}]" value="{{ $childrenSubject->score4 ?? '' }}" step="0.1" min="0" max="10">
                                    </td>
                                    <td>
                                        @php
                                            $media = null;
                                            if ($childrenSubject) {
                                                $media = ($childrenSubject->score1 + $childrenSubject->score2 + $childrenSubject->score3 + $childrenSubject->score4) / 4;
                                            }
                                        @endphp
                                        <input type="text" class="form-control" value="{{ $media !== null ? number_format($media, 2) : '' }}" disabled>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary mt-3">Salvar Notas</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Código JavaScript para filtrar alunos
    function filterStudents() {
        const searchTerm = document.getElementById('search-student').value.toLowerCase();
        const studentItems = document.querySelectorAll('#student-list .list-group-item');
        
        studentItems.forEach(item => {
            const studentName = item.textContent.toLowerCase();
            if (studentName.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>

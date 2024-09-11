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
            <div class="list-group list-group-flush overflow-auto" style="max-height: 450px;">
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
            <table class="table">
                <thead>
                    <tr>
                        <th>Disciplina</th>
                        <th>Nota 1</th>
                        <th>Nota 2</th>
                        <th>Nota 3</th>
                        <th>Nota 4</th>
                        <th>Média</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjectsForNotes as $subject)
                        <tr>
                            <td>{{ $subject->name }}</td>
                            <td><input type="number" class="form-control" step="0.1" min="0" max="10"></td>
                            <td><input type="number" class="form-control" step="0.1" min="0" max="10"></td>
                            <td><input type="number" class="form-control" step="0.1" min="0" max="10"></td>
                            <td><input type="number" class="form-control" step="0.1" min="0" max="10"></td>
                            <td><input type="text" class="form-control" disabled></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhuma matéria adicionada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

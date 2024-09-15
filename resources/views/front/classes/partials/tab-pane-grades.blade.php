<div class="row">
    <!-- LISTA DE ALUNOS -->
    <div class="col-12 col-md-4">
        <div class="border rounded p-3">
            <h2 class="mb-3">Alunos</h2>

            <!-- Lista de Alunos -->
            <div class="list-group list-group-flush overflow-auto" style="max-height: 450px;">
                @forelse ($studentsForNotes as $student)
                    <li class="list-group-item list-group-item-action d-flex align-items-center linhas">
                        <img src="{{ $student->photo
                            ? (Storage::exists('public/' . $student->photo)
                                ? Storage::url($student->photo)
                                : asset('assets/' . $student->photo))
                            : asset('assets/images/logo/user-default.png') }}"
                            alt="{{ $student->name }}" class="rounded-circle me-2"
                            style="width: 40px; height: 40px; object-fit: cover;">
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
                                        max="10" id="note1-{{ $index }}"
                                        data-subject="{{ $index }}" :value="old('',)" name="note1"></td>
                                <td><input type="number" class="form-control" step="0.1" min="0"
                                        max="10" id="note2-{{ $index }}"
                                        data-subject="{{ $index }}" :value="old('',)" name="note2"></td>
                                <td><input type="number" class="form-control" step="0.1" min="0"
                                        max="10" id="note3-{{ $index }}"
                                        data-subject="{{ $index }}" :value="old('',)" name="note3"></td>
                                <td><input type="number" class="form-control" step="0.1" min="0"
                                        max="10" id="note4-{{ $index }}"
                                        data-subject="{{ $index }}" :value="old('',)" name="note4"></td>
                                <td><input type="text" class="form-control" id="average-{{ $index }}"
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
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function calculateAverage(index) {
            const note1 = parseFloat(document.getElementById(`note1-${index}`).value) || 0;
            const note2 = parseFloat(document.getElementById(`note2-${index}`).value) || 0;
            const note3 = parseFloat(document.getElementById(`note3-${index}`).value) || 0;
            const note4 = parseFloat(document.getElementById(`note4-${index}`).value) || 0;

            // Array para armazenar as notas preenchidas
            const notes = [note1, note2, note3, note4].filter(note => note > 0);

            if (notes.length > 0) {
                const total = notes.reduce((sum, note) => sum + note, 0);
                const average = (total / notes.length).toFixed(1);
                document.getElementById(`average-${index}`).value = average;
            } else {
                document.getElementById(`average-${index}`).value = '';
            }
        }

        // Adiciona o evento de input para cada campo de nota
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                const index = this.getAttribute('data-subject');
                calculateAverage(index);
            });
        });
    });
</script>

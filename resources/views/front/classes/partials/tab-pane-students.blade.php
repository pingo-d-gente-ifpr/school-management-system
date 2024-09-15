<div class="search-attendance d-flex">
    <input type="search" class="form-attendance" id="searchStudents" placeholder="Procurar Aluno" aria-label="Procurar Aluno">
    <button class="btn" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM6.5 12A5.5 5.5 0 1 1 12 6.5 5.507 5.507 0 0 1 6.5 12z"/>
        </svg>
    </button>
</div>

<table class="table table-striped" id="studentsTable">
    <thead>
        <tr class="align-middle">
            <th scope="col"></th>
            <th scope="col">Nome</th>
            <th scope="col">Matrícula</th>
            <th scope="col">Status</th>
            <th scope="col">Modificado em</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($students as $student)
            <tr class="linhas align-middle">
                <td>
                    <img class="rounded-circle" width="50px"
                        src="{{ $student->photo
                            ? (Storage::exists('public/' . $student->photo)
                                ? Storage::url($student->photo)
                                : asset('assets/' . $student->photo))
                            : asset('assets/images/logo/user-default.png') }}">
                </td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->register_number }}</td>
                <td>{{ $student->status }}</td>
                <td>{{ $student->updated_at->format('d/m/Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Nenhum aluno matriculado encontrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<x-admin.search/>

<table class="table table-striped">
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

<!-- Paginação -->
<div class="d-flex justify-content-center">
    {{ $students->withQueryString()->links('components.custom-pagination') }}
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const activeTab = localStorage.getItem('activeTab');
    if (activeTab) {
        const tabElement = document.querySelector(`#myTab button[data-bs-target="${activeTab}"]`);
        const tab = new bootstrap.Tab(tabElement);
        tab.show();
    }

    document.querySelectorAll('#myTab button').forEach(function (tabButton) {
        tabButton.addEventListener('shown.bs.tab', function (event) {
            const activeTab = event.target.getAttribute('data-bs-target');
            localStorage.setItem('activeTab', activeTab);
        });
    });
});
</script>
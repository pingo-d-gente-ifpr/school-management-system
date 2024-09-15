<table class="table table-striped">
    <div class="search-attendance d-flex">
        <input type="search" class="form-attendance" id="search" placeholder="Procurar Matéria"
            aria-label="Procurar Aluno">
        <button class="btn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path
                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM6.5 12A5.5 5.5 0 1 1 12 6.5 5.507 5.507 0 0 1 6.5 12z" />
            </svg>
        </button>
    </div>
    <thead>
        <tr class="align-middle">
            <th scope="col"></th>
            <th scope="col" class="">Nome</th>
            <th scope="col">Professor(a)</th>
            <th scope="col">Modificado em</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subjects as $subject)
            <tr class="linhas align-middle">
                <td>
                    <img class="rounded-circle" width="50px"
                        src="{{ $subject->photo
                            ? (Storage::exists('public/' . $subject->photo)
                                ? Storage::url($subject->photo)
                                : asset('assets/' . $subject->photo))
                            : asset('assets/images/logo/subject-default.png') }}">
                </td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->pivot->user->name }}</td>
                <td>{{ $subject->updated_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $subjects->withQueryString()->links('components.custom-pagination') }}
</div>

{{-- <script>
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
</script> --}}


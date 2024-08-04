<table class="table table-striped">
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
            <tr class="align-middle">
                <td>
                    <img class="rounded-circle" width="50px"
                        src="{{ $subject->photo
                            ? (Storage::exists('public/' . $subject->photo)
                                ? Storage::url($subject->photo)
                                : asset('assets/' . $subject->photo))
                            : asset('assets/images/logo/subject-default.png') }}">
                </td>
                <td>{{ $subject->name }}</td>
                <td>{{ $subject->user->name ?? " " }}</td>
                <td>{{ $subject->updated_at->format('d/m/Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<!-- Paginação -->
<div class="d-flex justify-content-center">
    {{ $subjects->withQueryString()->links('components.custom-pagination') }}
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

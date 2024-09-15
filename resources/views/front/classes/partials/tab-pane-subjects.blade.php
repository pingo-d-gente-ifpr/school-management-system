

<table class="table table-striped">
    <x-admin.search :placeholder="'Procurar Matéria'"/>
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



<x-app-layout>
    <div class="col-10 col-md-10 mx-auto my-4">
        <h1>Matérias</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <span class="material-icons breadcrumb-icon">home</span>
                        Início
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Matérias</li>
            </ol>
        </nav>
        <div class="container mt-3">
            <div class="row align-items-center mb-3">
                <div class="col-lg-3 p-0 m-0">
                    <h5 style="color: #787878">Controle de matérias</h5>
                </div>
                <div class="col-lg-9 p-0 m-0">
                    <hr style="height: 2px; background-color: #ff6b8a; border: none;">
                </div>
            </div>
        </div>
        <div class="table-container bg-white rounded p-2">
            <table class="table table-hover">
                <thead>
                    <tr class="align-middle">
                        <th scope="col"></th>
                        <th scope="col" class="">Nome</th>
                        <th scope="col">Professor(a)</th>
                        <th scope="col">Modificado em</th>
                        <th class="d-flex justify-content-end" scope="col">
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal" type="button"
                                class="btn btn-success btn-sm d-flex align-items-center text-uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                </svg>
                                <span class="ms-2">Cadastrar Matéria</span>
                            </button>
                        </th>
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
                            <td>{{ $subject->user->name }}</td>
                            <td>{{ $subject->email }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('subjects.edit', $subject->id) }}" class="btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $subjects->links('components.custom-pagination') }}
            </div>
        </div>
    </div>
    <!-- Modal Create Subjects-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Criar Matéria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('subjects.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome da Matéria<b>*</b></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        @if (Auth::user()->role == 'Admin')
                            <div>
                                <label for="role" class="form-label">Professor(a)<b>*</b></label>
                                <select class="form-select" id="user_id" name="user_id" required>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">Horário de Início</label>
                                <input class="form-control" placeholder="Selecione um horário" id="start_date"
                                    name="start_date" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">Horário de Término</label>
                                <input class="form-control" placeholder="Selecione um horário" id="end_date"
                                    name="end_date" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row align-items-start">
                                <x-input-label for="photo"
                                    class="form-label col-sm-2 col-lg-2">Foto:</x-input-label>
                                <input class="form-control form-control-sm col-sm-10 col-lg-10" id="photo"
                                    type="file" name="photo">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const startDate = document.getElementById("start_date");
        const startDatefp = flatpickr(startDate, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minuteIncrement: 1,
            time_24hr: true,
            readOnly: false,
        });
        const endDate = document.getElementById("end_date");
        const endDatefp = flatpickr(endDate, {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            minuteIncrement: 1,
            time_24hr: true,
            readOnly: false,
        });
    </script>
</x-app-layout>

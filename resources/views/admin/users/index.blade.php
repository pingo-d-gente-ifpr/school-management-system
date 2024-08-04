<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Usuários</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <span class="material-icons breadcrumb-icon">home</span>
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <div class="row align-items-center mb-3">
                    <div class="col-lg-3 p-0 m-0">
                        <h5 style="color: #787878">Controle de usuários</h5>
                    </div>
                    <div class="col-lg-9 p-0 m-0">
                        <hr style="height: 2px; background-color: #FF6B8A; border: none;">
                    </div>
                    <x-admin.search/>
                </div>
                <div>
                    @if (session('deletado'))
                        <div class="alert alert-success" role="alert" id="deletado-alert">
                            {{ session('deletado') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="table-container bg-white rounded p-2">
                <table class="table table-hover">
                    <thead class="text-capitalize">
                        <tr class="align-middle">
                            <th scope="col"></th>
                            <th scope="col">Nome do Usuário</th>
                            <th scope="col">Atualizado em</th>
                            <th scope="col">Tipo do Usuário</th>
                            <th scope="col">Email</th>
                            <th class="d-flex justify-content-end" scope="col">
                                <button type="button" class="btn btn-success btn-sm d-flex align-items-center"
                                    onclick="location.href='{{ route('users.create') }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    <span class="ms-2">Cadastrar Usuário</span>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="align-middle">
                                <td><img class="rounded-circle" width="50px"
                                        src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/logo/user-default.png') }}">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y') }}</td>
                                <td>{{ App\Enums\Role::from($user->role)->name() }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn-show">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                                <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                                              </svg>
                                        </a>

                                        <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                                fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                        </a>
                                        @include('admin.users.partials.delete-user-form', [
                                            'userId' => $user->id,
                                            'userName' => $user->name,
                                        ])
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $users->links('components.custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
    <style>
        .alert {
            opacity: 1;
            transition: opacity 1s ease-out;
        }

        .alert.fade-out {
            opacity: 0;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alertElement = document.getElementById('deletado-alert');
            if (alertElement) {
                setTimeout(function() {
                    alertElement.classList.add('fade-out');
                    // Opcional: Remova o elemento do DOM após a transição
                    setTimeout(function() {
                        alertElement.remove();
                    }, 1000); // Tempo de transição deve ser igual ou maior que o tempo de opacidade
                }, 5000); // Tempo antes de iniciar a transição
            }
        });
    </script>

</x-app-layout>

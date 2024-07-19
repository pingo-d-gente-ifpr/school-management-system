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
                    </div>
                </div>
                <div class="table-container bg-white rounded p-2">
                    <table class="table table-hover">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col"></th>
                                <th scope="col">Nome do Usuário</th>
                                <th scope="col">Atualizado em</th>
                                <th scope="col">Tipo do Usuário</th>
                                <th scope="col">Email</th>
                                <th class="d-flex justify-content-end" scope="col">
                                    <button type="button" class="btn btn-success btn-sm d-flex align-items-center ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                        </svg>
                                        <span class="ms-2">Cadastrar Usuário</span>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><img class="rounded-circle" width="50px" src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/logo/user-default.png') }}"></td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/Y') }}</td>
                                    <td class="align-middle">{{ $user->role }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end">
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-app-layout>

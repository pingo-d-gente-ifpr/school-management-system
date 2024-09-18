<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Perfil</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <span class="material-icons breadcrumb-icon">home</span>
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('users.index') }}">
                            Usuários
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <hr style="height: 2px; background-color: #FF6B8A; border: none;">
            </div>
            <div class="table-container bg-white rounded p-4">
                <div class="d-flex justify-content-between">
                    <h3>Informações Pessoais</h3>
                    <button type="button" class="btn btn-success d-flex align-items-center mt-2"
                        onclick="location.href='{{ route('users.edit', $user->id) }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                          <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                          <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                        <span class="ms-2">Editar Perfil</span>
                    </button>
                </div>

                <div class="row mb-3">

                    <div class="col-md-2 text-center position-relative">
                        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('assets/images/logo/user-default.png') }}"
                            class="img-fluid rounded-circle mb-2" alt="User Avatar">

                    </div>
                    <div class="col-md-10 d-flex flex-column justify-content-center">
                        {{-- <h2>{{ $user->name }}</h2>
                    <hr> --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p><strong>Nome:</strong> {{ $user->name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p><strong>Gênero:</strong> {{ \App\Enums\Gender::from($user->gender)->name() }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p><strong>Tipo de Usuário:</strong> {{ \App\Enums\Role::from($user->role)->name() }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <p><strong>CPF:</strong> {{ $user->document_cpf }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p><strong>Telefone:</strong> {{ $user->cellphone }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <p><strong>Data de Nascimento:</strong>
                                    {{ \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') }}</p>
                            </div>
                        </div>

                    </div>
                </div>

                <hr>

              <h3>Endereço</h3>
              <div class="row mb-3">
                  <div class="col-md-6 mb-3">
                      <p><strong>Rua:</strong> {{ $user->street }}</p>
                  </div>
                  <div class="col-md-6 mb-3">
                      <p><strong>Número:</strong> {{ $user->number }}</p>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-md-4 mb-3">
                      <p><strong>Bairro:</strong> {{ $user->neighborhood }}</p>
                  </div>
                  <div class="col-md-4 mb-3">
                      <p><strong>Cidade:</strong> {{ $user->city }}</p>
                  </div>
                  <div class="col-md-4 mb-3">
                      <p><strong>Estado:</strong> {{ $user->state }}</p>
                  </div>
              </div>
              <div class="row mb-3">
                  <div class="col-md-4 mb-3">
                      <p><strong>CEP:</strong> {{ $user->zip_code }}</p>
                  </div>
              </div>

                <hr>

                {{-- Crianças do Usuário --}}
                <h3>Crianças</h3>
                @foreach ($user->childrens()->get() as $children)
                    <div class="row mb-3">
                        <div class="col-md-2 text-center position-relative">
                            <img src="{{ $children->photo_url ?? asset('assets/images/logo/user-default.png') }}"
                                class="img-fluid rounded-circle mb-2" alt="children Avatar">
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p><strong>Nome:</strong> {{ $children->name }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p><strong>Data de Nascimento:</strong>
                                        {{ \Carbon\Carbon::parse($children->birth_date)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <p><strong>Documento (RG):</strong> {{ $children->document }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <p><strong>Gênero:</strong>
                                        {{ \App\Enums\Gender::from($children->gender)->name() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>

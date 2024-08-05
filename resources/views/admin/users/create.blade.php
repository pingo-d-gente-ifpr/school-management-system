<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Cadastro de Usuário</h1>
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
                    <li class="breadcrumb-item active" aria-current="page">Cadastro de Usuário</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <hr style="height: 2px; background-color: #FF6B8A; border: none;">
            </div>
            <div class="table-container bg-white rounded p-4">
                <ul class="nav nav-underline" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados"
                            type="button" role="tab" aria-controls="dados" aria-selected="true">Dados do
                            Usuário</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="endereco-tab" data-bs-toggle="tab" data-bs-target="#endereco"
                            type="button" role="tab" aria-controls="endereco"
                            aria-selected="false">Endereço</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="dependentes-tab" data-bs-toggle="tab" data-bs-target="#dependentes"
                            type="button" role="tab" aria-controls="dependentes"
                            aria-selected="false">Dependentes</button>
                    </li>
                </ul>
                <form method="POST" enctype="multipart/form-data" action="{{ route('register') }}" class="p-3">
                    @csrf
                    <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dados" role="tabpanel"
                                aria-labelledby="dados-tab">
                                <div class="row mb-3">
                                    <div class="col-md-2 text-center position-relative">
                                        <img id="avatar-preview" src="{{ asset('assets/images/logo/user-default.png') }}"
                                            class="img-fluid rounded-circle mb-2" alt="User Avatar">
                                        <div class="position-absolute top-0 end-0 p-1">
                                            <button type="button" class="btn btn-danger btn-sm rounded-circle"
                                                onclick="resetImage()" id="delete-image" hidden>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="custom-file-upload mt-2">
                                            <input id="photo" type="file" name="photo" accept="image/*"
                                                onchange="previewImage(event)" />
                                            <label for="photo" class="btn btn-success btn-block">CARREGAR</label>
                                        </div>
                                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                    </div>

                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Nome e Sobrenome</label>
                                                <x-text-input id="name" class="form-control" type="text"
                                                    name="name" :value="old('name')" autofocus autocomplete="name" />
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <x-text-input id="email" class="form-control" type="email"
                                                    name="email" :value="old('email')" autocomplete="username" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="document_cpf" class="form-label">CPF</label>
                                                <x-text-input id="document_cpf" class="form-control" type="text"
                                                    name="document_cpf" :value="old('document_cpf')" autofocus autocomplete="cpf" />
                                                <x-input-error :messages="$errors->get('document_cpf')" class="mt-2" />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="cellphone" class="form-label">Telefone</label>
                                                <x-text-input id="cellphone" class="form-control" type="text"
                                                    name="cellphone" :value="old('cellphone')" autocomplete="cellphone" />
                                                <x-input-error :messages="$errors->get('cellphone')" class="mt-2" />
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="birth_date" class="form-label">Data de Nascimento</label>
                                                <input id="birth_date" type="date" class="form-control"
                                                    name="birth_date" :value="old('birth_date')" />
                                                <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="password" class="form-label">Senha</label>
                                                <x-text-input id="password" class="form-control" type="password"
                                                    name="password" autocomplete="new-password" />
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="password_confirmation" class="form-label">Confirmar
                                                    Senha</label>
                                                <x-text-input id="password_confirmation" class="form-control"
                                                    type="password" name="password_confirmation"
                                                    autocomplete="new-password" />
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="emergency_contact" class="form-label">Nome do Contato de
                                                    Emergência (Opcional)</label>
                                                <x-text-input id="emergency_contact" class="form-control" type="text"
                                                    name="emergency_contact" :value="old('emergency_contact')" autofocus
                                                    autocomplete="emergency-contact" />
                                                <x-input-error :messages="$errors->get('emergency_contact')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="emergency_phone" class="form-label">Telefone do Contato de
                                                    Emergência (Opcional)</label>
                                                <x-text-input id="emergency_phone" class="form-control" type="text"
                                                    name="emergency_phone" :value="old('emergency_phone')" autofocus
                                                    autocomplete="emergency-cellphone" />
                                                <x-input-error :messages="$errors->get('emergency_phone')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="gender" class="form-label">Gênero</label>
                                                <div>
                                                    @foreach (\App\Enums\Gender::cases() as $gender)
                                                        <input type="radio" class="btn-check" name="gender"
                                                            id="{{ $gender->value }}" value="{{ $gender->value }}"
                                                            autocomplete="off">
                                                        <label class="btn btn-light"
                                                            for="{{ $gender->value }}">{{ $gender->name }}</label>
                                                    @endforeach
                                                </div>
                                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="role" class="form-label">Tipo de Usuário</label>
                                                <div>
                                                    <input type="radio" class="btn-check" name="role"
                                                        id="admin" value="admin" autocomplete="off">
                                                    <label class="btn btn-light" for="admin">Admin</label>

                                                    <input type="radio" class="btn-check" name="role"
                                                        id="teacher" value="teacher" autocomplete="off">
                                                    <label class="btn btn-light" for="teacher">Professor(a)</label>

                                                    <input type="radio" class="btn-check" name="role"
                                                        id="parents" value="parents" autocomplete="off">
                                                    <label class="btn btn-light" for="parents">Responsável</label>
                                                </div>
                                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="endereco" role="tabpanel" aria-labelledby="endereco-tab">
                                <div class='child-entry my-3 p-3 border rounded'>
                                    <div class="row">
                                        <form style="width: 50%;" class="search-form search-header d-flex align-items-center">
                                            <div class="col-md-6 mb-3">
                                                <label for="address[0][zip_code]" class="form-label">CEP *</label>
                                                <x-text-input id="address[0][zip_code]" class="form-control" type="text"
                                                    name="address[0][zip_code]" :value="old('zip_code')" placeholder="Digite o CEP" autofocus autocomplete="zip_code" />
                                                <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="address[0][street]" class="form-label">Rua</label>
                                                <x-text-input id="address[0][street]" class="form-control" type="text"
                                                    name="address[0][street]" :value="old('address[0][street]')" autofocus autocomplete="address[0][street]" readonly/>
                                                <x-input-error :messages="$errors->get('address[0][street]')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="address[0][number]" class="form-label">Número</label>
                                                <x-text-input id="address[0][number]" class="form-control" type="text"
                                                    name="address[0][number]" :value="old('address[0][number]')" autofocus autocomplete="address[0][number]"/>
                                                <x-input-error :messages="$errors->get('address[0][number]')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="address[0][complement]" class="form-label">Complemento (Opicional)</label>
                                                <x-text-input id="address[0][complement]" class="form-control" type="text"
                                                    name="address[0][complement]" :value="old('address[0][complement]')" autofocus autocomplete="address[0][complement]"/>
                                                <x-input-error :messages="$errors->get('address[0][complement]')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="address[0][neighborhood]" class="form-label">Bairro</label>
                                                <x-text-input id="address[0][neighborhood]" class="form-control" type="text"
                                                    name="address[0][neighborhood]" :value="old('address[0][neighborhood]')" autofocus autocomplete="address[0][neighborhood]" readonly/>
                                                <x-input-error :messages="$errors->get('address[0][neighborhood]')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="address[0][city]" class="form-label">Cidade</label>
                                                <x-text-input id="address[0][city]" class="form-control" type="text"
                                                    name="address[0][city]" :value="old('address[0][city]')" autofocus autocomplete="address[0][city]" readonly/>
                                                <x-input-error :messages="$errors->get('address[0][city]')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="address[0][state]" class="form-label">UF</label>
                                                <x-text-input id="address[0][state]" class="form-control" type="text"
                                                    name="address[0][state]" :value="old('address[0][state]')" autofocus autocomplete="address[0][state]" readonly/>
                                                <x-input-error :messages="$errors->get('address[0][state]')" class="mt-2" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="dependentes" role="tabpanel"
                                aria-labelledby="dependentes-tab">
                                <button type="button" class="btn btn-success mb-3" onclick="addChild()">Adicionar Dependente</button>
                                <div id="childrens" class="mt-3">

                                    <div class='child-entry row mb-3 my-3 p-3 border rounded'>
                                    <div class="col-md-2 text-center position-relative">
                                        <img id="children-avatar-preview-0" src="{{ asset('assets/images/logo/user-default.png') }}" class="img-fluid rounded-circle mb-2" alt="children Avatar">

                                        <div class="position-absolute top-0 end-0 p-1">
                                            <button type="button" class="btn btn-danger btn-sm rounded-circle" onclick="resetchildrenImage(0)" id="delete-children-image-0" hidden>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                </svg>
                                            </button>
                                        </div>

                                        <div class="custom-file-upload mt-2">
                                                <input id="children-photo-0" type="file" name="childrens[0][photo]" accept="image/*" onchange="previewchildrenImage(event, 0)" />
                                                <label for="children-photo-0" class="btn btn-success btn-block">CARREGAR</label>
                                        </div>
                                        <x-input-error :messages="$errors->get('childrens[0][photo]')" class="mt-2" />
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="children-name-0" class="form-label">Nome</label>
                                                <x-text-input id="children-name-0" class="form-control" type="text" name="childrens[0][name]" />
                                                <x-input-error :messages="$errors->get('childrens[0][name]')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="children-birth_date-0" class="form-label">Data de Nascimento</label>
                                                <input id="children-birth_date-0" type="date" class="form-control" name="childrens[0][birth_date]" />
                                                <x-input-error :messages="$errors->get('childrens[0][birth_date]')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="children-document-0" class="form-label">Documento (RG)</label>
                                                <x-text-input id="children-document-0" class="form-control" type="text" name="childrens[0][document]" />
                                                <x-input-error :messages="$errors->get('childrens[0][document]')" class="mt-2" />
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="children-gender-0" class="form-label">Gênero</label>
                                            <div> @foreach (\App\Enums\Gender::cases() as $gender) <input type="radio" class="btn-check" name="childrens[0][gender]" id="children-gender-{{ $gender->value }}-0" value="{{ $gender->value }}" autocomplete="off">
                                                <label class="btn btn-light" for="children-gender-{{ $gender->value }}-0">{{ $gender->name }}</label> @endforeach
                                        </div>
                                        <x-input-error :messages="$errors->get('childrens[0][gender]')" class="mt-2" />
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <x-primary-button class="btn btn-success w-auto mt-5">
                                {{ __('CADASTRAR USUÁRIO') }}
                            </x-primary-button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <style>
        input[readonly] {
            background-color: #f0f0f0;
            cursor: not-allowed;
        }

        .custom-file-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .custom-file-upload input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .custom-file-upload label {
            display: inline-block;
            cursor: pointer;
            font-weight: 600;
        }

        .custom-file-upload label:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            var output = document.getElementById('avatar-preview');
            var deleteButton = document.getElementById('delete-image');

            reader.onload = function() {
                output.src = reader.result;
                deleteButton.hidden = false;
            }

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }

        // Resetar a imagem do usuário
        function resetImage() {
            var output = document.getElementById('avatar-preview');
            var deleteButton = document.getElementById('delete-image');
            var fileInput = document.getElementById('photo');

            output.src = "{{ asset('assets/images/logo/user-default.png') }}"; // Reset image
            deleteButton.hidden = true;
            fileInput.value = "";
        }

        function addChild() {
            const childrensDiv = document.getElementById('childrens');
            const childNumber = childrensDiv.children.length;

            const newChildDiv = document.createElement('div');
            newChildDiv.classList.add('child-entry', 'my-3', 'p-3', 'border', 'rounded', 'row');
            newChildDiv.innerHTML = `
                <div class="col-md-2 text-center position-relative">
                    <img id="children-avatar-preview-0" src="{{ asset('assets/images/logo/user-default.png') }}" class="img-fluid rounded-circle mb-2" alt="children Avatar">

                    <div class="position-absolute top-0 end-0 p-1">
                        <button type="button" class="btn btn-danger btn-sm rounded-circle" onclick="resetchildrenImage(${childNumber})" id="delete-children-image-0" hidden>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                            </svg>
                        </button>
                    </div>

                    <div class="custom-file-upload mt-2">
                            <input id="children-photo-0" type="file" name="childrens[${childNumber}][photo]" accept="image/*" onchange="previewchildrenImage(event, ${childNumber})" />
                            <label for="children-photo-0" class="btn btn-success btn-block">CARREGAR</label>
                    </div>
                    <x-input-error :messages="$errors->get('childrens[${childNumber}][photo]')" class="mt-2" />
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="children-name-0" class="form-label">Nome</label>
                            <x-text-input id="children-name-0" class="form-control" type="text" name="childrens[${childNumber}][name]" />
                            <x-input-error :messages="$errors->get('childrens[${childNumber}][name]')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="children-birth_date-0" class="form-label">Data de Nascimento</label>
                            <input id="children-birth_date-0" type="date" class="form-control" name="childrens[${childNumber}][birth_date]" />
                            <x-input-error :messages="$errors->get('childrens[${childNumber}][birth_date]')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="children-document-0" class="form-label">Documento (RG)</label>
                            <x-text-input id="children-document-0" class="form-control" type="text" name="childrens[${childNumber}][document]" />
                            <x-input-error :messages="$errors->get('childrens[${childNumber}][document]')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="children-gender-0" class="form-label">Gênero</label>
                        <div> @foreach (\App\Enums\Gender::cases() as $gender) <input type="radio" class="btn-check" name="childrens[${childNumber}][gender]" id="children-gender-{{ $gender->value }}-${childNumber}" value="{{ $gender->value }}" autocomplete="off">
                            <label class="btn btn-light" for="children-gender-{{ $gender->value }}-${childNumber}">{{ $gender->name }}</label> @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('childrens[${childNumber}][gender]')" class="mt-2" />
                </div>
            </div> `;
            childrensDiv.appendChild(newChildDiv);
        }

        function resetchildrenImage(index) {
            document.getElementById(`children-photo-${index}`).value = '';
            document.getElementById(`children-avatar-preview-${index}`).src =
                "{{ asset('assets/images/logo/user-default.png') }}";
        }

        function previewchildrenImage(event, index) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById(`children-avatar-preview-${index}`).src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cepInput = document.getElementById('address[0][zip_code]');
        const logradouroInput = document.getElementById('address[0][street]');
        const bairroInput = document.getElementById('address[0][neighborhood]');
        const cidadeInput = document.getElementById('address[0][city]');
        const ufInput = document.getElementById('address[0][state]');

        cepInput.addEventListener('blur', function () {
            const zip_code = cepInput.value.replace(/\D/g, '');

            if (zip_code.length === 8) {
                fetch(`https://viacep.com.br/ws/${zip_code}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.erro) {
                            alert('CEP não encontrado.');
                            return;
                        }
                        logradouroInput.value = data.logradouro || '';
                        bairroInput.value = data.bairro || '';
                        cidadeInput.value = data.localidade || '';
                        ufInput.value = data.uf || '';
                    })
                    .catch(error => console.error('Erro:', error));
            }
        });
    });
    </script>

</x-app-layout>

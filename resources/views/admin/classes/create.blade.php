<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Cadastro de Turmas</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <span class="material-icons breadcrumb-icon">home</span>
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="">
                            Turmas
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Cadastro de Turmas</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <hr style="height: 2px; background-color: #FF6B8A; border: none;">
            </div>
            <div class="table-container bg-white rounded p-4">
                <form method="POST" enctype="multipart/form-data" action="{{ route('classes.store') }}" class="p-3">
                    @csrf
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
                                    <label for="name" class="form-label">Nome da Turma</label>
                                    <x-text-input id="name" class="form-control" type="text" name="name"
                                        :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="year" class="form-label">Ano</label>
                                    <x-text-input id="year" class="form-control" type="number" name="year"
                                        :value="old('year')" required autofocus autocomplete="year" min="1900"
                                        max="2099" step="1" value="2024" />
                                    <x-input-error :messages="$errors->get('year')" class="mt-2" />
                                </div>
                            </div>

                            <div class="row">
                                <!-- Seleção de Período -->
                                <div class="col-md-6 mb-3">
                                    <label for="period" class="form-label">Período</label>
                                    <div>
                                        @foreach (App\Enums\Period::cases() as $period)
                                            <input type="radio" class="btn-check" name="period"
                                                id="{{ $period->value }}" value="{{ $period->value }}"
                                                autocomplete="off">
                                            <label class="btn btn-light"
                                                for="{{ $period->value }}">{{ $period->name() }}</label>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('period')" class="mt-2" />
                                </div>

                                <!-- Seleção de Nível -->
                                <div class="col-md-6 mb-3">
                                    <label for="stage" class="form-label">Nível</label>
                                    <div>
                                        @foreach (App\Enums\Stage::cases() as $stage)
                                            <input type="radio" class="btn-check" name="stage"
                                                id="{{ $stage->value }}" value="{{ $stage->value }}" autocomplete="off">
                                            <label class="btn btn-light"
                                                for="{{ $stage->value }}">{{ $stage->name() }}</label>
                                        @endforeach
                                    </div>
                                    <x-input-error :messages="$errors->get('stage')" class="mt-2" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <button id="open-list-cat" type="button" class="btn btn-primary mb-3"
                                        data-bs-toggle="modal" data-bs-target="#subjectsModal">
                                        Adicionar Matérias
                                    </button>

                                    <!-- Div para mostrar matérias selecionadas -->
                                    <div id="subjects-check" class="row mt-3">
                                        <!-- Matérias selecionadas aparecerão aqui -->
                                    </div>
                                    <div id="selected-subjects-inputs"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <x-primary-button class="btn btn-success w-auto mt-5">
                                {{ __('CADASTRAR TURMA') }}
                            </x-primary-button>
                        </div>

                    </div>
            </div>
            </form>
        </div>
    </div>


    <!-- Modal para selecionar matérias -->
    <div class="modal fade" id="subjectsModal" tabindex="-1" aria-labelledby="subjectsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subjectsModalLabel">Selecione as Matérias</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="list-categ">
                        <div class="row">
                            @if ($subjects->count() == 0)
                                <h6 class="col-12 py-2">Nenhuma matéria criada, tente criar <a
                                        href="{{ route('subjects.store') }}">novas matérias</a></h6>
                            @endif
                        </div>
                        <div class="row">
                            @foreach ($subjects as $subject)
                                <div class="col-md-4">
                                    <input class="check-subjects" type="checkbox"
                                        name="subjects[{{ $subject->id }}][id]"
                                        data-handle-name="{{ $subject->name }}"
                                        data-handle-id="category_{{ $subject->id }}"
                                        id="category_{{ $subject->id }}" value="{{ $subject->id }}" />
                                    <label for="category_{{ $subject->id }}">
                                        <img class="pr-2" width='28px'
                                            src="{{ asset('storage/' . $subject->icon) }}" alt="">
                                        {{ $subject->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salvar Seleção</button>
                </div>
            </div>
        </div>
    </div>

    <style>
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

        #open-list-cat {
            position: relative;
        }

        #open-list-cat.state-list-open::after {
            content: 'CLOSE';
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            background-color: #e13737;
            border: 1px solid #e32626;
            animation: showClose .3s;
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

        function resetImage() {
            var output = document.getElementById('avatar-preview');
            var deleteButton = document.getElementById('delete-image');
            var fileInput = document.getElementById('photo');

            output.src = "{{ asset('assets/images/logo/user-default.png') }}"; // Reset image
            deleteButton.hidden = true;
            fileInput.value = "";
        }

        function ArrayCat() {
            const checksCategories = document.querySelectorAll('.check-subjects');
            const subjectsCheckContainer = document.querySelector('#subjects-check');
            const selectedSubjectsInputs = document.querySelector('#selected-subjects-inputs');

            // Limpa os containers antes de reconstruir a lista
            subjectsCheckContainer.innerHTML = '';
            selectedSubjectsInputs.innerHTML = '';

            checksCategories.forEach(element => {
                if (element.checked) {
                    let name = element.getAttribute('data-handle-name');
                    let id = element.value; // Valor do ID da matéria

                    // Adicionar a matéria selecionada ao container visual
                    let divCategory = document.createElement('div');
                    divCategory.classList.add('col-lg-3', 'mb-2');
                    divCategory.setAttribute('data-ref-id', id);
                    divCategory.innerHTML = `
                    <div class="box-show-cat-select p-2 border rounded">
                        <p>${name}</p>
                        <button type="button" class="btn btn-danger btn-sm" data-handle-rm-check="${id}">
                            Remover
                        </button>
                    </div>
                `;
                    subjectsCheckContainer.appendChild(divCategory);

                    // Adicionar um input escondido ao formulário para enviar o ID da matéria
                    let inputHidden = document.createElement('input');
                    inputHidden.type = 'hidden';
                    inputHidden.name = `subjects[${id}][id]`;
                    inputHidden.value = id;
                    selectedSubjectsInputs.appendChild(inputHidden);

                    // Adiciona o evento de remoção
                    divCategory.querySelector('[data-handle-rm-check]').addEventListener('click', function() {
                        element.checked = false; // Desmarcar o checkbox
                        ArrayCat(); // Atualizar a lista de matérias selecionadas
                    });
                }
            });
        }

        // Adiciona o evento para atualizar a lista quando um checkbox é marcado/desmarcado
        document.querySelectorAll('.check-subjects').forEach(element => {
            element.addEventListener('change', ArrayCat);
        });

        // Chama a função para gerar a lista de matérias inicialmente, se necessário
        ArrayCat();
    </script>
</x-app-layout>

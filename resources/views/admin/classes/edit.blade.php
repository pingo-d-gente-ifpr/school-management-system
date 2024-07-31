<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Editar Turma</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <span class="material-icons breadcrumb-icon">home</span>
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('classes.index') }}">
                            Turmas
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Editar Turma</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <hr style="height: 2px; background-color: #FF6B8A; border: none;">
            </div>
            <div class="table-container bg-white rounded p-4">
                <form method="POST" enctype="multipart/form-data" action="{{ route('classes.update', $class) }}"
                    class="p-3">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-2 text-center position-relative">
                            <img id="avatar-preview"
                                src="{{ $class->photo
                                    ? (Storage::exists('public/' . $class->photo)
                                        ? Storage::url($class->photo)
                                        : asset('assets/' . $class->photo))
                                    : asset('assets/images/logo/subject-default.png') }}"
                                class="img-fluid rounded-circle mb-2" alt="Class Avatar">
                            <div class="position-absolute top-0 end-0 p-1">
                                <button type="button" class="btn btn-danger btn-sm rounded-circle"
                                    onclick="resetImage()" id="delete-image" {{ $class->photo ? '' : 'hidden' }}>
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
                                        :value="old('name', $class->name)" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="year" class="form-label">Ano</label>
                                    <x-text-input id="year" class="form-control" type="number" name="year"
                                        :value="old('year', $class->year)" required autofocus autocomplete="year" min="1900"
                                        max="2099" step="1" />
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
                                                autocomplete="off"
                                                {{ old('period', $class->period) == $period->value ? 'checked' : '' }}>
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
                                                id="{{ $stage->value }}" value="{{ $stage->value }}"
                                                autocomplete="off"
                                                {{ old('stage', $class->stage) == $stage->value ? 'checked' : '' }}>
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
                                        @foreach ($class->subjects as $subject)
                                            <div class="col-lg-3 mb-2">
                                                <div class="box-show-cat-select p-2 border rounded">
                                                    <p>{{ $subject->name }}</p>
                                                    <button type="button"
                                                        class="btn btn-success btn-sm d-flex align-items-center"
                                                        data-handle-rm-check="{{ $subject->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor"
                                                            class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                            <path
                                                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                            <path
                                                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <input type="hidden" name="subjects[{{ $subject->id }}][id]"
                                                    value="{{ $subject->id }}">
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="selected-subjects-inputs"></div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <x-primary-button class="btn btn-success w-auto mt-5">
                                {{ __('ATUALIZAR TURMA') }}
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
                                        id="category_{{ $subject->id }}" value="{{ $subject->id }}"
                                        {{ $class->subjects->contains($subject->id) ? 'checked' : '' }} />
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
                    <button id="close-list-cat" type="button" class="btn btn-primary"
                        data-bs-dismiss="modal">Salvar
                        Mudanças</button>
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
            reader.onload = function() {
                var output = document.getElementById('avatar-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function resetImage() {
            document.getElementById('avatar-preview').src = '{{ asset('assets/images/logo/subject-default.png') }}';
            document.getElementById('photo').value = '';
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
                    <div class="box-show-cat-select p-2 border rounded d-flex align-items-center justify-content-between">
    <p class="mb-0">${name}</p>
    <button type="button" class="btn btn-sm btn-delete ms-2" data-handle-rm-check="${id}">
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
        </svg>
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

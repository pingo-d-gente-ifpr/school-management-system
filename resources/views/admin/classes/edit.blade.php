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
                <ul class="nav nav-underline" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados"
                            type="button" role="tab" aria-controls="dados" aria-selected="true">Dados da
                            Turma</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="materias-tab" data-bs-toggle="tab" data-bs-target="#materias"
                            type="button" role="tab" aria-controls="materias"
                            aria-selected="false">Matérias</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="criancas-tab" data-bs-toggle="tab" data-bs-target="#criancas"
                            type="button" role="tab" aria-controls="criancas"
                            aria-selected="false">Crianças</button>
                    </li>
                </ul>

                <form method="POST" enctype="multipart/form-data" action="{{ route('classes.update', $class) }}"
                    class="p-3">
                    @csrf
                    @method('PUT')
                    <div class="tab-content" id="myTabContent">
                        <!-- Dados da Turma -->
                        <div class="tab-pane fade show active" id="dados" role="tabpanel"
                            aria-labelledby="dados-tab">
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
                                            onclick="resetImage()" id="delete-image"
                                            {{ $class->photo ? '' : 'hidden' }}>
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
                                            <x-text-input id="name" class="form-control" type="text"
                                                name="name" :value="old('name', $class->name)" required autofocus
                                                autocomplete="name" />
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="year" class="form-label">Ano</label>
                                            <x-text-input id="year" class="form-control" type="number"
                                                name="year" :value="old('year', $class->year)" required autofocus
                                                autocomplete="year" min="1900" max="2099" step="1" />
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


                                </div>



                            </div>
                        </div>

                        <!-- Matérias -->
                        <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                
                                    <button id="open-list-cat" type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#subjectsModal">
                                        Adicionar Matérias
                                    </button>

                                    <!-- Tabela para mostrar matérias selecionadas -->
                                    <div id="subjects-check" class="d-flex flex-wrap mt-3 gap-2">
                                        @foreach($class->subjects as $subject)
                                        <div class="box-show-cat-select p-2 border rounded" data-ref-id="{{ $subject->id }}-{{ $subject->pivot->user_id }}">
                                            <p><strong>Matéria:</strong> {{ $subject->name }}</p>
                                            <p><strong>Professor:</strong> {{ $subject->pivot->user->name }}</p>
                                            <button type="button" class="btn-delete" data-handle-rm-check="{{ $subject->id }}-{{ $subject->pivot->user_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                                </svg>
                                            </button>

                                        </div>
                                        @endforeach
                                    </div>
                                    <div id="selected-subjects-inputs">
                                        <!-- Inputs para enviar matérias selecionadas -->
                                        @foreach($class->subjects as $subject)
                                            <input type="hidden" name="subjects[{{ $subject->id }}][subject_id]" value="{{ $subject->id }}">
                                            <input type="hidden" name="subjects[{{ $subject->id }}][user_id]" value="{{ $subject->pivot->user_id }}">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Crianças -->
                        <div class="tab-pane fade" id="criancas" role="tabpanel" aria-labelledby="criancas-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button id="open-list-child" type="button" class="btn btn-primary mb-3"
                                        data-bs-toggle="modal" data-bs-target="#childrenModal">
                                        Adicionar Crianças
                                    </button>

                                    <!-- Div para mostrar crianças selecionadas -->
                                    <div id="children-check" class="row mt-3">
                                        <table class="table table-hover align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Nome</th>
                                                    <th scope="col">Matrícula</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="selected-children-inputs">
                                                @foreach ($class->childrens as $children)
                                                <tr data-ref-id="{{$children->id}}">
                                                    <td>
                                                        <img class="rounded-circle" width="50px" src="{{ $children->photo
                                                            ? (Storage::exists('public/' . $children->photo)
                                                                ? Storage::url($children->photo)
                                                                : asset('assets/' . $children->photo))
                                                            : asset('assets/images/logo/user-default.png') }}">
                                                    </td>
                                                    <td>{{$children->name}}</td>
                                                    <td>{{$children->register_number}}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="btn-delete" data-handle-rm-check="{{ $children->id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="white" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                                <input type="hidden" name="childrens[{{ $children->id }}][children_id]" value="{{ $children->id }}">
                                                @endforeach
                                            </tbody>
                                        </table>
                                       
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <x-primary-button class="btn btn-success w-auto mt-5">
                                {{ __('ATUALIZAR TURMA') }}
                            </x-primary-button>
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
                        <h5 class="modal-title" id="subjectsModalLabel">Matérias</h5>
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger d-none" role="alert" id="error-alert">
                                    <!-- Texto do erro será adicionado aqui dinamicamente -->
                        </div>
                        
                        <div class="list-categ">
                            <div class="row">
                                @if ($subjects->count() == 0)
                                    <h6 class="col-12 py-2">Nenhuma matéria criada, tente criar <a
                                            href="{{ route('subjects.store') }}">novas matérias</a></h6>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Matéria" name="subject_id"
                                        placeholder="Selecione a Matéria">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="Professor" name="user_id"
                                        placeholder="Selecione o Professor">
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Salvar Seleção</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="childrenModal" tabindex="-1" aria-labelledby="childrenModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="childrenModalLabel">Crianças</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo de busca -->
                        <input type="text" id="searchChildren" class="form-control mb-3" placeholder="Buscar criança...">
        
                        <!-- Tabela de crianças -->
                        <table class="table table-hover" id="childrenTable">
                            <thead class="align-middle">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Matrícula</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($childrens as $child)
                                    <tr class="child-row" data-id="{{ $child->id }}"
                                        data-register="{{ $child->register_number }}"
                                        data-name="{{ $child->name }}"
                                        data-photo="{{ $child->photo ? (Storage::exists('public/' . $child->photo) ? Storage::url($child->photo) : asset('assets/' . $child->photo)) : asset('assets/images/logo/user-default.png') }}">
                                        <td>
                                            <img class="rounded-circle" width="20px"
                                                src="{{ $child->photo ? (Storage::exists('public/' . $child->photo) ? Storage::url($child->photo) : asset('assets/' . $child->photo)) : asset('assets/images/logo/user-default.png') }}">
                                        </td>
                                        <td>{{ $child->name }}</td>
                                        <td>{{ $child->register_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
        
                        <!-- Links de paginação -->
                        <div class="d-flex justify-content-center">
                            {{ $childrens->links('components.custom-pagination') }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" id="saveChildrenSelection" data-bs-dismiss="modal">Salvar Seleção</button>
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

        </script>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const subjectsSelect = document.querySelector('select[name="subject_id"]');
                const teachersSelect = document.querySelector('select[name="user_id"]');
                const subjectsCheckContainer = document.querySelector('#subjects-check');
                const selectedSubjectsInputs = document.querySelector('#selected-subjects-inputs');
                const addSubjectButton = document.querySelector('#subjectsModal .btn-primary');
                const errorAlert = document.getElementById('error-alert');

                
                function showError(message) {
                    errorAlert.textContent = message; 
                    errorAlert.classList.remove('d-none'); 
                }

                function hideError() {
                    errorAlert.classList.add('d-none'); 
                    errorAlert.textContent = '';
                }

                const subjectsModal = document.getElementById('subjectsModal');
                subjectsModal.addEventListener('show.bs.modal', function() {
                    hideError();
                });

                function addSubject(event) {
                    hideError();

                    const subjectId = subjectsSelect.value;
                    const teacherId = teachersSelect.value;

                    if (!subjectId || !teacherId) {
                        showError('Por favor, selecione tanto a matéria quanto o professor.');
                        return;
                    }

                    const subjectName = subjectsSelect.options[subjectsSelect.selectedIndex].text;
                    const teacherName = teachersSelect.options[teachersSelect.selectedIndex].text;
                    const alreadyExists = document.querySelector(`#subjects-check [data-ref-id^="${subjectId}-"]`);

                    if (!alreadyExists) {
                        const refId = `${subjectId}-${teacherId}`; 
                        const divCategory = document.createElement('div');
                        divCategory.classList.add('box-show-cat-select', 'p-2', 'border', 'rounded');
                        divCategory.setAttribute('data-ref-id', refId); 

                        divCategory.innerHTML = `
                            <p><strong>Matéria:</strong> ${subjectName}</p>
                            <p><strong>Professor:</strong> ${teacherName}</p>
                            <button type="button" class="btn-delete" data-handle-rm-check="${refId}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                </svg>
                            </button>
                        `;
                        subjectsCheckContainer.appendChild(divCategory);

                        const subjectInputHidden = document.createElement('input');
                        subjectInputHidden.type = 'hidden';
                        subjectInputHidden.name = `subjects[${subjectId}][subject_id]`;
                        subjectInputHidden.value = subjectId;

                        const teacherInputHidden = document.createElement('input');
                        teacherInputHidden.type = 'hidden';
                        teacherInputHidden.name = `subjects[${subjectId}][user_id]`;
                        teacherInputHidden.value = teacherId;

                        selectedSubjectsInputs.appendChild(subjectInputHidden);
                        selectedSubjectsInputs.appendChild(teacherInputHidden);

                        divCategory.querySelector('.btn-delete').addEventListener('click', function() {
                            removeSubject(refId);
                        });

                        subjectsSelect.value = '';
                        teachersSelect.value = '';

                        addSubjectButton.setAttribute('data-bs-dismiss', 'modal');
                        addSubjectButton.click();
                        
                        setTimeout(() => addSubjectButton.removeAttribute('data-bs-dismiss'), 100);

                    } else {
                        showError('Essa matéria já foi adicionada.');
                    }
                }

                function removeSubject(refId) {
                    const subjectDiv = subjectsCheckContainer.querySelector(`[data-ref-id="${refId}"]`);
                    if (subjectDiv) {
                        subjectDiv.remove();
                    }

                    const subjectInput = selectedSubjectsInputs.querySelector(`input[name="subjects[${refId.split('-')[0]}][subject_id]"]`);
                    const teacherInput = selectedSubjectsInputs.querySelector(`input[name="subjects[${refId.split('-')[0]}][user_id]"]`);
                    if (subjectInput) {
                        subjectInput.remove();
                    }
                    if (teacherInput) {
                        teacherInput.remove();
                    }
                }

                addSubjectButton.addEventListener('click', addSubject);

                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const refId = this.getAttribute('data-handle-rm-check');
                        removeSubject(refId);
                    });
                });
            });

        </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectedChildrenTable = document.querySelector('#selected-children-inputs');
        const saveChildrenButton = document.querySelector('#saveChildrenSelection');
        const searchChildrenInput = document.querySelector('#searchChildren');
        const childRows = document.querySelectorAll('.child-row');

        function markSelectedChildren() {
            const selectedChildrenIds = Array.from(selectedChildrenTable.querySelectorAll('input[type="hidden"]')).map(input => input.value);
            childRows.forEach(row => {
                const childId = row.getAttribute('data-id');
                if (selectedChildrenIds.includes(childId)) {
                    row.classList.add('selected', 'table-primary');
                } else {
                    row.classList.remove('selected', 'table-primary');
                }
            });
        }

        function addChildren() {
            const selectedChildrenInputs = document.querySelector('#selected-children-inputs');
            const selectedChildrenIds = [];

            childRows.forEach(row => {
                if (row.classList.contains('selected')) {
                    const childId = row.getAttribute('data-id');
                    const childName = row.getAttribute('data-name');
                    const childPhoto = row.getAttribute('data-photo');
                    const childRegister = row.getAttribute('data-register');

                    if (!selectedChildrenInputs.querySelector(`tr[data-ref-id="${childId}"]`)) {
                        const newRow = document.createElement('tr');
                        newRow.classList.add('align-middle');
                        newRow.setAttribute('data-ref-id', childId);
                        newRow.innerHTML = `
                            <td>
                                <img class="rounded-circle" width="50px" src="${childPhoto}">
                            </td>
                            <td>${childName}</td>
                            <td>${childRegister}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn-delete" data-handle-rm-check="${childId}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        `;

                        const childInputHidden = document.createElement('input');
                        childInputHidden.type = 'hidden';
                        childInputHidden.name = `childrens[${childId}][children_id]`;
                        childInputHidden.value = childId;

                        selectedChildrenTable.appendChild(childInputHidden);
                        selectedChildrenTable.appendChild(newRow);


                        selectedChildrenIds.push(childInputHidden);
                    }
                }
            });
        }

        function removeChild(childId) {
            const rowToRemove = document.querySelector(`#selected-children-inputs tr[data-ref-id="${childId}"]`);
            if (rowToRemove) {
                rowToRemove.remove();
            } else {
                console.warn(`Linha com ID ${childId} não encontrada na tabela.`);
            }

            const inputToRemove = document.querySelector(`#selected-children-inputs input[name="childrens[${childId}][children_id]"]`);
            if (inputToRemove) {
                inputToRemove.remove();
            } else {
                console.warn(`Input escondido com ID ${childId} não encontrado.`);
            }
        }

        searchChildrenInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            childRows.forEach(row => {
                const childName = row.getAttribute('data-name').toLowerCase();
                if (childName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        childRows.forEach(row => {
            row.addEventListener('click', function () {
                row.classList.toggle('selected');
                row.classList.toggle('table-primary');
            });
        });

        saveChildrenButton.addEventListener('click', addChildren);
        document.getElementById('open-list-child').addEventListener('click', markSelectedChildren);

        document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const refId = this.getAttribute('data-handle-rm-check');
                        removeChild(refId);
                    });
        });

        markSelectedChildren();
    });
</script>




</x-app-layout>

<x-app-layout>
    <div class="col-10 col-md-10 mx-auto my-4">
        <h1>Turmas</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">
                        <span class="material-icons breadcrumb-icon">home</span>
                        Início
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Turmas</li>
            </ol>
        </nav>
        <div class="container mt-3">
            <div class="row align-items-center mb-3">
                <div class="col-lg-3 p-0 m-0">
                    <h5 style="color: #787878">Controle de Turmas</h5>
                </div>
                <div class="col-lg-9 p-0 m-0">
                    <hr style="height: 2px; background-color: #ff6b8a; border: none;">
                </div>
                <x-admin.search/>
            </div>
        </div>
        <div class="table-container bg-white rounded p-2">
            <table class="table table-hover">
                <thead>
                    <tr class="align-middle">
                        <th scope="col"></th>
                        <th scope="col">Nome</th>
                        <th scope="col">Período</th>
                        <th scope="col">Modificado em</th>
                        @if (Auth::user()->role == 'admin')
                        <th class="d-flex justify-content-end" scope="col">
                            <button type="button" class="btn btn-success btn-sm d-flex align-items-center"
                                    onclick="location.href='{{ route('classes.create') }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    <span class="ms-2">Cadastrar Turma</span>
                                </button>
                        </th>
                        @else
                        <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($classes as $class)
                        <tr class="align-middle">
                            <td>
                                <img class="rounded-circle" width="50px"
                                    src="{{ $class->photo
                                        ? (Storage::exists('public/' . $class->photo)
                                            ? Storage::url($class->photo)
                                            : asset('assets/' . $class->photo))
                                        : asset('assets/images/logo/subject-default.png') }}">
                            </td>
                            <td>{{ $class->name }}</td>
                            <td>{{  App\Enums\Period::from($class->period)->name()}}</td>
                            <td>{{ \Carbon\Carbon::parse($class->updated_at)->format('d/m/Y') }}</td>
                            <td>
                            
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('classes.show', $class->id) }}" class="btn-show">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-up-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5"/>
                                            <path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0z"/>
                                          </svg>
                                    </a>
                                @if (Auth::user()->role == 'admin')    
                                    <a href="{{ route('classes.edit', $class->id) }}" class="btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15"
                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd"
                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg>
                                    </a>

                                   
                                        @include('admin.classes.partials.delete-class-form', [
                                            'classId' => $class->id,
                                            'className' => $class->name,
                                        ])
                                @endif
                                </div>
                            
                            </td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Nenhuma classe encontrada.</td>
                        </tr>
                               
                        @endforelse
                </tbody>
            </table>
            <!-- Paginação -->
            <div class="d-flex justify-content-center">
                {{ $classes->links('components.custom-pagination') }}
            </div>
        </div>
    </div>
</x-app-layout>

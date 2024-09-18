<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Crianças</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <span class="material-icons breadcrumb-icon">home</span>
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Crianças</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <div class="row align-items-center mb-3">
                    <div class="col-lg-3 p-0 m-0">
                        <h5 style="color: #787878">Lista de Crianças</h5>
                    </div>
                    <div class="col-lg-9 p-0 m-0">
                        <hr style="height: 2px; background-color: #FF6B8A; border: none;">
                    </div>
                    <x-admin.search/>
                </div>
            </div>
            <div class="table-container bg-white rounded p-2">
                <table class="table table-hover">
                    <thead class="text-capitalize">
                        <tr class="align-middle">
                            <th scope="col"></th>
                            <th scope="col">Nome</th>
                            <th scope="col">Data de Nascimento</th>
                            <th scope="col">Matrícula</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Frequências</th>
                            <th scope="col">Notas</th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($children as $child)
                            <tr class="align-middle">
                                <td><img class="rounded-circle" width="50px"
                                        src="{{ $child->photo
                            ? (Storage::exists('public/' . $child->photo)
                                ? Storage::url($child->photo)
                                : asset('assets/' . $child->photo))
                            : asset('assets/images/logo/user-default.png') }}">
                                </td>
                                <td>{{ $child->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($child->birth_date)->format('d/m/Y') }}</td>
                                <td>{{ $child->register_number}}</td>
                                <td>{{ $child->document }}</td>
                                <td>
                                    <a href="{{ route('children.frequencies', $child->id) }}" class="btn-show">
                                        <span class="material-symbols-outlined" style="font-size:1.2rem">
                                            checklist
                                        </span>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('children.grades', $child->id) }}" class="btn-edit">
                                        <span class="material-symbols-outlined" style="font-size:1.2rem">
                                            spellcheck
                                        </span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $children->links('components.custom-pagination') }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

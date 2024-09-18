<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Frequências</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <span class="material-icons breadcrumb-icon">home</span>
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('children.index') }}">
                            Crianças
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Frequêcnias</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <div class="row align-items-center mb-3">
                    <div class="col-lg-3 p-0 m-0">
                        <h5 style="color: #787878">Relatório de Frequências</h5>
                    </div>
                    <div class="col-lg-9 p-0 m-0">
                        <hr style="height: 2px; background-color: #FF6B8A; border: none;">
                    </div>
                </div>
            </div>
            <form method="GET" action="{{ route('children.frequencies', $child->id) }}">
                    <div class="d-flex justify-content-between">
                        <div class="form-group">
                            <label for="class_id">Turma</label>
                            <select id="class_id" name="class_id" class="form-control">
                                <option value="">Selecione uma turma</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ request()->input('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="form-group">
                                <label for="start_date">Data de Início</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request()->input('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date">Data de Término</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request()->input('end_date') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
            </form>
            <div class="table-container bg-white rounded p-2 mt-2">
                

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Presença</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($frequencies as $frequency)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($frequency->date)->format('d/m/Y') }}</td>
                                <td>{{ $frequency->attendance ? 'Presente' : 'Ausente' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Paginação -->
                <div class="d-flex justify-content-center">
                    {{ $frequencies->links('components.custom-pagination') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

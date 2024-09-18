<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Notas</h1>
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
                    <li class="breadcrumb-item active" aria-current="page">Notas</li>
                </ol>
            </nav>
                        
            <hr style="height: 2px; background-color: #FF6B8A; border: none;">

            
            <div class="table-container bg-white rounded p-2 mt-2">
                <form method="GET" action="{{ route('children.grades', $child->id) }}" class="mb-4">
                    <div class="form-group d-flex align-items-end">
                        <div class="me-2">
                            <label for="class_id">Selecione a turma:</label>
                            <select name="class_id" id="class_id" class="form-control">
                                <option value="">Todas as turmas</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ $classId == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </div>
                    </div>
                </form>
                <div class="border rounded p-3">
                    <h2>Notas de {{ $child->name }}</h2>
                    <h4>Turma: {{ $class->name }}</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Matéria</th>
                                    <th>Nota 1</th>
                                    <th>Nota 2</th>
                                    <th>Nota 3</th>
                                    <th>Nota 4</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($subjects as $subject)

                                    <tr>
                                        <td>{{ $subject->classeSubject->subject->name }}</td>
                                        <td>{{ $subject->score1 }}</td>
                                        <td>{{ $subject->score2 }}</td>
                                        <td>{{ $subject->score3 }}</td>
                                        <td>{{ $subject->score4 }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Não encontrado</td>
                                    </tr>
                                    
                                @endforelse
                            
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>

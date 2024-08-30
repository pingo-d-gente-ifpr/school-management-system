<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Turma {{$class->name}}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            <span class="material-icons breadcrumb-icon">home</span>
                            Início
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">
                            Turmas
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Turma {{$class->name}}</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <hr style="height: 2px; background-color: #FF6B8A; border: none;">
                <div>
                    @if (session('msg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('msg') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="bg-white rounded p-4">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="sobre-tab" data-bs-toggle="tab" data-bs-target="#sobre" type="button" role="tab" aria-controls="sobre" aria-selected="true">Sobre</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="materias-tab" data-bs-toggle="tab" data-bs-target="#materias" type="button" role="tab" aria-controls="materias" aria-selected="false">Matérias</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="frequencias-tab" data-bs-toggle="tab" data-bs-target="#frequencias" type="button" role="tab" aria-controls="frequencias" aria-selected="false">Frequências</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="notas-tab" data-bs-toggle="tab" data-bs-target="#notas" type="button" role="tab" aria-controls="notas" aria-selected="false">Notas</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="alunos-tab" data-bs-toggle="tab" data-bs-target="#alunos" type="button" role="tab" aria-controls="alunos" aria-selected="false">Alunos</button>
                    </li>
                </ul>
                <div class="tab-content mt-4" id="myTabContent">
                    <div class="tab-pane fade show active" id="sobre" role="tabpanel" aria-labelledby="sobre-tab">
                        <div class="row">
                            <div class="col-12 col-md-4 text-center p-4">
                                <img src="{{ $class->photo
                                        ? (Storage::exists('public/' . $class->photo)
                                            ? Storage::url($class->photo)
                                            : asset('assets/' . $class->photo))
                                        : asset('assets/images/logo/subject-default.png') }}" alt="Profile Picture" class="img-fluid rounded-circle mb-3" width="150px">
                                <h2 class="user-name">Turma {{$class->name}}</h2>
                                <p><strong>Nível:</strong> {{App\Enums\Stage::from($class->stage)->name()}}</p>
                                <p><strong>Período:</strong> {{App\Enums\Period::from($class->period)->name()}}</p>
                                {{-- <p>Professor(a): Prof. Jenny</p> --}}
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <textarea class="form-control" name="description" rows="5" placeholder="Digite sua mensagem..." id="postMessage" maxlength="1000" style="border: 0 none;"></textarea>
                                                <hr>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <button class="btn me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                                                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                                                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div>
                                                    <input hidden name="classe_id" value="{{$class->id}}"></input:>
                                                    <input hidden name="user_id" value="{{Auth::user()->id}}"></input:>
                                                    <span class="text-muted" id="charCount" style="opacity: 0.8">0/1000</span>
                                                    <button type="submit" class="btn btn-success">Postar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>  
                                
                                @foreach ($class->posts as $post)
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img src="{{asset('assets/images/logo/user-default.png')}}" alt="Professor Profile Picture" class="img-fluid rounded-circle me-2" width="40px">
                                                    <div>
                                                        <h5 class="mb-0">{{$post->user->name}}</h5>
                                                        <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</small>
                                                    </div>
                                                    
                                                </div>
                                                <div>
                                                    <button class=" btn-sm btn btn-primary dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                                          </svg>
                                                    </button>
                                                      <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#"><button class="btn-sm btn">Editar</button></a></li>
                                                        <li>
                                                            <a class="dropdown-item" href="#">
                                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn-sm btn">Deletar</button>
                                                                </form>
                                                            </a>
                                                        </li>
                                                      </ul>       
                                                </div>
                                            </div>  
                                            <p class="card-text">{{$post->description}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab">
                        @include('front.classes.partials.tab-pane-subjects')
                    </div>
                    <div class="tab-pane fade" id="frequencias" role="tabpanel" aria-labelledby="frequencias-tab">
                        @include('front.classes.partials.tab-pane-attendace')
                    </div>
                    <div class="tab-pane fade" id="notas" role="tabpanel" aria-labelledby="notas-tab">
                        @include('front.classes.partials.tab-pane-grades')
                    </div>
                    <div class="tab-pane fade" id="alunos" role="tabpanel" aria-labelledby="alunos-tab">
                        @include('front.classes.partials.tab-pane-students')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<style>
    .btn-primary::after {
        display: none !important
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var triggerTabList = [].slice.call(document.querySelectorAll('#myTab button'))
    triggerTabList.forEach(function (triggerEl) {
        var tabTrigger = new bootstrap.Tab(triggerEl)

        triggerEl.addEventListener('click', function (event) {
            event.preventDefault()
            tabTrigger.show()
        })
    })

    // Char counter for post message
    const postMessage = document.getElementById('postMessage');
    const charCount = document.getElementById('charCount');

    postMessage.addEventListener('input', function () {
        const currentLength = postMessage.value.length;
        charCount.textContent = `${currentLength}/1000`;
    });
});
</script>



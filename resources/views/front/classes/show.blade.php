<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
                        <a href="{{ route('classes.index') }}">
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
                        <div id="notification" class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('msg') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card">

                                    <div class="d-flex justify-content-center" >
                                        <img id="img-preview" style="width:90%" class="rounded">
                                    </div> 
                                
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data" action="{{ route('posts.store') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <textarea class="form-control" name="description" rows="5" placeholder="Digite sua mensagem..." id="postMessage" maxlength="1000" style="border: 0 none;"></textarea>
                                                <hr>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="file-upload mt-2">
                                                    <input id="photo" type="file" name="photo" accept="image/*"/>
                                                    <label for="photo" class="btn border">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                                            <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                                            <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
                                                        </svg>
                                                    </label>
                                                    <!-- Preview thumbnail -->
                                                    
                                                </div>
                                                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                                                <div>
                                                    <input hidden name="classe_id" value="{{$class->id}}"></input>
                                                    <input hidden name="user_id" value="{{Auth::user()->id}}"></input>
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
                                                    <img src="{{ $post->user->photo ? asset('storage/' . $post->user->photo) : asset('assets/images/logo/user-default.png') }}" alt="Professor Profile Picture" class="img-fluid rounded-circle me-2" width="40px">
                                                    <div>
                                                        <h5 class="mb-0">{{$post->user->name}}</h5>
                                                        <small>{{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y') }}</small>
                                                    </div>
                                                    
                                                </div>
                                                <div>
                                                    <button class=" btn-sm btn dropdown-toggle"  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots" viewBox="0 0 16 16">
                                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3m5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3"/>
                                                          </svg>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button class="dropdown-item btn-edit-post" data-post-id="{{$post->id}}" data-description="{{$post->description}}">Editar</button>
                                                        </li>
                                                        <li>
                                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item">Deletar</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>  
                                            <p class="card-text">{{$post->description}}</p>
                                            <div class="d-flex justify-content-center" >
                                                <img src="{{ $post->photo ? asset('storage/' . $post->photo) : null }}" style="width:90%" class="rounded">
                                            </div>         
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

    @include('front.classes.partials.modal-edit-post')


<style>
    .btn-primary::after {
        display: none !important
    }
    .dropdown-toggle::after{
        display: none !important 
    }
    #notification {
        opacity: 1;
        transition: opacity 1s ease-out; /* Ajuste a duração da transição conforme necessário */
    }
    #notification.fade-out {
        opacity: 0;
    }

    .file-upload {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .file-upload input[type="file"] {
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


        const postMessage = document.getElementById('postMessage');
        const charCount = document.getElementById('charCount');

        postMessage.addEventListener('input', function () {
            const currentLength = postMessage.value.length;
            charCount.textContent = `${currentLength}/1000`;
        });
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const editPostModal = new bootstrap.Modal(document.getElementById('editPostModal'));

    
    function openEditPostModal(postId, description) {
        const form = document.getElementById('editPostForm');
        form.action = `/posts/${postId}`; 
        form.querySelector('#editDescription').value = description;
        const charCountEdit = document.getElementById('charCountEdit');
        charCountEdit.textContent = `${description.length}/1000`;
        editPostModal.show();
    }

    document.querySelectorAll('.btn-edit-post').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.dataset.postId;
            const description = this.dataset.description;
            openEditPostModal(postId, description);
        });
    });

    document.querySelector('#editDescription').addEventListener('input', function () {
        const length = this.value.length;
        const charCountEdit = document.getElementById('charCountEdit');
        charCountEdit.textContent = `${length}/1000`;
    });
});

setTimeout(function () {
        var notification = document.getElementById("notification");
        if (notification) {
            notification.classList.add('fade-out');
            setTimeout(function () {
                notification.style.display = 'none';
            }, 1000);
        }
    }, 3000);

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.querySelector('#photo');
    const imgPreview = document.querySelector('#img-preview');

    photoInput.addEventListener('change', function () {
        const file = this.files[0];
        
        if (file) {
            const reader = new FileReader();

            reader.onload = function (event) {
                imgPreview.src = event.target.result;
                imgPreview.style.display = 'block';
            }

            // Carregar a imagem selecionada
            reader.readAsDataURL(file);
        } else {
            imgPreview.style.display = 'none';
        }
    });
});

</script>

<script>
    function busca(value,targetSelector){
       $(targetSelector).show();
       $(targetSelector+':not(:contains("'+ value +'"))').hide();
   }
   

   $('#search').keyup(function () {
      busca($(this).val(), '.linhas');
   })

</script>

</x-app-layout>
<x-app-layout>
    <div class="container-fluid d-flex justify-content-center">
        <div class="col-10 col-md-10 mx-auto my-4">
            <h1>Turma Jiba Bolado</h1>
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
                    <li class="breadcrumb-item active" aria-current="page">Turma Jiba Bolado</li>
                </ol>
            </nav>
            <div class="container mt-3">
                <hr style="height: 2px; background-color: #FF6B8A; border: none;">
                <div>
                    @if (session('deletado'))
                    <div class="alert alert-success" role="alert">
                        {{ session('deletado') }}
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
                                <img src="{{asset('assets/images/subjects/3.png')}}" alt="Profile Picture" class="img-fluid rounded-circle mb-3" width="150px">
                                <h2 class="user-name">Turma Jiba Bolado</h2>
                                <p>Nível: Maternal II</p>
                                <p>Período: Vespertino</p>
                                <p>Professor(a): Prof. Jenny</p>
                                <p>A Turma Jiba Bolado do nível Maternal II da Escola Pingo de Gente é um grupo encantador e cheio de energia. Composta por crianças curiosas e entusiasmadas, essa turma transforma todas as tardes em momentos mágicos de aprendizado e diversão.</p>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="mb-3">
                                                <textarea class="form-control" rows="3" placeholder="Digite sua mensagem..." id="postMessage" maxlength="1000"></textarea>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <button type="button" class="btn btn-outline-secondary me-2"><i class="bi bi-image"></i> Imagem</button>
                                                    <button type="button" class="btn btn-outline-secondary"><i class="bi bi-paperclip"></i> Arquivo</button>
                                                </div>
                                                <span class="text-muted" id="charCount">0/1000</span>
                                                <button type="submit" class="btn btn-success">Postar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{asset('assets/images/logo/user-default.png')}}" alt="Professor Profile Picture" class="img-fluid rounded-circle me-2" width="40px">
                                            <div>
                                                <h5 class="mb-0">Prof. Jenny</h5>
                                                <small class="text-muted">20 de jun.</small>
                                            </div>
                                        </div>
                                        <h5 class="card-title">Brincadeira ao Ar Livre</h5>
                                        <p class="card-text">Prezados Pais e Responsáveis, gostaríamos de informar que a partir da próxima segunda-feira, dia 28 de julho, faremos uma pequena alteração na rotina das crianças durante o período da manhã. Com o objetivo de proporcionar um ambiente ainda mais estimulante e diversificado para nossos pequenos, introduziremos novas atividades lúdicas e educativas que ocorrerão das 9h às 10h.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="materias" role="tabpanel" aria-labelledby="materias-tab">
                        <!-- Conteúdo para Matérias -->
                    </div>
                    <div class="tab-pane fade" id="frequencias" role="tabpanel" aria-labelledby="frequencias-tab">
                        <!-- Conteúdo para Frequências -->
                    </div>
                    <div class="tab-pane fade" id="notas" role="tabpanel" aria-labelledby="notas-tab">
                        <!-- Conteúdo para Notas -->
                    </div>
                    <div class="tab-pane fade" id="alunos" role="tabpanel" aria-labelledby="alunos-tab">
                        <!-- Conteúdo para Alunos -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
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

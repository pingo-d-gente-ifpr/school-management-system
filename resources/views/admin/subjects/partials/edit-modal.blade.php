<div class="modal fade" id="exampleModal{{$subject->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Editar {{$subject?->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('subjects.update', ['subject' => $subject]) }}">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome da Matéria<b style="color:red">*</b></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subject->name) }}" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    @if (Auth::user()->role == App\Enums\Role::admin->name)
                        <div class="mb-3">
                            <label for="role" class="form-label">Professor(a) <b style="color:red">*</b></label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                @foreach ( $teachers as $teacher)
                                    <option value="{{ old('user_id', $subject->user_id) }}" value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Horário de Início</label>
                            <input name="start_date" class="form-control" placeholder="Selecione um horário" value="{{ old('start_date', \Carbon\Carbon::parse($subject->start_date)->format('H:i')) }}" id="start_date"
                                 />
                            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Horário de Término</label>
                            <input name="end_date" class="form-control" value="{{ old('end_date', \Carbon\Carbon::parse($subject->end_date)->format('H:i')) }}" placeholder="Selecione um horário" id="end_date"
                                 />
                            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row align-items-start">
                            <x-input-label for="photo" class="form-label col-sm-2 col-lg-2">Foto:</x-input-label>
                            <input class="form-control form-control-sm col-sm-10 col-lg-10" id="photo" type="file" name="photo" value="{{ old('photo', $subject->photo) }}">
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const startDateEdit = document.getElementById("start_date");
    console.log(startDateEdit)
    const startDatefpEdit = flatpickr(startDateEdit, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        minuteIncrement: 1,
        time_24hr: true,
        readOnly: false,
    });
    console.log(startDatefpEdit)
    const endDateEdit = document.getElementById("end_date");
    const endDatefpEdit = flatpickr(endDateEdit, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        minuteIncrement: 1,
        time_24hr: true,
        readOnly: false,
    });
</script>

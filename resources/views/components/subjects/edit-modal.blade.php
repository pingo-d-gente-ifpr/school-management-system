<div class="modal fade" id="exampleModal{{$subject?->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    
                        <div class="row align-items-start">
                            <x-input-label for="photo" class="form-label col-sm-2 col-lg-2">Foto:</x-input-label>
                            <input class="form-control form-control-sm col-sm-10 col-lg-10" id="photo" accept="image/*" type="file" name="photo" value="{{ old('photo', $subject->photo) }}">
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

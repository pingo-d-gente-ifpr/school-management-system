<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Criar Matéria</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="{{ route('subjects.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome da Matéria <b style="color:red">*</b></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    @if (Auth::user()->role === App\Enums\Role::admin->name)
                        <div class="mb-3">
                            <label for="role" class="form-label">Professor(a) <b style="color:red">*</b></label>
                            <select class="form-select" id="user_id" name="user_id" required>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>
                    @endif
                    <div class="mb-3">
                        <div class="row align-items-start">
                            <x-input-label for="photo" class="form-label col-sm-2 col-lg-2">Foto:</x-input-label>
                            <input class="form-control form-control-sm col-sm-10 col-lg-10" id="photo"
                                type="file" name="photo">
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const startDate = document.getElementById("start_date");
    const startDatefp = flatpickr(startDate, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        minuteIncrement: 1,
        time_24hr: true,
        readOnly: false,
    });
    const endDate = document.getElementById("end_date");
    const endDatefp = flatpickr(endDate, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        minuteIncrement: 1,
        time_24hr: true,
        readOnly: false,
    });
</script>
<div class="row d-flex justify-content-between mb-3 p-2">
    <div class="col-md-6">
        <div class="search-attendance d-flex">
            <input type="search" class="form-attendance" id="searchInput" placeholder="Procurar Aluno"
                aria-label="Procurar Aluno">
            <button class="btn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM6.5 12A5.5 5.5 0 1 1 12 6.5 5.507 5.507 0 0 1 6.5 12z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="col-md-4">
        <div class="search-attendance">
            <input type="date" class="form-attendance p-2" id="datePicker">
        </div>
    </div>
</div>

<table class="table table-striped">
    <thead class="table">
        <tr class="align-middle">
            <th>Alunos</th>
            <th id="monday">Segunda-feira</th>
            <th id="tuesday">Terça-feira</th>
            <th id="wednesday">Quarta-feira</th>
            <th id="thursday">Quinta-feira</th>
            <th id="friday">Sexta-feira</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($students as $student)
            <tr class="align-middle" data-student-id="{{ $student->id }}">
                <td><img src="{{ $student->photo
                    ? (Storage::exists('public/' . $student->photo)
                        ? Storage::url($student->photo)
                        : asset('assets/' . $student->photo))
                    : asset('assets/images/logo/user-default.png') }}"
                        alt="Foto de {{ $student->name }}" class="rounded-circle me-2" width="40"></td>
                @foreach ($weekDays as $day => $label)
                    <td>
                        <div class="dropdown">
                            <button class="btn d-flex align-items-center justify-content-center p-0 dropdown-toggle"
                                style="width: 30px; height: 30px; border-radius: 50%; background-color: rgb(81, 182, 50);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                    class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                </svg>
                            </button>
                            <div class="dropdown-content">
                                <div class="icon" data-color="#FF6E6E" data-icon="F" color="#AA2222">F</div>
                                <div class="icon" data-color="#9AE493" data-icon="P" color="#4B8B3B">P</div>
                                <div class="icon" data-color="#FFD76E" data-icon="A" color="#B08A28">A</div>
                            </div>
                        </div>
                    </td>
                @endforeach
            </tr>
        @empty
            <tr class="align-middle">
                <td colspan="6" class="text-center">Nenhum aluno matriculado nesta turma.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<style>
    .search-attendance {
        border: 0.8px solid #FF6B8A;
        border-radius: 30px;
        padding-left: 10px;
        background: #ffffff;
    }

    .form-attendance {
        background: none;
        width: 100%;
        border: 0;
    }


    .form-attendance:focus {
        border: none;
        border-color: transparent;
        outline: 0;
        box-shadow: none;
    }

    /* Style para o botão e a área do dropdown */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        border-radius: 8px;
        /* Caixa arredondada */
        padding: 5px;
        /* Espaçamento interno */
        display: flex;
        /* Alinha os ícones na horizontal */
    }

    .icon {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: bold;
        font-size: 16px;
        color: white;
    }

    .icon[data-color="#FF6E6E"] {
        background-color: #FF6E6E;
        color: #AA2222;
    }

    .icon[data-color="#9AE493"] {
        background-color: #9AE493;
        color: #4B8B3B;
    }

    .icon[data-color="#FFD76E"] {
        background-color: #FFD76E;
        color: #B08A28;
    }

    .icon:hover {
        opacity: 0.7;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

    $('.dropdown-content').hide();
    // Função para filtrar a tabela
    function filterTable() {
        const searchValue = $('#searchInput').val().toLowerCase();
        $('#studentsTableBody tr').each(function() {
            const studentName = $(this).data('name').toLowerCase();
            if (studentName.includes(searchValue)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Adicionar evento de pesquisa
    $('#searchInput').on('input', filterTable);

    // Código para dropdowns e datas corrigido
    $('.dropdown-toggle').click(function(e) {
        e.stopPropagation(); // Evitar que o clique se propague
        const dropdownContent = $(this).next('.dropdown-content');
        $('.dropdown-content').not(dropdownContent).hide(); // Fechar outros dropdowns
        dropdownContent.toggle();
    });

    $('.icon').click(function() {
        const icon = $(this);
        const color = icon.data('color');
        const selectedIcon = icon.text().trim();
        const textColor = icon.attr('color');
        const dropdown = icon.closest('.dropdown');
        const dropbtn = dropdown.find('.dropdown-toggle');
        const studentRow = dropdown.closest('tr');
        const studentId = studentRow.data('student-id');
        const day = dropdown.closest('th').attr('id');

        dropbtn.html(`<span style="font-size: 16px; font-weight: bold; color: ${textColor};">${selectedIcon}</span>`);
        dropbtn.css('background-color', color);
        dropdown.find('.dropdown-content').hide();

        // Atualizar presença no banco de dados
        $.ajax({
            url: '/update-attendance',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                student_id: studentId,
                day: day,
                status: selectedIcon
            },
            success: function(response) {
                console.log('Presença atualizada com sucesso.');
            },
            error: function(xhr) {
                console.error('Erro ao atualizar presença:', xhr);
            }
        });
    });

    $(document).click(function() {
        $('.dropdown-content').hide();
    });

    $('#datePicker').change(function() {
        const selectedDate = new Date(this.value);
        const daysOfWeek = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

        // Verificar se a data é válida
        if (isNaN(selectedDate.getTime())) return;

        // Calcular o primeiro dia da semana da data selecionada
        const startOfWeek = new Date(selectedDate);
        startOfWeek.setDate(selectedDate.getDate() - selectedDate.getDay() + 1); // Ajustar para segunda-feira

        // Atualizar os cabeçalhos das colunas
        const headers = {
            monday: startOfWeek,
            tuesday: new Date(startOfWeek).setDate(startOfWeek.getDate() + 1),
            wednesday: new Date(startOfWeek).setDate(startOfWeek.getDate() + 2),
            thursday: new Date(startOfWeek).setDate(startOfWeek.getDate() + 3),
            friday: new Date(startOfWeek).setDate(startOfWeek.getDate() + 4)
        };

        $('#monday').html(`${daysOfWeek[(new Date(headers.monday)).getDay()]} <br> ${new Date(headers.monday).getDate()}`);
        $('#tuesday').html(`${daysOfWeek[(new Date(headers.tuesday)).getDay()]} <br> ${new Date(headers.tuesday).getDate()}`);
        $('#wednesday').html(`${daysOfWeek[(new Date(headers.wednesday)).getDay()]} <br> ${new Date(headers.wednesday).getDate()}`);
        $('#thursday').html(`${daysOfWeek[(new Date(headers.thursday)).getDay()]} <br> ${new Date(headers.thursday).getDate()}`);
        $('#friday').html(`${daysOfWeek[(new Date(headers.friday)).getDay()]} <br> ${new Date(headers.friday).getDate()}`);
    });
});

</script>

<div class="row d-flex align-items-center justify-content-between mb-2 p-2">
    <div class="col-md-6">
        <div class="search-attendance d-flex">
            <input type="search"  class="form-attendance" id="search" placeholder="Procurar Aluno"
                aria-label="Procurar Aluno">
            <button class="btn" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85zM6.5 12A5.5 5.5 0 1 1 12 6.5 5.507 5.507 0 0 1 6.5 12z" />
                </svg>
            </button>
        </div>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <div class="date-picker-container">
            <form id="filterForm" method="GET" action="{{ route('classes.show', $class) }}">
                <div class="form-group position-relative">
                    <label for="datePicker">Selecione a data:</label>
                    <div class="input-group">
                        <input type="text" id="datePicker" name="selected_date" class="form-control" value="{{ request('selected_date') }}" placeholder="dd/mm/yyyy">
                        <span class="input-group-text"><i class="fa fa-calendar calendar-icon"></i></span>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                </div>
            </form>            
        </div>
        
    </div>
</div>

<table id="frequency" class="table table-striped">
    <thead class="table">
        <tr class="align-middle">
            <th><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1z"/>
              </svg>
            </th>
            <th id="monday">Segunda-feira</th>
            <th id="tuesday">Terça-feira</th>
            <th id="wednesday">Quarta-feira</th>
            <th id="thursday">Quinta-feira</th>
            <th id="friday">Sexta-feira</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($class->childrens as $student)
            <tr class="align-middle linhas" data-student-id="{{ $student->pivot->id }}">
                <td>
                    <img src="{{ $student->photo
                        ? (Storage::exists('public/' . $student->photo)
                            ? Storage::url($student->photo)
                            : asset('assets/' . $student->photo))
                        : asset('assets/images/logo/user-default.png') }}"
                        alt="Foto de {{ $student->name }}" class="rounded-circle me-2" width="40">
                    {{ $student->name }}
                </td>
                @foreach ($weekDays as $day => $label)
                    <td>
                        @php
                            $frequency = isset($studentsFrequencies[$student->id]) ? collect($studentsFrequencies[$student->id])->where('date', $day)->first() : null;
                            $attendanceStatus = $frequency ? ($frequency->attendance ? 'P' : 'F') : null;
                            $buttonColor = $attendanceStatus === 'P' ? '#9AE493' : ($attendanceStatus === 'F' ? '#FF6E6E' : '#ccc');
                            $fontColor = $attendanceStatus === 'P' ? '#4B8B3B' : ($attendanceStatus === 'F' ? '#AA2222' : '#ccc');
                        @endphp
                        <div class="dropdown">
                            <button class="btn d-flex align-items-center justify-content-center p-0 dropdown-toggle"
                                style="width: 30px; height: 30px; border-radius: 50%; background-color: {{ $buttonColor }}; color={{$fontColor}};" >
                                @if($attendanceStatus)
                                    {{ $attendanceStatus }}
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                        class="bi bi-plus-lg" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                                    </svg>
                                @endif
                            </button>
                            <div class="dropdown-content">
                                <div class="icon" data-color="#FF6E6E" data-icon="F" color="#AA2222">F</div>
                                <div class="icon" data-color="#9AE493" data-icon="P" color="#4B8B3B">P</div>
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
        padding: 5px;
        display: flex;
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

    function busca(value, targetSelector) {
        const searchValue = value.toLowerCase();

        $(targetSelector).each(function() {
            const itemText = $(this).text().toLowerCase();
            if (itemText.includes(searchValue)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
    

    $('#search').keyup(function () {
       busca($(this).val(), '.linhas');
    })


    $(document).ready(function() {

        $('.dropdown-content').hide();
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

        $('#searchInput').on('input', filterTable);

        $('.dropdown-toggle').click(function(e) {
            e.stopPropagation(); 
            const dropdownContent = $(this).next('.dropdown-content');
            $('.dropdown-content').not(dropdownContent).hide(); 
            dropdownContent.toggle();
        });

        $('.icon').click(function() {
            const icon = $(this);
            const color = icon.data('color');
            const selectedIcon = icon.text().trim();
            const selectedOption = selectedIcon == 'F' ? false : true;
            const textColor = icon.attr('color');
            const dropdown = icon.closest('.dropdown');
            const dropbtn = dropdown.find('.dropdown-toggle');
            const studentRow = dropdown.closest('tr');
            const studentId = studentRow.data('student-id');

            const tdElement = icon.closest('td');
            const columnIndex = tdElement.index();
            const table = $('#frequency');
            const thElement = table.find('thead th').eq(columnIndex);
            const dateSpan = thElement.find('span').text().trim();
            const selectedDate = $('#datePicker').val();

            if (!selectedDate) {
                alert('Por favor, selecione uma data.');
                return;
            }

            dropbtn.html(`<span style="font-size: 16px; font-weight: bold; color: ${textColor};">${selectedIcon}</span>`);
            dropbtn.css('background-color', color);
            dropdown.find('.dropdown-content').hide();

            $.ajax({
                url: '/register-frequency',
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    children_classe_id: studentId,
                    date: dateSpan,
                    attendance: selectedOption
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

        const initialDate = document.querySelector('#datePicker').value;

        flatpickr("#datePicker", {
            dateFormat: "d/m/Y",
            disable: [
                function(date) {
                    return (date.getDay() === 0 || date.getDay() === 6);
                }
            ],
            defaultDate: initialDate ? initialDate : null,
            onChange: function(selectedDates, dateStr, instance) {
                const selectedDate = selectedDates[0];
                const daysOfWeek = ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira'];

                if (!selectedDate) return;

                const dayOfWeek = selectedDate.getDay();
                const startOfWeek = new Date(selectedDate);

                if (dayOfWeek === 0) {
                    startOfWeek.setDate(selectedDate.getDate() - 6);
                } else {
                    startOfWeek.setDate(selectedDate.getDate() - (dayOfWeek - 1));
                }

                function formatDate(date) {
                    const day = date.getDate().toString().padStart(2, '0');
                    const month = (date.getMonth() + 1).toString().padStart(2, '0');
                    const year = date.getFullYear();
                    return `${day}/${month}/${year}`;
                }

                const headers = {
                    monday: startOfWeek,
                    tuesday: new Date(startOfWeek.getTime() + (1 * 24 * 60 * 60 * 1000)),
                    wednesday: new Date(startOfWeek.getTime() + (2 * 24 * 60 * 60 * 1000)),
                    thursday: new Date(startOfWeek.getTime() + (3 * 24 * 60 * 60 * 1000)),
                    friday: new Date(startOfWeek.getTime() + (4 * 24 * 60 * 60 * 1000))
                };

                $('#monday').html(`${daysOfWeek[0]} <br> <span>${formatDate(headers.monday)}</span>`);
                $('#tuesday').html(`${daysOfWeek[1]} <br> <span>${formatDate(headers.tuesday)}</span>`);
                $('#wednesday').html(`${daysOfWeek[2]} <br> <span>${formatDate(headers.wednesday)}</span>`);
                $('#thursday').html(`${daysOfWeek[3]} <br> <span>${formatDate(headers.thursday)}</span>`);
                $('#friday').html(`${daysOfWeek[4]} <br> <span>${formatDate(headers.friday)}</span>`);
            }
        })
    })

</script>

<style>


    th span {
        display: block;
        font-weight: normal;
        font-size: 0.9em;
    }

    .date-picker-container {
        position: relative;
        width: 50%;
        max-width: 350px;
    }

    .date-input {
        width: 100%;
        padding: 7px;
        font-size: 14px;
        border: 1px solid #FF6B8A;
        border-radius: 8px;
        box-shadow: none;
        transition: border-color 0.3s ease;
    }
    .calendar-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #FF6B8A; 
        pointer-events: none;
        font-size: 20px;
    }
    .date-input:focus {
        outline: none;
        border-color: #FF6B8A;
    }

    .date-input:hover {
        border-color: #FF6B8A;
    }

    @media (max-width: 768px) {
        .date-input {
            font-size: 10px;
            padding: 10px 35px 10px 10px;
        }
    }

</style>

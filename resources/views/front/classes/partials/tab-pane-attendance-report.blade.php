<div class="row d-flex justify-content-between mb-3 p-2">
    <!-- Select para Escolher Aluno -->
    <div class="col-md-6">
        <div class="search-attendance d-flex">
            <select id="selectStudent" class="form-attendance p-2">
                <option selected disabled>Selecione um Aluno</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Date Picker para Selecionar a Semana -->
    <div class="col-md-4">
        <div class="search-attendance">
            <input type="date" class="form-attendance p-2" id="datePicker">
        </div>
    </div>
</div>

<!-- Tabela com Datas nas Linhas e Presença nas Colunas -->
<table class="table table-striped">
    <thead class="table">
        <tr class="align-middle">
            <th>Data</th>
            <th>Presença</th>
        </tr>
    </thead>
    <tbody id="attendanceTableBody">
        <tr>
            <td colspan="2" class="text-center">Escolha um aluno e uma data para ver a presença.</td>
        </tr>
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

    .status-present {
        color: green;
        font-weight: bold;
    }

    .status-absent {
        color: red;
        font-weight: bold;
    }

</style>
<script>
    $(document).ready(function() {
        let selectedStudentId = null;
        let selectedDate = null;

        // Função para gerar a tabela de frequências
        function generateAttendanceTable(attendances) {
            if (!selectedStudentId || !selectedDate) return;

            const daysOfWeek = ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira'];

            // Calcular o primeiro dia da semana da data selecionada (segunda-feira)
            const startOfWeek = new Date(selectedDate);
            startOfWeek.setDate(startOfWeek.getDate() - startOfWeek.getDay() + 1); // Ajustar para segunda-feira

            let rows = '';

            for (let i = 0; i < 5; i++) {
                const currentDay = new Date(startOfWeek);
                currentDay.setDate(startOfWeek.getDate() + i);

                const dayLabel = daysOfWeek[i];
                const formattedDate = currentDay.toISOString().split('T')[0]; // yyyy-mm-dd

                const attendanceStatus = attendances[formattedDate] || 'N/A'; // Obter status ou 'N/A' se não houver registro

                let statusClass = '';
                if (attendanceStatus === 'P') {
                    statusClass = 'status-present';
                } else if (attendanceStatus === 'F') {
                    statusClass = 'status-absent';
                }

                rows += `
                    <tr>
                        <td>${dayLabel} <br> ${currentDay.getDate()}/${currentDay.getMonth() + 1}</td>
                        <td class="${statusClass}">${attendanceStatus}</td>
                    </tr>
                `;
            }

            $('#attendanceTableBody').html(rows);
        }

        // Função para buscar frequências do backend
        function fetchAttendanceData() {
            if (!selectedStudentId || !selectedDate) return;

            const startDate = new Date(selectedDate);
            const formattedStartDate = startDate.toISOString().split('T')[0]; // Formatar data como yyyy-mm-dd

            $.ajax({
                url: '/get-attendance',  // URL para buscar os dados de frequência
                type: 'GET',
                data: {
                    student_id: selectedStudentId,
                    week_start: formattedStartDate,
                },
                success: function(response) {
                    // Supondo que a resposta traga um objeto com as datas e a presença
                    generateAttendanceTable(response.attendances);
                },
                error: function(xhr) {
                    console.error('Erro ao buscar dados de frequência:', xhr);
                }
            });
        }

        // Evento de seleção de aluno
        $('#selectStudent').change(function() {
            selectedStudentId = $(this).val();
            fetchAttendanceData();
        });

        // Evento de mudança de data
        $('#datePicker').change(function() {
            selectedDate = this.value;
            fetchAttendanceData();
        });
    });

</script>
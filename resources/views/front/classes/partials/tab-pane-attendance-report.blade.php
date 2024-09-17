<div class="tab-pane" id="attendance-report">
    <h2>Relatório de Presença</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Dia</th>
                @foreach($weekDays as $date => $formattedDate)
                    <th></th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($weekDays as $date => $formattedDate)
                <tr>
                    <td>{{ $formattedDate }}</td>
                    @foreach($weekDays as $date => $formattedDate)
                        <td>
                            sdsdaas
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

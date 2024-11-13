<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Laudo de Exame</title>
    <style>
        body {
            background-color: white;
            padding: 2rem;
            font-family: Arial, sans-serif;
        }

        header {
            margin-bottom: 2rem;
            text-align: center;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        p {
            font-size: 0.875rem;
        }

        section {
            margin-bottom: 1.5rem;
        }

        h2 {
            font-size: 1.25rem;
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 0.5rem;
        }

        h3 {
            font-weight: bold;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        table {
            width: 100%;
            margin-top: 0.5rem;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0.5rem;
            border: 1px solid #000;
            text-align: left;
        }

        .bg-gray-100 {
            background-color: #f7f7f7;
        }

        .text-gray-700 {
            color: #4a4a4a;
        }

        .font-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h1>Laudo de Exame de Sangue</h1>
        <p>Número da Requisição: {{ $infos[0]['requisition_id'] }}</p>
    </header>

    <section>
        <h2>Informações do Paciente</h2>
        <div class="grid">
            <p><span class="font-bold">Nome do Paciente:</span> {{ $infos[0]['patient_name'] }}</p>
            <p><span class="font-bold">Idade:</span> {{ \Carbon\Carbon::parse($infos[0]['birth_date'])->age }} anos</p>
            <p><span class="font-bold">Convênio:</span> {{ $infos[0]['health_insurance'] }}</p>
            <p><span class="font-bold">Local da Coleta:</span> {{ $infos[0]['lab'] }}</p>
        </div>
    </section>

    <section>
        <h2>Informações do Exame</h2>
        <div class="grid">
            <p><span class="font-bold">Médico Solicitante:</span> {{ $infos[0]['doctor_name'] }}</p>
            <p><span class="font-bold">Data do Exame:</span> {{ $infos[0]['exam_date'] }}</p>
            <p><span class="font-bold">Data de Emissão do Laudo:</span> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
        </div>
    </section>

    <section>
        <h2>Resultados dos Exames</h2>
        @foreach ($infos as $info)
            @if ($info['sex'] == 'Masculino')
                @foreach ($components as $component)
                    <div>
                        <h3>{{ $component['name'] }}</h3>
                        <table>
                            <thead>
                                <tr class="bg-gray-100">
                                    <th>Resultado</th>
                                    <th>Valores de Referência</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($info['exam_name'] == $component['name'])
                                    <tr>
                                        <td>{{ $info['value'] }} {{ $component['metric'] }}</td>
                                        <td>Mínimo: {{ $component['min_male'] }} - Máximo:
                                            {{ $component['max_male'] }}
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <p class="text-gray-700"><span class="font-bold">Nota:</span></p>
                    </div>
                @endforeach
            @endif
            @if ($info['sex'] == 'Feminino')
                @foreach ($components as $component)
                    <div>
                        <h3>{{ $component['name'] }}</h3>
                        <table>
                            <thead>
                                <tr class="bg-gray-100">
                                    <th>Resultado</th>
                                    <th>Valores de Referência</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($info['exam_name'] == $component['name'])
                                    <tr>
                                        <td>{{ $info['value'] }} {{ $component['metric'] }}</td>
                                        <td>Mínimo: {{ $component['min_female'] }} - Máximo:
                                            {{ $component['max_female'] }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                @endforeach
            @endif
        @endforeach
    </section>
    @if ($conclusion != null)
        <h2>Conclusão</h2>
        <p>{{ $conclusion }}</p>
    @endif
</body>

</html>

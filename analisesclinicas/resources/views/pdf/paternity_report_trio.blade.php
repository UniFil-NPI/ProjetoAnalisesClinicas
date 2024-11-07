<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Laudo de Paternidade</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        
        .section h2 {
            font-size: 18px;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;
            border-bottom: 2px solid #eee;
            padding-bottom: 5px;
        }
        
        .exam-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin-top: 10px;
            background-color: #fafafa;
        }
        
        .exam-table th,
        .exam-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            color: #555;
        }
        
        .exam-table th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }
        
        .exam-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .exam-table tr:hover {
            background-color: #f1f1f1;
        }
        
        .label-cell {
            font-weight: bold;
            text-align: right;
            padding-right: 16px;
            background-color: #f7f7f7;
            color: #333;
        }
        
        .conclusion-section {
            margin-top: 20px;
        }

        .conclusion-section label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
            color: #444;
        }

        .conclusion-section .conclusion-box {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            white-space: pre-line;
            word-wrap: break-word;
            min-height: 100px;
        }

    </style>
</head>
<body>
    
    <div class="container">
        <div class="header">
            <h1>LAUDO DE INVESTIGAÇÃO DE VÍNCULO GENÉTICO</h1>
            <p><strong>Demandante:</strong> Ministério Público</p>
            <p><strong>Protocolo n.º</strong> 2014/1798</p>
        </div>
    
        <div class="section">
            <h2>Objetivo do Exame</h2>
            <p>
                Determinar os padrões de perfis genéticos das amostras coletadas
                para investigar a existência de vínculo genético de paternidade
                entre investigado e filho(a).
            </p>
        </div>
    
        <div class="section">
            <h2>Metodologia</h2>
            <p>
                a) DA AMPLIFICAÇÃO DO DNA: Parte do material biológico foi
                submetido ao processo de amplificação pela Reação em Cadeia da
                Polimerase (PCR), na presença de um conjunto de iniciadores
                fluorescentes. Para tal propósito, foi utilizado um
                termociclador (Veriti, LifeTechnologies), programado de acordo
                com o protocolo fornecido pelo fabricante do sistema.
            </p>
            <p>
                b) DA DETECÇÃO DOS PRODUTOS AMPLIFICADOS: Alíquotas das amostras
                amplificadas foram submetidas à corrida eletroforética capilar
                seguida de detecção da fluorescência laser-induzida no
                analisador genético automático de 8 capilares 3500
                (LifeTechnologies).
            </p>
            <p>
                c) DA ANÁLISE ESTATÍSTICA: Um indivíduo que é o pai biológico
                deve compartilhar pelo menos um alelo com a(o) filha(o) em cada
                marcador. A mensuração deste compartilhamento fornece a
                estimativa quantitativa da evidência do parentesco, com base em
                dados estatísticos obtidos da população brasileira. O parâmetro
                utilizado para expressar a estimativa da Paternidade é o Índice
                de Paternidade (IP), que representa quantas vezes é mais
                provável que o investigado seja o pai biológico quando comparado
                com outro indivíduo qualquer desta população. O Índice de
                Paternidade pode ser convertido em Probabilidade de Paternidade,
                usando-se o Teorema de Bayes.
            </p>
        </div>
    
        <div class="section">
            <h2>Resultados</h2>
            <table class="exam-table">
                <thead>
                    <tr>
                        <th>Locus</th>
                        <th colspan="2">Mãe</th>
                        <th colspan="2">Filho</th>
                        <th colspan="2">Investigado</th>
                        <th>Índice de Paternidade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loci as $locus => $row)
                        <tr>
                            <td>{{ $locus }}</td>
                            <td>{{ $row['mae_alelo1'] }}</td>
                            <td>{{ $row['mae_alelo2'] }}</td>
                            <td>{{ $row['crianca_alelo1'] }}</td>
                            <td>{{ $row['crianca_alelo2'] }}</td>
                            <td>{{ $row['pai_alelo1'] }}</td>
                            <td>{{ $row['pai_alelo2'] }}</td>
                            <td>{{ $ips[$locus] ?? '-' }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="7" class="label-cell">IP Acumulado</td>
                        <td>{{ $ipa }}</td>
                    </tr>
                    <tr>
                        <td colspan="7" class="label-cell">PP %</td>
                        <td>{{ $pp }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <div class="conclusion-section">
            <label for="conclusion"><strong>Conclusão</strong></label>
            <div class="conclusion-box">
                {{ $conclusion }}
            </div>
        </div>
    </div>
</body>
</html>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({});

const form = useForm({
    conclusion: "",
});

const generatePdf = async () => {
    try {
        await this.$inertia.post("/gerar-pdf", { conclusion: form.conclusion });
        alert("PDF gerado com sucesso!");
    } catch (error) {
        console.error("Erro ao gerar PDF:", error);
    }
};
</script>

<template>
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
                        <th>Mãe</th>
                        <th>Filho</th>
                        <th>Investigado</th>
                        <th>Índice de Paternidade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in examData" :key="index">
                        <td>{{ row.locus }}</td>
                        <td>{{ row.mother }}</td>
                        <td>{{ row.child }}</td>
                        <td>{{ row.investigated }}</td>
                        <td>{{ row.paternityIndex }}</td>
                    </tr>
                    <!-- Linha de IP Acumulado e PP% -->
                    <tr>
                        <td colspan="4" class="label-cell">IP Acumulado</td>
                        <td>{{ accumulatedIP }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="label-cell">PP %</td>
                        <td>{{ ppPercent }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="section">
            <label for="conclusion"><strong>Conclusão</strong></label>
            <textarea
                id="conclusion"
                v-model="conclusion"
                placeholder="Digite a conclusão aqui..."
            ></textarea>
        </div>

        <div class="button-container">
            <button @click="generatePdf">Gerar PDF</button>
        </div>
    </div>
</template>

<style scoped>
.container {
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h1 {
    font-size: 24px;
    font-weight: bold;
}

.section {
    margin-bottom: 20px;
}

.section h2 {
    font-size: 18px;
    font-weight: bold;
}

.exam-table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}

.exam-table th,
.exam-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

.exam-table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.exam-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.exam-table tr:hover {
    background-color: #e9e9e9;
}

.label-cell {
    font-weight: bold;
    text-align: right;
    padding-right: 16px;
    background-color: #f2f2f2;
}

textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    resize: vertical;
}

.button-container {
    text-align: center;
    margin-top: 20px;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}
</style>

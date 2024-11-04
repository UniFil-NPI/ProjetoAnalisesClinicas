<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    
});

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
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th colspan="2">Mãe</th>
                        <th colspan="2">Filho</th>
                        <th colspan="2">Investigado</th>
                        <th colspan="1">Indice de Paternidade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>D3S1358</td>
                        <td>17</td>
                        <td>15</td>
                        <td>15</td>
                        <td>2.459685751</td>
                    </tr>
                    <tr>
                        <td>D15S656</td>
                        <td>6</td>
                        <td>16</td>
                        <td>16</td>
                        <td>16.42031625</td>
                    </tr>
                    <tr>
                        <td>D2S441</td>
                        <td>12</td>
                        <td>11</td>
                        <td>10</td>
                        <td>0.919117647</td>
                    </tr>
                    <tr>
                        <td>D10S1248</td>
                        <td>11</td>
                        <td>10</td>
                        <td>10</td>
                        <td>11.38356164</td>
                    </tr>
                    <tr>
                        <td>D13S317</td>
                        <td>8</td>
                        <td>14</td>
                        <td>13</td>
                        <td>6.12755255</td>
                    </tr>
                    <tr>
                        <td>PentaE</td>
                        <td>12</td>
                        <td>9</td>
                        <td>9</td>
                        <td>8.09198892</td>
                    </tr>
                    <tr>
                        <td>D16S539</td>
                        <td>9</td>
                        <td>11</td>
                        <td>11</td>
                        <td>11.33144963</td>
                    </tr>
                    <tr>
                        <td>D18S51</td>
                        <td>11</td>
                        <td>16</td>
                        <td>14</td>
                        <td>4.606960238</td>
                    </tr>
                    <tr>
                        <td>D2S1338</td>
                        <td>22</td>
                        <td>22</td>
                        <td>22</td>
                        <td>5.740512634</td>
                    </tr>
                    <tr>
                        <td>CSF1PO</td>
                        <td>10</td>
                        <td>12</td>
                        <td>12</td>
                        <td>3.057277788</td>
                    </tr>
                    <tr>
                        <td>PentaD</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>14.99296879</td>
                    </tr>
                    <tr>
                        <td>TH01</td>
                        <td>7</td>
                        <td>9</td>
                        <td>9</td>
                        <td>10.57969377</td>
                    </tr>
                    <tr>
                        <td>vWA</td>
                        <td>15</td>
                        <td>16</td>
                        <td>17</td>
                        <td>5.430053571</td>
                    </tr>
                    <tr>
                        <td>D21S11</td>
                        <td>31</td>
                        <td>31</td>
                        <td>30</td>
                        <td>8.164508209</td>
                    </tr>
                    <tr>
                        <td>D7S820</td>
                        <td>8</td>
                        <td>8</td>
                        <td>11</td>
                        <td>4.14834481</td>
                    </tr>
                    <tr>
                        <td>D5S818</td>
                        <td>10</td>
                        <td>10</td>
                        <td>12</td>
                        <td>4.149826632</td>
                    </tr>
                    <tr>
                        <td>TPOX</td>
                        <td>8</td>
                        <td>8</td>
                        <td>11</td>
                        <td>4.215311005</td>
                    </tr>
                    <tr>
                        <td>D8S1179</td>
                        <td>13</td>
                        <td>13</td>
                        <td>14</td>
                        <td>3.99034714</td>
                    </tr>
                    <tr>
                        <td>D12S391</td>
                        <td>20</td>
                        <td>24</td>
                        <td>24</td>
                        <td>4.976077896</td>
                    </tr>
                    <tr>
                        <td>D19S433</td>
                        <td>12</td>
                        <td>14</td>
                        <td>14</td>
                        <td>6.630239145</td>
                    </tr>
                    <tr>
                        <td>FGA</td>
                        <td>23</td>
                        <td>21</td>
                        <td>22</td>
                        <td>3.312750113</td>
                    </tr>
                    <tr>
                        <td>D22S1045</td>
                        <td>15</td>
                        <td>16</td>
                        <td>16</td>
                        <td>1.322051824</td>
                    </tr>
                    <tr>
                        <td>DYS391</td>
                        <td></td>
                        <td>11</td>
                        <td>11</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Amelogenina</td>
                        <td>X</td>
                        <td>X</td>
                        <td>X</td>
                        <td></td>
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

table {
    width: 100%;
    border-collapse: collapse;
}
th,
td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
}
th {
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

CURSO DE BACHARELADO EM ENGENHARIA DE SOFTWARE\
GUILHERME RAFAEL FARACO VIEIRA\
PROJETO DE ANÁLISES CLÍNICAS\
Londrina\
2024
===

## SUMÁRIO

1. [INTRODUÇÃO](#introdução)

    1. [PROPOSTA E OBJETIVOS](#proposta-e-objetivos)

    2. [JUSTIFICATIVA](#justificativa)

2. [DIAGRAMA DE CASO DE USO](#diagrama-de-caso-de-uso)

3. [TELAS](#telas)

4. [WORKFLOW (AS IS) NA NOTAÇÃO BPMN](#workflow-as-is-na-notação-bpmn)

5. [RECURSOS E AMBIENTE DE DESENOVOLVIMENTO](#recursos-e-ambiente-de-desenovolvimento)

    1. [LINGUAGEM DE PROGRAMAÇÃO](#linguagem-de-programação)

       1. [FRONT-END](#front-end)

       2. [BACK-END](#back-end)

       3. [BANCO DE DADOS](#banco-de-dados)

    2. [DIAGRAMAÇÃO](#diagramação)

    3. [PROTOTIPAÇÃO](#prototipação)

6. [CRONOGRAMA](#cronograma)

7. [REFERÊNCIAS](#referências)

## INTRODUÇÃO

Este sistema será desenvolvido por Guilherme Rafael Faraco Vieira aluno do curso de bacharelado em Engenharia de Software e participante do Núcleo de Práticas em Informática(NPI).

O NPI é um grupo que pertence a UniFil, onde os alunos aprendem utilizando a prática, criado com o título de Empresa Júnior, com intuito de efetivar os conhecimentos do curso desenvolvendo projetos para a instituição, que contribuem imensamente com o aprendizado dos participantes. Vale ressaltar que os projetos no NPI são sem fins lucrativos, apenas para apredizado.

### PROPOSTA E OBJETIVOS

O objetivo deste projeto é prover uma aplicação *Web* que funcionará como um sistema de laboratório 24 horas por dia e todos os dias da semana com uma tela inicial explicando sobre o funcionamento da clínica e sobre os exames feitos.

- A aplicação deverá conter o gerenciamento dos usuários.

- Uma forma de colher as informações geradas pelo Analisador Hematológico que é responsável por fazer as análises do sangue.

- Um local para que o responsável pela realização do teste de paternidade possa inserir os dados gerados pela análise da amostras biológicas da mãe, filho e suposto pai.

- No exame de sangue o sistema será responsável por gerar um laudo selecionando os dados colhidos do Analisador Hematológico com base no tipo de exame pedido pelo médico do paciente. Os laudos possuirão um padrão a ser seguido.

- No teste de paternidade, será primeiramente selecionado o tipo de teste, podendo ser em trio(mãe, requerente - filho(a), suposto pai investigado) ou duo(requerente - filho(a), após a seleção do tipo de teste de paternidade, serão colhidos as amostras biológicas e então o responsável pelo teste de paternidade irá inserir os dados necessários para realização do teste, esse exame é realizado por meio de algumas fórmulas matemáticas que serão executadas pelo próprio sistema.

- Um local onde os usuários tenham acesso aos laudos, contendo um filtro para que fique mais simples de buscar o exame desejado e opção de *download* do laudo selecionado.

### JUSTIFICATIVA

O sistema proposto ao laboratório da UniFil é uma aplicação *Web* onde conterá informações relevantes para que os pacientes entendam sobre os exames e como funciona a clínica no geral. Dentro dessa aplicação serão gerados de forma automatizada os laudos dos exames de sangue e dos testes de paternidade, também possibilitará os funcionários manterem um controle dos usuários e laudos de forma fácil.

O laboratório de análises clínicas está em fase inicial, os exames ainda não estão sendo feitos em quaisquer pacientes, apenas em alguns selecionados para fim de estudos, sendo assim o laboratório necessita do Sistema de Análises Clínicas ofertado, para que não seja necessário realizar todos os processos, desde o cadastro, de forma manual.

## DIAGRAMA DE CASO DE USO

O diagrama de caso de uso tem como finalidade descrever os requisitos funcionais do sistema proposto e a relação dos usuários do sistema com relação aos requisitos colhidos.

A Figura 1 refere-se ao diagrama de caso de uso do sistema de Análises Clínicas.

Figura 1

![Diagrama de caso de uso](./img/diagramas/caso_de_uso.png)

### ATORES

#### biomedico

O biomédico é uma *role* de usuário, que está conectado aos casos de uso que um biomédico tem.

#### paciente

O paciente é uma *role* de usuário, que está conectado aos casos de uso que um paciente tem.

#### admin

O adm é uma *role* de usuário, que está conectado aos casos de uso que um admin tem.

#### recepcionista

O recepcionista é uma *role* de usuário, que está conectado aos casos de uso que um recepcionista tem.


### CASOS DE USO


#### \<\<CRUD\>\> UC001_gerenciar_usuario

O caso de uso gerenciar_usuario, permite o gerenciamento de todos as roles de usuário, onde apenas o admin tem acesso. A única excessão é a *role* paciente, que poderá ser editada pela recepcionista.

#### \<\<CRUD\>\> UC002_gerenciar_pedido_do_exame

O caso de uso UC002_gerenciar_pedido_do_exame, permite o gerenciamento dos pedidos dos exames, onde apenas o admin e o recepcionista tem acesso.

#### \<\<CRUD\>\> UC003_gerenciar_medico

O caso de uso UC003_gerenciar_medico permite o gerenciamento dos médicos cadastrados no sistema, apenas o admin e o recepcionista tem acesso ao caso de uso.

#### \<\<CRUD\>\> UC004_gerenciar_tipos_de_exame

O caso de uso UC004_gerenciar_tipos_de_exame permite o gerenciamento dos tipos de exame cadastrados no sistema, apenas o admin e o biomédico tem acesso ao caso de uso.

#### UC005_inserir_dados_teste_paternidade

O caso de uso UC005_inserir_dados_teste_paternidade permite a inserção de todas as informações necessárias para os calcúlos do teste de paternidade e somente o admin tem a permissão para realizar a inserção. 

#### UC006_importar_csv

O caso de uso UC006_importar_csv é a captura dos dados do exame de sangue que são colhidos do Analisador Hematológico.

#### UC007_gerar_laudo

O caso de uso UC007_gerar_laudo por baixo dos panos estará sendo dividido em gerar laudo do exame de sangue ou do teste de paternidade e depende dos casos de uso UC005_inserir_dados_teste_paternidade e UC006_importar_csv ocorrer.

## TELAS

As telas estão presentes e detalhadas em [telas](./telas.md)

## *WORKFLOW (AS IS)* NA NOTAÇÃO BPMN

A figura 6 refere-se ao *workflow (AS-IS)* na notação BPMN e tem como objetivo definir como é solucionado atualmente o problema que o sistema tem como objetivo resolver.

Figura 6

![WorkflowASIS](./img/diagramas/WorkflowASIS.png)

## RECURSOS E AMBIENTE DE DESENOVOLVIMENTO

### LINGUAGEM DE PROGRAMAÇÃO

#### *FRONT-END*

No *Front-end* do sistema as tecnologias utilizadas serão:

- ***HTML5***, Linguagem de Marcação de HiperTexto, responsável por definir a estrutura do conteúdo da *Web*;

- ***CSS3***, *Cascading Style Sheets*, responsável por descrever como o conteúdo será exibido na tela;

- ***JavaScript***, conhecida como linguagem de script para páginas *Web*, é uma linguagem interpretada baseada em protótipos, multiparadigma e dinâmica;

- ***[Vue.js](https://vuejs.org/)*** v3, um framework de criação de interfaces de usuário na Web;

- ***[Node.js](https://nodejs.org/en)*** v20.12.0;

- ***[npm](https://www.npmjs.com/)*** v10.5.0;

- ***[Tailwind CSS](https://tailwindcss.com/)*** v3.4.3;

- ***[PrimeVue](https://primevue.org/)*** v4.0.4

#### *BACK-END*

No *Back-end* do sistema as técnologias utilizadas serão:

- ***[Laravel 11](https://laravel.com/)***, um *framework* para construir aplicações *Web*.

- ***[InertiaJS](https://inertiajs.com/)***, permite o usuário criar inteiramente um *single-page app* cliente-servidor renderizado sem precisar de uma API.

#### BANCO DE DADOS

Será utilizado o sistema de gerenciamento de banco de dados ***[PostgreSQL](https://www.postgresql.org/)*** v16.

### DIAGRAMAÇÃO

Para realizar os diagramas foi utilizado as seguintes ferramentas:

- ***[draw.io](https://www.drawio.com/)***

- ***[HEFLO](https://www.heflo.com/pt-br/)***

- ***[Mermaid](https://mermaid.js.org/)***

### PROTOTIPAÇÃO

Para a prototipação do projeto foi utilizado uma ferramenta *Web* chamada ***[Figma](https://www.figma.com)***.

## CRONOGRAMA

A Figura 7 refere-se ao cronograma do projeto, que é uma ferramenta para organização, onde é colocado prazo para realizar cada tarefa do projeto.

Figura 7

![Cronograma](./img/Cronograma-de-projeto-Cronograma-de-projeto.png)

## REFERÊNCIAS

RIBEIRO, L. Diagramas de Caso de Uso: O que é UML ? Disponível em: <https://www.devmedia.com.br/o-que-e-uml-e-diagramas-de-caso-de-uso-introducao-pratica-a-uml/23408>. Acesso em: 3 abr. 2024.

JavaScript. Disponível em: <https://developer.mozilla.org/pt-BR/docs/Web/JavaScript>. Acesso em: 6 abr. 2024.

---

[Voltar](README.md)

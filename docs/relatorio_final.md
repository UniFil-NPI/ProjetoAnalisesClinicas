CURSO DE BACHARELADO EM ENGENHARIA DE SOFTWARE\
GUILHERME RAFAEL FARACO VIEIRA\
Mário Henrique Akihiko da Costa Adaniya\
PROJETO DE ANÁLISES CLÍNICAS\
Londrina\
2024
===

## SUMÁRIO

1. [AGRADECIMENTOS](#agradecimentos)
   
2. [INTRODUÇÃO](#introdução)
   
3. [DESCRIÇÃO DO SISTEMA](#descrição-do-sistema)
   
4. [MODELAGEM DO SISTEMA](#modelagem-do-sistema)
   
  1. [DIAGRAMA DE CASO DE USO](#diagrama-de-caso-de-uso)
   
  2. [DIAGRAMA DE CLASSE](#diagrama-de-classe)
   
  3. [DIAGRAMA DE ENTIDADE E RELACIONAMENTO](#diagrama-de-entidade-e-relacionamento)
  
  4. [CASOS DE USO](#casos-de-uso)
     
     1. [UC001_GERENCIAR_USUARIO](#uc001_gerenciar_usuario)
     
     2. [UC002_GERENCIAR_PEDIDO_DO_EXAME](#uc002_gerenciar_pedido_do_exame)
     
     3. [UC003_GERENCIAR_MEDICO](#uc003_gerenciar_medico)

     4. [UC004_GERENCIAR_TIPO_DE_EXAME](#uc004_gerenciar_tipo_de_exame)

     5. [UC005_GERENCIAR_LAUDO](#uc005_gerenciar_laudo)

5. [CONCLUSÕES E TRABALHOS FUTUROS](#conclusões-e-trabalhos-futuros)

6. [REFERÊNCIAS](#referências)
   
7. [APÊNDICE](#apêncice)
   
   1. [ARTEFATOS DE REQUISITOS](#artefatos-de-requisitos)
   
   2. [DIAGRAMAS](#diagramas)

## AGRADECIMENTOS

Neste momento de conclusão do meu estágio, sinto-me profundamente grato por todo o apoio e orientação que recebi ao longo dessa jornada.

Primeiramente, gostaria de expressar meu sincero agradecimento ao meu professor orientador, Mário. Sua orientação, paciência e conselhos valiosos foram fundamentais para o desenvolvimento deste trabalho e para meu crescimento pessoal e profissional. Agradeço pelo tempo dedicado e por todo o apoio durante esse ano. 

Aos meus colegas da área, meu mais sincero obrigado. Que durante os tempos difíceis estivemos em contato ajudando uns aos outros.

Por fim, agradeço a Deus por me guiar e iluminar em todos os momentos desta jornada.

## INTRODUÇÃO

Este sistema será desenvolvido por Guilherme Rafael Faraco Vieira aluno do curso de bacharelado em Engenharia de Software e participante do Núcleo de Práticas em Informática(NPI).

O NPI é um grupo que pertence a UniFil, onde os alunos aprendem utilizando a prática, criado com o título de Empresa Júnior, com intuito de efetivar os conhecimentos do curso desenvolvendo projetos para a instituição, que contribuem imensamente com o aprendizado dos participantes. Vale ressaltar que os projetos no NPI são sem fins lucrativos, apenas para apredizado.

O sistema proposto ao laboratório da UniFil é uma aplicação *Web* onde conterá informações relevantes para que os pacientes entendam sobre os exames e como funciona a clínica no geral. Dentro dessa aplicação serão gerados de forma automatizada os laudos dos exames de sangue e dos testes de paternidade, também possibilitará os usuários manterem um controle dos usuários e laudos de forma fácil.

O laboratório de análises clínicas está em fase inicial, os exames ainda não estão sendo feitos em quaisquer pacientes, apenas em alguns selecionados para fim de estudos, sendo assim o laboratório necessita do Sistema de Análises Clínicas ofertado, para que não seja necessário realizar todos os processos, desde o cadastro, de forma manual.

## DESCRIÇÃO DO SISTEMA

O objetivo deste projeto é prover uma aplicação *Web* que funcionará como um sistema de laboratório 24 horas por dia e todos os dias da semana com uma tela inicial explicando sobre o funcionamento da clínica e sobre os exames feitos.

- A aplicação deverá conter o gerenciamento dos usuários.

- Uma forma de colher as informações geradas pelo Analisador Hematológico que é responsável por fazer as análises do sangue.

- Um local para que o responsável pela realização do teste de paternidade possa inserir os dados gerados pela análise da amostras biológicas da mãe, filho e suposto pai.

- No exame de sangue o sistema será responsável por gerar um laudo selecionando os dados colhidos do Analisador Hematológico com base no tipo de exame pedido pelo médico do paciente. Os laudos possuirão um padrão a ser seguido.

- No teste de paternidade, será primeiramente selecionado o tipo de teste, podendo ser em trio(mãe, requerente - filho(a), suposto pai investigado), duo(requerente - filho(a), suposto pai investigado) e de reconstituição(podendo ser várias pessoas da família, ex: avós ou outra família), após a seleção do tipo de teste de paternidade, serão feito os cadastros de cada participante e então colhidos as amostras biológicas e então o responsável pelo teste de paternidade irá inserir os dados necessários para realização do teste, esse exame é realizado por meio de algumas fórmulas matemáticas que serão executadas pelo próprio sistema.

- Um local onde os usuários tenham acesso aos laudos, contendo um filtro para que fique mais simples de buscar o exame desejado e opções de *download* e compartilhamento do laudo selecionado.

### *FRONT-END*

No *Front-end* do sistema as tecnologias utilizadas serão:

- ***HTML5***, Linguagem de Marcação de HiperTexto, responsável por definir a estrutura do conteúdo da *Web*;

- ***CSS3***, *Cascading Style Sheets*, responsável por descrever como o conteúdo será exibido na tela;

- ***JavaScript***, conhecida como linguagem de script para páginas *Web*, é uma linguagem interpretada baseada em protótipos, multiparadigma e dinâmica;

- ***[Vue.js](https://vuejs.org/)*** v3, um framework de criação de interfaces de usuário na Web;

- ***[Node.js](https://nodejs.org/en)*** v20.12.0;

- ***[npm](https://www.npmjs.com/)*** v10.5.0;

- ***[Tailwind CSS](https://tailwindcss.com/)*** v3.4.3;

- ***[PrimeVue](https://primevue.org/)*** v4.0.4

### *BACK-END*

No *Back-end* do sistema as técnologias utilizadas serão:

- ***[Laravel 11](https://laravel.com/)***, um *framework* para construir aplicações *Web*.

- ***[InertiaJS](https://inertiajs.com/)***, permite o usuário criar inteiramente um *single-page app* cliente-servidor renderizado sem precisar de uma API.

### BANCO DE DADOS

Será utilizado o sistema de gerenciamento de banco de dados ***[PostgreSQL](https://www.postgresql.org/)*** v16.

### DIAGRAMAÇÃO

Para realizar os diagramas foi utilizado as seguintes ferramentas:

- ***[draw.io](https://www.drawio.com/)***

- ***[HEFLO](https://www.heflo.com/pt-br/)***

- ***[Mermaid](https://mermaid.js.org/)***

### PROTOTIPAÇÃO

Para a prototipação do projeto foi utilizado uma ferramenta *Web* chamada ***[Figma](https://www.figma.com)***.

## MODELAGEM DO SISTEMA

### DIAGRAMA DE CASO DE USO

O diagrama de caso de uso tem como finalidade descrever os requisitos funcionais do sistema proposto e a relação dos usuários do sistema com relação aos requisitos colhidos.

A Figura 1 refere-se ao diagrama de caso de uso do sistema de Análises Clínicas.

Figura 1

![Diagrama de caso de uso](./img/diagramas/caso_de_uso.png)

### DIAGRAMA DE CLASSE

O diagrama de classes é uma ferramenta essencial na modelagem orientada a objetos, proporcionando uma visão detalhada e estruturada do sistema que é crucial para o desenvolvimento de software eficiente e bem-organizado.

[Diagrama de Classes](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagrama_de_classes.md)


### DIAGRAMA DE ENTIDADE E RELACIONAMENTO

O diagrama ER é uma ferramenta crucial na modelagem de dados, permitindo que você visualize e organize as informações de forma estruturada e lógica, o que é essencial para o design e implementação eficaz de sistemas de banco de dados.

[Diagrama de Entidade e Relacionamento](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/DER.md)

### CASOS DE USO

#### UC001_GERENCIAR_USUARIO

O caso de uso UC001_gerenciar_usuario, permite o gerenciamento de todos as roles de usuário, onde apenas o admin tem acesso, A única excessão é a *role* paciente, que poderá ser editada pela recepcionista.

##### Telas

###### Funcionários

**Index**

A Figura 2 é responsável por exibir os funcionários cadastrados.

Figura 2

![Exibir](./img/telas/funcionarios/index.png)

**Edit**

A Figura 3 é responsável por editar os dados dos funcionários cadastrados.

Figura 3

![Editar](./img/telas/funcionarios/edit.png)

**Create**

A Figura 4 é responsável por criar novos cadastros de funcionário.

Figura 4

![Cadastrar](./img/telas/funcionarios/create.png)

###### Pacientes

**Index**

A Figura 5 é responsável por exibir os pacientes cadastrados.

Figura 5

![Exibir](./img/telas/pacientes/index.png)

**Edit**

A Figura 6 é responsável por editar os dados dos pacientes cadastrados.

Figura 6

![Editar](./img/telas/pacientes/edit.png)

**Create**

A Figura 7 é responsável por criar novos cadastros de paciente.

Figura 7

![Cadastrar](./img/telas/pacientes/create.png)

##### Diagrama de sequência

[UC001_GERENCIAR_USUARIO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC001_gerenciar_usuario.md)

#### UC002_GERENCIAR_PEDIDO_DO_EXAME

O caso de uso UC002_gerenciar_pedido_do_exame internamente se divide em pedidos de paternidade e pedidos de exame de sangue e permite o gerenciamento dos pedidos dos exames.


Apenas o admin tem acesso aos pedidos de paternidade e o admin e recepcionista tem acesso aos pedidos de exames de sangue.


No caso dos pacientes, eles podem apenas visualizar os pedidos de exames que estão ligados à eles.

##### Telas

###### Exames de sangue

**Index**

A Figura 8 é onde é exibido os pedidos dos exames de sangue.

Figura 8

![Exibir pedidos](./img/telas/exames_de_sangue/index.png)

**Edit**

A Figura 9 é responsável pela edição do pedido.

Figura 9

![Editar pedido](./img/telas/exames_de_sangue/edit.png)

**Create**

A Figura 10 é responsável pela criação do pedido.

Figura 10

![Cadastrar pedido](./img/telas/exames_de_sangue/create.png)


## Exames de paternidade

### Index

A Figura 11 é responsável por exibir os pedidos dos exames de paternidade.

Figura 11

![Exibir](./img/telas/exames_de_paternidade/index.png)

### Edit

A Figura 12 é responsável por editar os pedidos.

Figura 13

![Editar](./img/telas/exames_de_paternidade/edit.png)

### Select

A Figura 14 é responsável por selecionar o tipo de teste de paternidade que deseja criar o pedido.

Figura 14

![Selecionar o tipo de teste](./img/telas/exames_de_paternidade/select.png)

### Create

As Figuras 15 e 16 são responsáveis por criar os exames de duo e trio.

Figura 15

![Criar pedido duo](./img/telas/exames_de_paternidade/create_duo.png)

Figura 16

![Criar pedido trio](./img/telas/exames_de_paternidade/create_trio.png)

##### Diagrama de sequência

[UC002_GERENCIAR_PEDIDO_DO_EXAME](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC002_gerenciar_pedido_do_exame.md)

#### UC003_GERENCIAR_MEDICO

O caso de uso UC003_gerenciar_medico permite o gerenciamento dos médicos no sistema, apenas o admin e o recepcionista tem acesso ao caso de uso.

##### Telas

###### Médicos

**Index**

A Figura 17 é responsável por exibir os médicos cadastrados.

Figura 17

![Exibir](./img/telas/medicos/index.png)

**Edit**

A Figura 18 é responsável por editar os dados dos médicos cadastrados.

Figura 18

![Editar](./img/telas/medicos/edit.png)

**Create**

A Figura 19 é responsável por criar novos cadastros de médico.

Figura 19

![Cadastrar](./img/telas/medicos/create.png)

##### Diagrama de sequência

[UC003_GERENCIAR_MEDICO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC003_gerenciar_medico.md)

#### UC004_GERENCIAR_TIPO_DE_EXAME

O caso de uso UC004_gerenciar_tipo_de_exame permite o gerenciamento dos tipos de exame no sistema, as *roles* admin, biomédico e recepcionista tem acesso ao caso de uso.

##### Telas

###### Tipos de exame

**Index**

A Figura 20 é responsável por exibir os tipos de exame cadastrados.

Figura 20

![Exibir](./img/telas/tipos_de_exame/index.png)

**Edit**

A Figura 21 é responsável por editar os dados dos tipos de exame cadastrados.

Figura 21

![Editar](./img/telas/tipos_de_exame/edit.png)

**Create**

A Figura 22 é responsável por criar novos cadastros de tipos de exame.

Figura 22

![Cadastro](./img/telas/tipos_de_exame/create.png)

##### Diagrama de sequência

[UC004_GERENCIAR_TIPO_DE_EXAME](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC004_gerenciar_tipo_de_exame.md)

#### UC005_GERENCIAR_LAUDO

O caso de uso UC005_gerenciar_laudo permite o gerenciamento dos laudos dos exames de paternidade e de sangue.
Para os exames de sangue as *roles* biomédico e admin tem acesso.
Para os testes de paternidade apenas os admin tem acesso.
Os pacientes podem fazer o download dos laudos registrados nos pedidos deles.

##### Telas

###### Exames de paternidade

**Gerenciar laudos**

A Figura 23 é responsável por gerenciar os laudos do exame de paternidade.

Figura 23

![Gerenciamento de laudos](./img/telas/exames_de_paternidade/report_manage.png)

**Inserir dados do exame**

As Figuras 24, 25, 26 e 27 são responsáveis pela inserção dos dados para geração do laudo de paternidade.

Figura 24

![Criar laudo duo 1](./img/telas/exames_de_paternidade/create_report_duo1.png)

Figura 25

![Criar laudo duo 2](./img/telas/exames_de_paternidade/create_report_duo2.png)

Figura 26

![Criar laudo trio 1](./img/telas/exames_de_paternidade/create_report_trio1.png)

Figura 27

![Criar laudo trio 2](./img/telas/exames_de_paternidade/create_report_trio2.png)

###### Exames de sangue

**Gerenciar laudos**

A Figura 28 é responsável pelo gerenciamento do laudo.

Figura 28

![Gerenciamento de laudos](./img/telas/exames_de_sangue/report_manage.png)

**Importar CSV**

A Figura 29 é onde ocorre a importação do arquivo CSV.

Figura 29

![Importar CSV](./img/telas/exames_de_sangue/importar_csv.png)

**Preview PDF**

As Figuras 30 e 31 mostram o preview do PDF.

Figura 30

![Preview1](./img/telas/exames_de_sangue/preview1.png)

Figura 31

![Preview2](./img/telas/exames_de_sangue/preview2.png)

##### Diagrama de sequência

[UC005_GERENCIAR_LAUDO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC005_gerenciar_laudo.md)

## CONCLUSÕES E TRABALHOS FUTUROS

O estágio supervisionado teve como objetivo principal o desenvolvimento de um sistema de gerenciamento para uma clínica de biomedicina dentro da própria faculdade. Com base nos objetivos propostos, conseguimos atender às demandas e expectativas estabelecidas na introdução deste relatório.

Durante o estágio, o principal objetivo foi coletar e analisar os requisitos para o sistema, elaborar todos os documentos necessários e, finalmente, desenvolver o sistema utilizando as tecnologias especificadas: Laravel para o backend, Vue.js para o frontend, e Docker para a configuração e gerenciamento do banco de dados na máquina local. A utilização do GitHub foi essencial para a gestão de versionamento durante o desenvolvimento.

O aprendizado obtido com este trabalho foi considerável. A experiência prática com Laravel e Vue.js permitiu um aprofundamento significativo nas tecnologias de desenvolvimento web modernas, além de fornecer uma visão prática sobre como integrar frontend e backend de forma eficiente utilizando Inertia. O uso do Docker aprimorou minha compreensão sobre ambientes de desenvolvimento e testes, facilitando a configuração e o isolamento do banco de dados. Além disso, o trabalho com GitHub reforçou a importância do controle de versão e da colaboração em projetos de desenvolvimento de software.

A contribuição real deste projeto vai além do simples desenvolvimento do sistema. Ele proporcionou uma solução prática e personalizada para as necessidades de gerenciamento da clínica de biomedicina, melhorando a eficiência dos processos internos e a organização dos dados. A aplicação das tecnologias modernas e práticas recomendadas de desenvolvimento não só atendeu aos requisitos do projeto, mas também elevou o nível de profissionalismo e funcionalidade do sistema.

Para estudos futuros, sugiro a implementação de recursos adicionais, como integração com sistemas de agendamento e lembretes automatizados, além da inclusão de módulos de análise e relatórios mais avançados. A integração com APIs externas para otimização de processos podem também ser exploradas para aumentar ainda mais a funcionalidade e a inteligência do sistema.

Em conclusão, o estágio supervisionado foi uma oportunidade valiosa para aplicar conhecimentos teóricos em um projeto prático, obter experiência com tecnologias de ponta e contribuir com uma solução concreta para a gestão de uma clínica de biomedicina. A experiência adquirida e as contribuições realizadas foram significativas, e estou ansioso para aplicar esse conhecimento em futuros desafios profissionais.

## REFERÊNCIAS

O que é um diagrama entidade relacionamento? Disponível em: <https://www.lucidchart.com/pages/pt/o-que-e-diagrama-entidade-relacionamento>. Acesso em: 31 ago. 2024.

TYBEL, D. Diagrama de classes (UML): Orientações básicas na elaboração. Disponível em: <https://www.devmedia.com.br/orientacoes-basicas-na-elaboracao-de-um-diagrama-de-classes/37224>. Acesso em: 31 ago. 2024.

## APÊNDICE

### ARTEFATOS DE REQUISITOS

#### [Documento de Visão](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/visao.md)

#### [Especificação Suplementar](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/especificacao_suplementar.md)

#### Especificações de Caso de Uso:

- ##### [UC001_GERENCIAR_USUARIO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/especificacoes_caso_de_uso/UC001_gerenciar_usuario.md)

- ##### [UC002_GERENCIAR_PEDIDO_DO_EXAME](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/especificacoes_caso_de_uso/UC002_gerenciar_pedido_do_exame.md)

- ##### [UC003_GERENCIAR_MEDICO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/especificacoes_caso_de_uso/UC003_gerenciar_medico.md)

- ##### [UC004_GERENCIAR_TIPO_DE_EXAME](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/especificacoes_caso_de_uso/UC004_gerenciar_tipo_de_exame.md)

- ##### [UC005_GERENCIAR_LAUDO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/especificacoes_caso_de_uso/UC005_gerenciar_laudo.md)

#### [Glossário](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/glossario.md)

#### [Pedidos do Investidor](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/pedido_investidor.md)

### DIAGRAMAS

#### [Diagrama de Caso de Uso](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/caso_de_uso.md)

#### [Diagrama de Classes](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagrama_de_classes.md)

#### [Diagrama de Entidade e Relacionamento](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/DER.md)

#### Diagramas de Estado:

- ##### [UC002_gerenciar_pedido_do_exame](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_estado/UC002_gerenciar_pedido_do_exame.md)

#### [Diagrama de Implantação](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagrama_de_implantacao.md)

#### Diagramas de Sequência:

- ##### [UC001_GERENCIAR_USUARIO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC001_gerenciar_usuario.md)

- ##### [UC002_GERENCIAR_PEDIDO_DO_EXAME](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC002_gerenciar_pedido_do_exame.md)

- ##### [UC003_GERENCIAR_MEDICO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC003_gerenciar_medico.md)

- ##### [UC004_GERENCIAR_TIPO_DE_EXAME](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC004_gerenciar_tipo_de_exame.md)

- ##### [UC005_GERENCIAR_LAUDO](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/diagramas_de_sequencia/UC005_gerenciar_laudo.md)

#### [Workflow AS-IS](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/workflow_asis.md)

#### [Workflow TO-BE](https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira/blob/main/docs/workflow_to_be.md)

---

[Voltar](README.md)

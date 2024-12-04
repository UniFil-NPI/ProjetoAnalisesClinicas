# Núcleo de Práticas em Informática - NPI </br> Projeto de Análises Clinicas </br> Especificação de Caso de Uso: UC002_gerenciar_pedido_do_exame_de_sangue </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 26/08/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |

## Índice

1. [Breve Descrição](#breve-descrição)

2. [Fluxo Básico de Eventos](#fluxo-básico-de-eventos)

3. [Fluxos Alternativos](#fluxos-alternativos)

4. [Cenários Chave](#cenários-chave)

5. [Condições Prévias](#condições-prévias)

6. [Condições Posteriores](#condições-posteriores)

7. [Informações Adicionais](#informações-adicionais)

## Especificação de Caso de Uso: UC002_gerenciar_pedido_do_exame_de_sangue

Neste documento está contida as especificações dos requisitos do caso de uso estudado: UC002_gerenciar_pedido_do_exame_de_sangue.

## Breve Descrição

O UC002_gerenciar_pedido_do_exame_de_sangue engloba as funcionalidades *create*, *read* e *update* dos pedidos de exame de sangue e paternidade do sistema. Os atores que interagem com este caso de uso são os usuários que possuem alguma das *roles* à seguir: *role admin*, *role recepcionist*, *role patient*, *role biomedic*. Os pacientes somente poderão visualizar os pedidos vinculados ao seu id.

## Fluxo Básico de Eventos

### Pedidos de Exame de Sangue

#### Cadastrar pedido

1. O ator seleciona a aba **Exames**;

2. Clica no botão **Novo Pedido**;

3. Será aberto uma página para inserção dos dados: Nome ou CPF do paciente, Nome ou CRM do médico, Tipo de exame, Local de coleta, Convênio, Data do Exame e Descrição do Exame;

4. Após a inserção dos dados o ator irá apertar o botão **CRIAR PEDIDO**;

5. Acontecerá um redirecionamento para a aba **Exames**.

#### Buscar

1. O ator seleciona a aba **Exames**;

2. Dentro da caixa de busca, insere o CPF do paciente que deseja verificar os pedidos e clica no botão **Buscar**;

3. Será mostrado em uma tabela todos os pedidos do paciente.
  
#### Atualizar

1. Após encontrar o pedido desejado, haverá a possibilidade de alterar os dados do pedido, clicando no botão **Editar** localizado na última coluna da tabela;

2. Será redirecionado para a tela de edição;

3. Depois de feita a alteração, deve ser clicado o botão **SALVAR ALTERAÇÕES**;

4. Será redirecionado para a aba **Exames**.

### Pedidos de Teste de Paternidade

#### Cadastrar pedido

1. O ator seleciona a aba **Exames**;

2. Clica no botão **Novo Pedido**;

3. Será mandado para uma tela onde será possível definir se o teste de paternidade será trio ou duo.

4. Após escolher se será duo ou trio será aberto uma página para inserção dos dados: Nome ou CPF do requerente, Nome ou CPF do outro participante, Nome ou CPF do outro participante(caso seja trio), Local de coleta, Convênio, Data do Exame e Descrição do Exame;

5. Após a inserção dos dados o ator irá apertar o botão **CRIAR PEDIDO**;

6. Acontecerá um redirecionamento para a aba **Exames de Paternidade**.

#### Buscar

1. O ator seleciona a aba **Exames de Paternidade**;

2. Dentro da caixa de busca, insere o CPF do paciente que deseja verificar os pedidos e clica no botão **Buscar**;

3. Será mostrado em uma tabela todos os pedidos do paciente.
  
#### Atualizar

1. Após fazer a busca dos pedidos do paciente desejado, haverá a possibilidade de alterar os dados do pedido, clicando no botão **Editar** localizado na última coluna da tabela;

2. Será redirecionado para a tela de edição;

3. Depois de feita a alteração, deve ser clicado o botão **SALVAR ALTERAÇÕES**;

4. Será redirecionado para a aba **Exames**.

## Fluxos Alternativos

### Para ambos os tipos de pedidos

#### Cadastro de pedido
  
- **Campo necessário sem preencher:** Caso algum campo esteja em branco haverá uma notificação ao clicar enviar e não será realizada nenhuma ação.

#### Busca de Pedido

- **Busca vazia:** Caso a busca esteja vazia, será mostrado todos os pedidos cadastrados.

- **Pedido não encontrado:** Ao buscar, se não for encontrado um pedido correspondente ao CPF pesquisado, será mostrado uma mensagem avisando.

#### Atualizar pedido
  
- **Campo necessário sem preencher:** Caso algum campo esteja em branco haverá uma notificação ao clicar enviar e não será realizada nenhuma ação.

## Cenários Chave

- UC006_gerenciar_laudo

## Condições Prévias

### Condição Prévia Um

Para esse caso de uso ser possível, primeiramente deverá existir o cadastro do paciente que será ligado ao pedido.

### Condição Prévia Dois

Para esse caso de uso ser possível, primeiramente deverá existir o cadastro do médico que será ligado ao pedido.

### Condição Prévia Três

Para esse caso de uso ser possível, primeiramente deverá existir o cadastro do tipo de exame que será ligado ao pedido.

## Condições Posteriores

O status do pedido de exame será atualizado para "Analisando".

## Informações Adicionais

[Caso de uso](../caso_de_uso.md)

[Diagrama de sequência](../diagramas_de_sequencia/UC002_gerenciar_pedido_do_exame_de_sangue.md)

---

[Voltar](README.md)

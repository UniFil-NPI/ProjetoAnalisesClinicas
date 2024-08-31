# Núcleo de Práticas em Informática - NPI </br> Projeto de Análises Clinicas </br> Especificação de Caso de Uso: UC002_gerenciar_pedido_do_exame </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 26/08/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |

## Índice

1. [Breve Descrição](#breve-descrição)

2. [Fluxo Básico de Eventos](#fluxo-básico-de-eventos)

3. [Fluxos Alternativos](#fluxos-alternativos)

    1. [Cadastro de Pedido](#cadastro-de-pedido)

    2. [Busca de Pedido](#busca-de-pedido)

4. [Subfluxos](#subfluxos)

5. [Cenários Chave](#cenários-chave)

6. [Condições Prévias](#condições-prévias)

    1. [Condição Prévia Um](#condição-prévia-um)

7. [Condições Posteriores](#condições-posteriores)

8. [Pontos de Extensão](#pontos-de-extensão)

9. [Requisitos Especiais](#requisitos-especiais)

10. [Informações Adicionais](#informações-adicionais)

## Especificação de Caso de Uso: UC002_gerenciar_pedido_do_exame

Neste documento está contida as especificações dos requisitos do caso de uso estudado: UC002_gerenciar_pedido_do_exame.

## Breve Descrição

O UC002_gerenciar_pedido_do_exame engloba as funcionalidades *create*, *read* e *update*. Os atores que interagem com este caso de uso são os usuários que possuem alguma das *roles* à seguir: *role admin*, *role recepcionist*, *role patient*, *role biomedic*.

## Fluxo Básico de Eventos

- **Cadastrar pedido do exame**

  - **Para as *roles admin* e *recepcionist***

    1. O *admin* ou *recepcionist* seleciona a aba **Exames**;

    2. Clica no botão **Novo Exame**;

    3. Será aberto uma página para inserção dos dados: Nome ou CPF do paciente, Nome ou CRM do médico, Local de coleta, Convênio, Data do Exame e Descrição do Exame;

    4. Após a inserção dos dados o ator irá apertar o botão **CRIAR EXAME**;

    5. Acontecerá um redirecionamento para a aba **Exames**.

- **Buscar pedido**

  - **Para as *roles admin*, *recepcionist* e *biomedic***

    1. O ator seleciona a aba **Exames**;

    2. Dentro da caixa de busca, insere o CPF do paciente que deseja verificar os pedidos e clica no botão **Buscar**;

    3. Será mostrado em uma tabela todos os pedidos do paciente.
  
  - **Para a *role patient***

    1. O ator seleciona a aba **Exames**;

    2. Será mostrado em uma tabela todos os pedidos do paciente.

- **Atualizar informações do pedido**

  - **Para as *roles admin* e *recepcionist***

    1. Após fazer a busca dos pedidos do paciente desejado, haverá a possibilidade de alterar os dados do pedido, clicando no botão **Editar** localizado na última coluna da tabela;

    2. Será redirecionado para a tela de edição;

    3. Depois de feita a alteração, deve ser clicado o botão **SALVAR ALTERAÇÕES**;

    4. Será redirecionado para a aba **Exames**.

## Fluxos Alternativos

### **Cadastro de pedido:**
  
- **Campo necessário sem preencher:** Caso algum campo esteja em branco haverá uma notificação ao clicar enviar e não será realizada nenhuma ação.

### **Busca de Pedido:**

- **Inserção de quaisquer outros dados sem ser um CPF válido:** Quando for executada a busca não achará nenhum pedido.

## Subfluxos

Este caso de uso não possui subfluxos.

## Cenários Chave

- UC004_gerenciar_laudo

## Condições Prévias

### Condição Prévia Um

Para esse caso de uso ser possível, primeiramente deverá existir o cadastro do paciente que será ligado ao pedido.

### Condição Prévia Dois

Para esse caso de uso ser possível, primeiramente deverá existir o cadastro do médico que será ligado ao pedido.

## Condições Posteriores

Este caso de uso não possui condições posteriores.

## Pontos de Extensão

Este caso de uso não possui pontos de extensão.

## Requisitos Especiais

Este caso de uso não possui nenhum requisito especial até o momento.

## Informações Adicionais

Este caso de uso não possui informações adicionais.

---

[Voltar](README.md)

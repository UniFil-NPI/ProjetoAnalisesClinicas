# Núcleo de Práticas em Informática - NPI </br> Projeto de Análises Clinicas </br> Especificação de Caso de Uso: UC003_gerenciar_medico </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 26/08/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |

## Índice

1. [Breve Descrição](#breve-descrição)

2. [Fluxo Básico de Eventos](#fluxo-básico-de-eventos)

3. [Fluxos Alternativos](#fluxos-alternativos)

4. [Subfluxos](#subfluxos)

5. [Cenários Chave](#cenários-chave)

6. [Condições Prévias](#condições-prévias)

7. [Condições Posteriores](#condições-posteriores)

8. [Pontos de Extensão](#pontos-de-extensão)

9. [Requisitos Especiais](#requisitos-especiais)

10. [Informações Adicionais](#informações-adicionais)

## Especificação de Caso de Uso: UC003 - consultar_exames

Neste documento está contida as especificações dos requisitos do caso de uso estudado: UC003_gerenciar_medico.

## Breve Descrição

O UC002_gerenciar_pedido_do_exame engloba as funcionalidades *create*, *read* e *update*. Os atores que interagem com este caso de uso são os usuários que possuem alguma das *roles* à seguir: *role admin*, *role recepcionist*, *role patient*, *role biomedic*.

## Fluxo Básico de Eventos

- **Cadastrar médico**

  - **Para as *roles admin* e *recepcionist***

    1. O *admin* ou *recepcionist* seleciona a aba **Médicos**;

    2. Clica no botão **Novo Médico**;

    3. Será aberto uma página para inserção dos dados: Nome e CRM do médico;

    4. Após a inserção dos dados o ator irá apertar o botão **CRIAR MÉDICO**;

    5. Acontecerá um redirecionamento para a aba **Médicos**.

- **Buscar médico**

  - **Para as *roles admin* e *recepcionist***

    - **Caso não insira nenhum nome no campo de busca**

        1. O ator seleciona a aba **Médicos**;

        2. Mostrará na tabela alguns médicos cadastrados recentemente.

    - **Caso insira um nome no campo de busca**

        1. O ator seleciona a aba **Médicos**;

        2. Dentro da caixa de busca, insere o nome do médico que deseja verificar os pedidos e clica no botão **Buscar**;

        3. Será mostrado em uma tabela todos médicos com o nome buscado.
  
- **Atualizar informações do médico**

  - **Para as *roles admin* e *recepcionist***

    1. O ator seleciona a aba **Médicos**;

    2. O ator realizará a busca do médico que deseja alterar os dados;

    3. Após fazer a busca do médico desejado, haverá a possibilidade de alterar os dados do pedido, clicando no botão **Editar** localizado na última coluna da tabela;

    4. Será redirecionado para a tela de edição;

    5. Depois de feita a alteração, deve ser clicado o botão **SALVAR ALTERAÇÕES**;

    6. Será redirecionado para a aba **Médicos**.

## Fluxos Alternativos

### **Cadastro do Médico:**
  
- **Campo necessário sem preencher:** Caso algum campo esteja em branco haverá uma notificação ao clicar enviar e não será realizado nenhuma ação.

- **CRM já cadastrado:** Ao enviar, caso exista um cadastro com esse CRM será enviado uma notificação e não permitirá o cadastro.

### **Atualizar Cadastro do Médico:**

- **Tentar mudar o CRM do médico para algum já cadastrado no banco:** Se tentar alterar o CRM de um médico para algum CRM já cadastrado, não será possível salvar as alterações e aparecerá uma mensagem avisando.

## Subfluxos

Este caso de uso não possui subfluxos.

## Cenários Chave

- UC002_gerenciar_pedido_do_exame

## Condições Prévias

Este caso de uso não possui condições prévias.

## Condições Posteriores

Este caso de uso não possui condições posteriores.

## Pontos de Extensão

Este caso de uso não possui pontos de extensão.

## Requisitos Especiais

Este caso de uso não possui requisitos especiais.

## Informações Adicionais

Este caso de uso não possui informações adicionais.

---

[Voltar](README.md)

# Núcleo de Práticas em Informática - NPI </br> Projeto de Análises Clinicas </br> Especificação de Caso de Uso: UC001_gerenciar_paciente </br> Versão 1.1

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 30/04/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |
| 10/05/2024 | 1.1 | Documento preenchido | Guilherme Rafael Faraco Vieira |
| 27/08/2024 | 1.2 | Atualizações | Guilherme Rafael Faraco Vieira |

## Índice

1. [Breve Descrição](#breve-descrição)

2. [Fluxo Básico de Eventos](#fluxo-básico-de-eventos)

3. [Fluxos Alternativos](#fluxos-alternativos)

    1. [Cadastro de Usuário](#cadastro-de-usuário)

    2. [Busca de Usuário](#busca-de-usuário)

    3. [Atualizar Cadastro do Usuário](#atualizar-cadastro-do-usuário)

4. [Subfluxos](#subfluxos)

5. [Cenários Chave](#cenários-chave)

6. [Condições Prévias](#condições-prévias)

7. [Condições Posteriores](#condições-posteriores)

8. [Pontos de Extensão](#pontos-de-extensão)

9. [Requisitos Especiais](#requisitos-especiais)

    1. [Criptografia](#criptografia)

10. [Informações Adicionais](#informações-adicionais)

## Especificação de Caso de Uso: UC001 - gerenciar_usuario

Neste documento está contida as especificações dos requisitos do caso de uso estudado: UC001_gerenciar_usuario.

## Breve Descrição

O UC001_gerenciar_usuario engloba as funcionalidades *create*, *read*, *update* e *delete*. Os atores que interagem com este caso de uso são os usuários que possuem a *role admin* ou a *role receptionist*.

## Fluxo Básico de Eventos

- **Cadastrar usuário**

  - **Cadastrar novo funcionário**

    1. O *admin* ou *recepcionist* seleciona a aba *Funcionários*;

    2. Clica no botão **Novo funcionário**;

    3. Será aberto uma página para inserção dos dados: nome, email, cpf e cargo;

    4. Após a inserção dos dados o ator irá apertar o botão **CRIAR FUNCIONÁRIO**;

    5. Acontecerá um redirecionamento para a aba **Funcionários**.

    - **Cadastrar novo funcionário**

    1. O *admin* ou *recepcionist* seleciona a aba *Pacientes*;

    2. Clica no botão **Novo paciente**;

    3. Será aberto uma página para inserção dos dados: nome, email, cpf, celular, CEP, rua, número, complemento, bairro, cidade, estado, data de nascimento, convênio e sexo biológico;

    4. Após a inserção dos dados o ator irá apertar o botão **CRIAR PACIENTE**;

    5. Acontecerá um redirecionamento para a aba **Pacientes**.

- **Buscar usuário**

  - **Buscar funcionário**

    - **Caso não insira nenhum nome no campo de busca**

      1. O ator seleciona a aba **Funcionários**;

      2. Mostrará na tabela alguns funcionários cadastrados recentemente.

    - **Caso insira um nome no campo de busca**

      1. O *admin* ou *recepcionist* seleciona a aba *Funcionários*;

      2. Insere o CPF do funcionário que deseja buscar;

      3. Aperta o botão **Buscar**;

      4. Será mostrado em uma tabela os dados do funcionário.

  - **Buscar paciente**

    - **Caso não insira nenhum nome no campo de busca**

      1. O ator seleciona a aba **Pacientes**;

      2. Mostrará na tabela alguns pacientes cadastrados recentemente.

    - **Caso insira um nome no campo de busca**

      1. O *admin* ou *recepcionist* seleciona a aba *Pacientes*;

      2. Insere o CPF do paciente que deseja buscar;

      3. Aperta o botão **Buscar**;

      4. Será mostrado em uma tabela os dados do paciente.

- **Atualizar cadastro do usuário**

  - **Atualizar cadastro do funcionário**

    1. Após fazer a busca do funcionário desejado, haverá a possibilidade de alterar os dados clicando no botão **Editar** localizado na ultima coluna da tabela;

    2. Depois de feita a alteração, deve ser clicado o botão **SALVAR ALTERAÇÕES**;

    3. Será enviado de volta para a aba **Funcionários**.

  - **Atualizar cadastro do paciente**

    1. Após fazer a busca do paciente desejado, haverá a possibilidade de alterar os dados clicando no botão **Editar** localizado na ultima coluna da tabela;

    2. Depois de feita a alteração, deve ser clicado o botão **SALVAR ALTERAÇÕES**;

    3. Será enviado de volta para a aba **Pacientes**.

- **Deletar cadastro do usuário**

  - **Deletar cadastro do funcionário**

    1. Após fazer a busca do funcionário desejado, haverá a possibilidade de alterar os dados apertando no botão localizado na última coluna da tabela;

    2. Na página de edição será encontrado um botão chamado *Status* que ativará ou desativará o funcionário, esse será o *delete*;

    3. Basta apertar em **SALVAR ALTERAÇÕES** e o funcionário será ativado ou inativado.

  - **Deletar cadastro do paciente**

    1. Após fazer a busca do paciente desejado, haverá a possibilidade de alterar os dados apertando no botão localizado na última coluna da tabela;

    2. Na página de edição será encontrado um botão chamado *Status* que ativará ou desativará o paciente, esse será o *delete*;

    3. Basta apertar em **SALVAR ALTERAÇÕES** e o paciente será ativado ou inativado.

## Fluxos Alternativos

### **Cadastro de Usuário:**

- **CPF inválido:** Caso o CPF inserido não seja válido então haverá uma notificação ao clicar enviar e não será realizado nenhuma ação.
  
- **Campo necessário sem preencher:** Caso algum campo esteja em branco haverá uma notificação ao clicar enviar e não será realizado nenhuma ação.

- **Usuário já existe:** Ao enviar, caso exista um cadastro com esse CPF será enviado uma notificação e não permitirá o cadastro.

### **Busca de Usuário:**

- **Inserção de quaisquer outros dados sem ser um CPF válido:** Quando for executada a busca mostrará uma mensagem que deve ser inserido um CPF.

- **Usuário não encontrado**: Se o usuário buscado não existir, será emitido uma mensagem avisando que o paciente não foi encontrado.

### **Atualizar Cadastro do Usuário:**

- **Inserção de tipo de caracteres diferentes em campos que não esperam por esse tipo:** Se for inserido algum caractere inválido dentro de algum campo, por exemplo número no nome, será notificado ao clicar em salvar.

## Subfluxos

Este caso de uso não possui subfluxos.

## Cenários Chave

- UC001_gerenciar_usuario

- UC002_gerenciar_pedido_do_exame

- UC003_gerenciar_medicos

- UC004_gerenciar_laudo

- UC005_consultar_dados_do_aparelho

- UC006_inserir_dados_teste_paternidade

## Condições Prévias

Não existe uma condição prévia desse caso de uso.

## Condições Posteriores

Este caso de uso não exige nenhume condição posterior.

## Pontos de Extensão

Este caso de uso não possui pontos de extensão.

## Requisitos Especiais

### Criptografia

As senhas dos usuários deverão possuir uma criptografia no banco de dados para que ninguém tenha acesso a senha.

## Informações Adicionais

![gerenciar_usuario](../img/gerenciar_usuario.png)

---

[Voltar](readme.md)

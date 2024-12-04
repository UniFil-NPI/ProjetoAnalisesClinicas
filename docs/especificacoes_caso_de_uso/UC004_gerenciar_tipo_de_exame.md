# Núcleo de Práticas em Informática - NPI </br> Projeto de Análises Clinicas </br> Especificação de Caso de Uso: UC005_gerenciar_tipo_de_exame </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 09/11/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |


## Índice

1. [Breve Descrição](#breve-descrição)

2. [Fluxo Básico de Eventos](#fluxo-básico-de-eventos)

3. [Fluxos Alternativos](#fluxos-alternativos)

4. [Cenários Chave](#cenários-chave)

5. [Condições Posteriores](#condições-posteriores)

6.  [Informações Adicionais](#informações-adicionais)

## Especificação de Caso de Uso: UC005_gerenciar_tipo_de_exame

Neste documento está contida as especificações dos requisitos do caso de uso estudado: UC005_gerenciar_tipo_de_exame.

## Breve Descrição

O UC005_gerenciar_tipo_de_exame engloba as funcionalidades *create*, *read*, *update* e *delete* dos tipos de exame do sistema. Os atores que interagem com este caso de uso são os usuários que possuem a *role admin* ou a *role biomedic*.

## Fluxo Básico de Eventos

### Cadastrar novo tipo de exame

  1. O *admin* ou *biomedic* seleciona a aba **Tipos de Exame**;

  2. Clica no botão **Novo Tipo**;

  3. Será aberto uma página para inserção dos dados: nome do tipo de exame, nome do componente, min. Feminino, max. Feminino, min. Masculino, max.Masculino, Unidade de medida e caso haja necessidade pode ser adicionado(clicando no botão **ADICIONAR COMPONENTE**) ou removido(clicando no **x** no canto superior direito de cada componente) os componentes de acordo com quantos componentes o exame possuir;

  4. Após a inserção dos dados o ator irá apertar o botão **CRIAR TIPO**;

  5. Acontecerá um redirecionamento para a aba **Tipos de Exame**.

### Buscar tipo de exame

1. O usuário seleciona a aba **Tipos de Exame**;

2. Insere o nome do componente que deseja buscar;

3. Aperta o botão **Buscar**;

4. Será mostrado na tela os tipos de exame com o nome correspondente à busca.


### Atualizar cadastro do usuário

1. Após encontrar o tipo de exame desejado, haverá a possibilidade de alterar os dados clicando no botão **Editar** que se encontra na mesma linha do tipo de exame;

2. Depois de feita a alteração necessária, deve ser clicado o botão **SALVAR ALTERAÇÕES**;

3. Será enviado de volta para a aba **Tipos de Exame**.


## Fluxos Alternativos

### **Cadastro:**

- **Campos vazio:** Caso haja algum campo que é necessário preencher sem ser preenchido será mostrado na tela uma mensagem.

### **Busca:**

- **Busca vazia:** Se o campo de busca estiver vazio, será retornado todos os tipos de exame cadastrados.

- **Tipo de exame não encontrado:** Se o tipo buscado não existir, será emitido uma mensagem que não foi encontrado.

### **Atualizar:**

- **Campos vazio:** Caso haja algum campo que é necessário preencher sem ser preenchido será mostrado na tela uma mensagem.

## Cenários Chave

- UC002_gerenciar_pedido_do_exame_de_sangue

- UC005_gerenciar_tipo_de_exame

- UC006_gerenciar_laudo


## Condições Posteriores

Todos os tipos de exame ativos estão disponíveis para seleção no momento de registrar novos pedidos de exame.

## Informações Adicionais

[Caso de uso](../caso_de_uso.md)

[Diagrama de sequência](../diagramas_de_sequencia/UC005_gerenciar_tipo_de_exame.md)

---

[Voltar](README.md)

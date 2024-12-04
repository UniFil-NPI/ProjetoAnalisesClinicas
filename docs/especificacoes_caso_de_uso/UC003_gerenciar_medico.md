# Núcleo de Práticas em Informática - NPI </br> Projeto de Análises Clinicas </br> Especificação de Caso de Uso: UC004_gerenciar_medico </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 26/08/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |

## Índice

1. [Breve Descrição](#breve-descrição)

2. [Fluxo Básico de Eventos](#fluxo-básico-de-eventos)

3. [Fluxos Alternativos](#fluxos-alternativos)

4. [Cenários Chave](#cenários-chave)

5. [Informações Adicionais](#informações-adicionais)

## Especificação de Caso de Uso: UC004_gerenciar_medico

Neste documento está contida as especificações dos requisitos do caso de uso estudado: UC004_gerenciar_medico.

## Breve Descrição

O UC004_gerenciar_medico engloba as funcionalidades *create*, *read* e *update* dos médicos do sistema. Os atores que interagem com este caso de uso são os usuários que possuem alguma das *roles* à seguir: *role admin*, *role recepcionist*.

## Fluxo Básico de Eventos

### **Cadastrar médico**

1. O ator seleciona a aba **Médicos**;

2. Clica no botão **Novo Médico**;

3. Será aberto uma página para inserção dos dados: Nome e CRM do médico;

4. Após a inserção dos dados o ator irá apertar o botão **CRIAR MÉDICO**;

5. Acontecerá um redirecionamento para a aba **Médicos**.

### **Buscar médico**

1. O ator seleciona a aba **Médicos**;

2. Dentro da caixa de busca, insere o nome do médico que deseja verificar os pedidos e clica no botão **Buscar**;

3. Será mostrado em uma tabela todos médicos com o nome buscado.
  
### **Atualizar informações do médico**

 1. O ator seleciona a aba **Médicos**;

 2. O ator realizará a busca do médico que deseja alterar os dados;

 3. Após fazer a busca do médico desejado, haverá a possibilidade de alterar os dados do cadastro, clicando no botão **Editar** localizado na última coluna da tabela;

 4. Será redirecionado para a tela de edição;

 5. Depois de feita a alteração, deve ser clicado o botão **SALVAR ALTERAÇÕES**;

 6. Será redirecionado para a aba **Médicos**.

## Fluxos Alternativos

### Cadastro do Médico
  
- **Campo necessário sem preencher:** Caso algum campo esteja em branco haverá uma notificação ao clicar enviar e não será realizado nenhuma ação.

- **CRM já cadastrado:** Ao enviar, caso exista um cadastro com esse CRM será enviado uma notificação e não permitirá o cadastro.

### Busca

- **Busca vazia:** Caso a busca esteja vazia, será mostrado todos os médicos cadastrados.

- **Médico não encontrado:** Ao buscar, se não for encontrado um médico correspondente ao nome pesquisado, será mostrado uma mensagem avisando que o médico não foi encontrado.

### Atualizar Cadastro do Médico

- **Tentar mudar o CRM do médico para algum já cadastrado no banco:** Se tentar alterar o CRM de um médico para algum CRM já cadastrado, não será possível salvar as alterações e aparecerá uma mensagem avisando.

## Cenários Chave

- UC002_gerenciar_pedido_do_exame_de_sangue

## Informações Adicionais

[Caso de uso](../caso_de_uso.md)

[Diagrama de sequência](../diagramas_de_sequencia/UC004_gerenciar_medico.md)

---

[Voltar](README.md)

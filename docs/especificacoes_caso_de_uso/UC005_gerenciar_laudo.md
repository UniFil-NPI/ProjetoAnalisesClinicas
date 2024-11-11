# Núcleo de Práticas em Informática - NPI </br> Projeto de Análises Clinicas </br> Especificação de Caso de Uso: UC005_gerenciar_laudo </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 09/11/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |


## Índice

1. [Breve Descrição](#breve-descrição)

2. [Fluxo Básico de Eventos](#fluxo-básico-de-eventos)

3. [Fluxos Alternativos](#fluxos-alternativos)

4. [Cenários Chave](#cenários-chave)

5. [Condições Prévias](#condições-prévias)

6. [Condições Posteriores](#condições-posteriores)

7. [Requisitos Especiais](#requisitos-especiais)

8. [Informações Adicionais](#informações-adicionais)

## Especificação de Caso de Uso: UC005_gerenciar_laudo

Neste documento está contida as especificações dos requisitos do caso de uso estudado: UC005_gerenciar_laudo.

## Breve Descrição

O UC005_gerenciar_laudo engloba as funcionalidades *create*, *read* e *delete* dos laudos do sistema. Os atores que interagem com este caso de uso são os usuários que possuem a *role admin*, *role biomedic* ou *role patient*.
Somente o *admin* poderá gerenciar os laudos de paternidade e os pacientes poderão fazer o download do laudo de pedidos pertencentes a ele.

## Fluxo Básico de Eventos

### Gerar Laudo

#### Exame de Sangue

1. O ator seleciona a aba *Exames*;

2. Localiza o pedido que deseja gerar o laudo;

3. Seleciona o botão gerenciar laudo;

4. Seleciona o botão **GERAR LAUDO**;

5. Importa o arquivo CSV;

6. Visualiza como ficará o laudo e insere uma conclusão;

7. Retorna para a página de gerenciamento de laudo.

#### Exame de Paternidade

1. O ator seleciona a aba *Exames de Paternidade*;

2. Localiza o pedido que deseja gerar o laudo;

3. Seleciona o botão gerenciar laudo;

4. Seleciona o botão **GERAR LAUDO**;

5. Insere os dados necessários;

6. Visualiza como ficará o laudo e insere uma conclusão;

7. Retorna para a página de gerenciamento de laudo.

### Download do laudo

1. Localiza o pedido que deseja fazer o download do laudo;

2. Seleciona o botão gerenciar laudo;

3. Seleciona o botão **BAIXAR**;

4. O download será feito.

### Remover o laudo

1. Localiza o pedido que deseja fazer a remoção do laudo;

2. Seleciona o botão gerenciar laudo;

3. Seleciona o botão **REMOVER LAUDO**;

4. A remoção será feita.

## Fluxos Alternativos

### Gerar laudo

- **Gerar um laudo em um pedido que já possui um laudo:** Caso tente gerar um laudo em um pedido que já contém um laudo, será mostrada uma mensagem para remover o laudo primeiro para poder gerar outro.

### Download

- **Não existir um laudo:** Quando não existir um laudo, o download não funcionará e retornara uma mensagem avisando que não existe um laudo no pedido.

### Remover

- **Não existir um laudo para remover:** Quando não existir um laudo, não será possível remover um laudo então será mostrada uma mensagem avisando que não existe um laudo no pedido.

## Cenários Chave

- UC002_gerenciar_pedido_do_exame


## Condições Prévias

### Condição Prévia um

Deverá existir o pedido do exame que o laudo pertence para que seja possível gerenciar o laudo.

## Condições Posteriores

O status do pedido de exame foi atualizado para "Finalizado".

## Requisitos Especiais

### Permissões

Os laudos dos testes de paternidade só poderão ser acessados pelo admin ou pelo paciente que fez a requisição do teste.

Os laudos dos exames de sangue só poderão ser acessados pelo admin, biomédico ou pelo paciente que fez a requisição do exame.

## Informações Adicionais

[Caso de uso](../caso_de_uso.md)

[Diagrama de sequência](../diagramas_de_sequencia/UC005_gerenciar_laudo.md)

---

[Voltar](README.md)

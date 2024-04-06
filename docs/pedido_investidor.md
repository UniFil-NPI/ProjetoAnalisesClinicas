# Pedidos do Investidor </br> Projeto de Análises Clínicas </br> Versão 1.1

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 28/02/2024 | 1.0 | Primeira versão da entrevista | Guilherme Rafael Faraco Vieira |
| 09/03/2024 | 1.1 | Após a coleta de informações sobre os aparelhos | Guilherme Rafael Faraco Vieira |

## Índice

1. [Introdução](#introdução)

    1. [Objetivo](#objetivo)

    2. [Escopo](#escopo)

    3. [Definições, Acrônimos e Abreviações](#definições-acrônimos-e-abreviações)

    4. [Referências](#referências)

    5. [Visão Geral](#visão-geral)

2. [Estabelecer Perfil do Investidor ou do Usuário](#estabelecer-perfil-do-investidor-ou-do-usuário)

3. [Avaliando o Problema](#avaliando-o-problema)

4. [Entendendo o Ambiente do Usuário](#entendendo-o-ambiente-do-usuário)

5. [Recapitulação para Entendimento](#recapitulação-para-entendimento)

6. [Entradas do Analista no Problema do Investidor (validar ou invalidar premissas)](#entradas-do-analista-no-problema-do-investidor-validar-ou-invalidar-premissas)

7. [Avaliando Sua Solução (se aplicável)](#avaliando-sua-solução-se-aplicável)

8. [Avaliando a Oportunidade](#avaliando-a-oportunidade)

9. [Avaliando a Confiabilidade, o Desempenho e as Necessidades de Suporte](#avaliando-a-confiabilidade-o-desempenho-e-as-necessidades-de-suporte)

10. [Wrap-Up](#wrap-up)

11. [Resumo do Analista](#resumo-do-analista)

## Pedidos do Investidor

## Introdução

O pedido do investidor é um documento que contém todas as informações necessárias para fazer o sistema pedido.

### Objetivo

O objetivo é fazer uma entrevista para entender todos os requisitos que o stakeholder necessita para iniciar o desenvolvimento.

### Escopo

O sistema irá agilizar, facilitar e aumentar a produção de exames feitos, basicamente consistirá em um site onde teremos o cadastro/login de usuário e dependendo do cargo ele terá acesso a algumas informações e funções, como consultar os laudos, fazer um exame, checar os laudos dos pacientes.

### Definições, Acrônimos e Abreviações

Consultar glossário.

### Referências

**Análises Clínicas - Rede D’Or. Disponível em:**
<https://www.rededorsaoluiz.com.br/exames-e-procedimentos/analises-clinicas>  
Acesso feito em 02 de março de 2024.

**Manual do usuário - VIDA COUNT 380**  
Acesso feito em 07 de março de 2024.

**Manual do usuário VIDA S1600**  
Acesso feito em 07 de março de 2024.

**EC Series Auto Hematology Analyzer HL7 Interface User's Manual_20220122**  
Acesso feito em 07 de março de 2024.

### Visão Geral

O capítulo um visa fornecer informações iniciais sobre o projeto, uma análise geral. O segundo capítulo fornece informações sobre o investidor. O terceiro capítulo fornece uma avaliação sobre os problemas citados pelo investidor. O quarto capítulo fornece informações sobre o background dos usuários. O quinto capítulo é uma recapitulação dos requisitos passados. O sexto capítulo é uma validação de premissas dos problemas. O sétimo capítulo avalia sua solução. O oitavo capítulo avalia as oportunidades, ou seja, quem utilizará e onde será usado. O nono capítulo contém as necessidades de confiabilidade, desempenho e necessidades de suporte. O décimo capítulo contém as formas de contato e se será possível outras reuniões com o investidor. E o último capítulo é um resumo.

## Estabelecer Perfil do Investidor ou do Usuário

- **Nome:** Carolina Ariza

- **Empresa / Segmento de Mercado:** Biomedicina

- **Cargo:** Professora e Coordenadora

- **Quais são suas responsabilidades principais?** Fazer os exames, gerar os laudos e enviá-los ao paciente.

- **Como o sucesso é medido?** Pela entrega dos resultados.

- **Quais problemas interferem em seu sucesso?** Algum erro de digitação ou problemas com o aparelho do laboratório.

## Avaliando o Problema

- **Para quais problemas faltam boas soluções?**  Uma forma de receber e gerar o laudo automaticamente e também um cadastro, onde o usuário irá inserir suas informações básicas e login onde terá acesso ao laudo e terá a possibilidade de agendar seu exame.

- **Quais são elas?** Fazer um sistema web que contenha a solução para todos os problemas apresentados.

**Para cada problema, pergunte:**

- **Por que este problema existe?** Por falta de um sistema.

- **Como você o resolve agora?** Usando Word, E-mail e telefone.

- **Como você gostaria de resolvê-lo?** De maneira automatizada e simples.

## Entendendo o Ambiente do Usuário

- **Quem são os usuários?** Biomedicos e pacientes

- **Qual é seu background educacional?** Variado

- **Qual é seu background de computador?** Variado

- **Os usuários têm experiência com este tipo de aplicativo?** Variado

- **Quais plataformas estão em uso?** Word, telefone e e-mail.

- **Quais são seus planos para plataformas futuras?** Um sistema web.

- **Quais aplicativos adicionais você utiliza com os quais nós precisamos fazer interface?** Software do aparelho do laboratório.

- **Quais são suas expectativas para o tempo de treinamento?** Não se aplica.

- **De quais tipos de documentação impressa e on-line você precisa?** Manual online.

## Recapitulação para Entendimento

- **Você me disse:**

  - inserir manualmente os dados gerados pelo aparelho em um documento

  - geração de laudo manualmente
  
  - ter o contato com alguém da clínica para poder pegar os dados do paciente
  
  - o agendamento só é possível com de fazer ligando ou mandando mensagem

- **Isso representa os problemas que você está tendo com a solução existente?** Sim.

## Entradas do Analista no Problema do Investidor (validar ou invalidar premissas)

- **Quais, se houver, problemas estão associados com:**

  - ***Um local onde o usuário possa ter todos seus exames armazenados e prontos para download se necessário.***

    - **Este é um problema real?**

     Sim.

    - **Quais são os motivos para este problema?**

      Não ter um sistema web onde contém os laudos armazenados.

    - **Como você resolve o problema atualmente?**

      Atualmente estão em fase inicial, portanto não estão realizando os exames ainda.

    - **Como você gostaria de resolver o problema?**

      Criar uma página que contenha todas as informações vinculadas ao usuário.

    - **Como você classificaria a resolução desses problemas em comparação com outros mencionados?**

      Alta.

  - ***Gerar os laudos de maneira automatica.***

    - **Este é um problema real?**

      Sim.

    - **Quais são os motivos para este problema?**  

      Ter que transcrever manualmente as informações geradas pelo exame para outro documento para poder gerar os laudos.

    - **Como você resolve o problema atualmente?**

      Os dados são copiados manualmente para um documento no Word.

    - **Como você gostaria de resolver o problema?**

      Codificar um sistema para automatizar esse processo.

    - **Como você classificaria a resolução desses problemas em comparação com outros mencionados?**

      Principal.

## Avaliando Sua Solução (se aplicável)

- **E se você pudesse…**
  - agilizar o processo e facilitar a usabilidade?
  - realizar um sistema de agendamento?

- **Como você classificaria a importância deles?** média.

## Avaliando a Oportunidade

- **Quem precisa deste aplicativo em sua organização?** O laboratório de biomedicina.

- **Quantos desses tipos de usuários utilizariam o aplicativo?** Inúmeros usuários.

- **Como você avaliaria uma solução bem-sucedida?** Cumprir todos os requisitos pedidos.

## Avaliando a Confiabilidade, o Desempenho e as Necessidades de Suporte

- **Quais são suas expectativas para confiabilidade?** Entregar os resultados gerados pelo aparelho com segurança.

- **Quais são suas expectativas para desempenho?** Um sistema 24/7 dentro de um servidor.
- **Você ou outras pessoas suportarão o produto?**  Será feito o suporte caso necessário.

- **Você tem necessidades especiais para suporte?** E com relação ao acesso de manutenção e serviço? Em análise.

- **Quais são os requisitos de segurança?** Manter o laudo e a conta dos usuários segura.

- **Quais são os requisitos de instalação e configuração?** Em análise.

- **Quais são os requisitos de licença especiais?** Não se aplica.

- **Como o software será distribuído?** Servidor do departamento de computação.

## Wrap-Up

- **Se eu precisar fazer outras perguntas, posso telefonar para você?** Mandar e-mail ou WhatsApp (preferencialmente e-mail)

- **Você estaria disposto a participar de uma revisão de requisitos?** Está disposta a ter outras reuniões e demonstrar na prática como é feito o exame atualmente.

## Resumo do Analista

- Gerar laudos;

- Agendar consulta;

- Coletar dados;

- Enviar o laudo para o paciente.

---

[Voltar](readme.md)

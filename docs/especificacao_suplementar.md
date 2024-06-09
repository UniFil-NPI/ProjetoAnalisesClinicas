# Especificação Suplementar </br> Projeto de Análises Clínicas </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 21/03/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |

## Índice

1. [Introdução](#introdução)

    1. [Objetivo](#objetivo)

    2. [Escopo](#escopo)

    3. [Definições, Acrônimos e Abreviações](#definições-acrônimos-e-abreviações)

    4. [Referências](#referências)

    5. [Visão Geral](#visão-geral)

2. [Funcionalidade](#funcionalidade)

3. [Utilidade](#utilidade)

     1. [Treinamento](#treinamento)

4. [Confiabilidade](#confiabilidade)

    1. [Disponibilidade](#disponibilidade)

    2. [Exatidão](#exatidão)

    3. [Taxa de Erros ou Defeitos](#taxa-de-erros-ou-defeitos)

5. [Desempenho](#desempenho)

    1. [Capacidade](#capacidade)

6. [Suportabilidade](#suportabilidade)

    1. [Padrão de Codificação](#padrão-de-codificação)

7. [Restrições de Design](#restrições-de-design)

    1. [Logo e Cores](#logo-e-cores)

    2. [Liguagem de Programação](#liguagem-de-programação)

8. [Documentação do Usuário On-line e Requisitos do Sistema de Ajuda](#documentação-do-usuário-on-line-e-requisitos-do-sistema-de-ajuda)

9. [Componentes Comprados](#componentes-comprados)

10. [Interfaces](#interfaces)

    1. [Interfaces de Hardware](#interfaces-de-hardware)

    2. [Interfaces de Software](#interfaces-de-software)

    3. [Interfaces de Comunicações](#interfaces-de-comunicações)

11. [Requisitos de Licença](#requisitos-de-licença)

12. [Observações Legais, sobre Direitos Autorais e Outras Observações](#observações-legais-sobre-direitos-autorais-e-outras-observações)

13. [Padrões Aplicáveis](#padrões-aplicáveis)

## Introdução

O documento de Especificação Suplementar é responsável por capturar os requisitos do sistema que não são prontamente capturados nos casos de uso do modelo de caso de uso. Entre os requisitos estão incluídos:

- Requisitos legais e de regulamentação, incluindo padrões de aplicativos.

- Atributos de qualidade do sistema a ser criado, incluindo requisitos de utilidade, confiabilidade, desempenho e suportabilidade.

- Outros requisitos como sistemas e ambientes operacionais, requisitos de
compatibilidade e restrições de design.

### Objetivo

Esta especificação suplementar visa complementar o modelo caso de uso, juntos capturam todos os requisitos de software que precisam ser descritos.

### Escopo

Esse documento engloba os requisitos de todo o sistema que será feito.

### Definições, Acrônimos e Abreviações

Consultar o [glossário](glossario.md).

### Referências

OLIVEIRA, M. Conheça os detalhes dos Estilos de Indentação. Disponível em: <https://terminalroot.com.br/2022/02/conheca-os-detalhes-dos-estilos-de-indentacao.html>. Acesso em: 23 mar. 2024.

Convenções de nomenclatura: Camel, Pascal, Kebab e Snake case. Disponível em: <https://www.alura.com.br/artigos/convencoes-nomenclatura-camel-pascal-kebab-snake-case>. Acesso em: 23 mar. 2024.

### Visão Geral

As sessões abaixo detalham os requisitos do sistema, informações que não foram possíveis de identificar somente com os diagramas, sendo eles: Funcionalidade; utilidade; confiabilidade; desempenho; suportabilidade; restrições de design; documentação do usuário on-line e requisitos do sistema de ajuda; componentes comprados; interfaces; requisitos de licença; observações legais, sobre direitos autorais e outras observações; padrões aplicaveis.

## Funcionalidade

Os requisitos funcionais do projeto estão disponíveis no [diagrama de caso de uso](diagramas/caso_de_uso.png).

## Utilidade

### Treinamento

Existirá um treinamento quando o sistema for implantado e será incluso uma documentação on-line.

## Confiabilidade

### Disponibilidade

O sistema deve estar disponivel 24/7.

### Exatidão

O sistema deve ter uma exatidão nos cálculos

### Taxa de Erros ou Defeitos

Erro crítico: Perda de informações, imprecisão nos cálculos, falta de segurança.

## Desempenho

### Capacidade

O sistema deve ter a capacidade de armazenar uma grande quantidade de informações(Laudos) dos usuários e ter a capacidade de permitir inúmeros usuários utilizando o sistema ao mesmo tempo.

## Suportabilidade

### Padrão de Codificação

Será utilizado um padrão para definir nomes de variaveis e funções/métodos será usado o camelCase, classes será usado o PascalCase, constantes utilizarão o padrão Screaming snake case, a indentação do código deverá seguir o [estilo K&R](https://terminalroot.com.br/2022/02/conheca-os-detalhes-dos-estilos-de-indentacao.html).

As técnologias utilizadas no Front-end serão: HTML, CSS, JavaScript e [Vue.js](https://vuejs.org/). No Back-end será usado: [Laravel](https://laravel.com/).

## Restrições de Design

### Logo e Cores

O sistema deverá conter a logo da UniFil e seguir um padrão de cores descrito pela empresa.

### Liguagem de Programação

O sistema será desenvolvido com [Vue.js](https://vuejs.org/) e [Tailwind CSS](https://tailwindcss.com/).

## Documentação do Usuário On-line e Requisitos do Sistema de Ajuda

O sistema conterá uma documentação on-line.

## Componentes Comprados

Não se aplica.

## Interfaces

### Interfaces de Hardware

Em análise.

### Interfaces de Software

Em análise.

### Interfaces de Comunicações

Em análise.

## Requisitos de Licença

Não se aplica.

## Observações Legais, sobre Direitos Autorais e Outras Observações

O sistema terá as observações legais de acordo com os padrões da instituição UniFil.

## Padrões Aplicáveis

Não se aplica.

---

[Voltar](readme.md)

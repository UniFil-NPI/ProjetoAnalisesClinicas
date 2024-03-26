# Especificação Suplementar </br> Projeto de Análises Clínicas </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 21/03/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |

## Índice

- [Especificação Suplementar  Projeto de Análises Clínicas  Versão 1.0](#especificação-suplementar--projeto-de-análises-clínicas--versão-10)
  - [Histórico da Revisão](#histórico-da-revisão)
  - [Índice](#índice)
  - [1. Introdução](#1-introdução)
    - [1.1 Objetivo](#11-objetivo)
    - [1.2 Escopo](#12-escopo)
    - [1.3 Definições, Acrônimos e Abreviações](#13-definições-acrônimos-e-abreviações)
    - [1.4 Referências](#14-referências)
    - [1.5 Visão Geral](#15-visão-geral)
  - [2. Funcionalidade](#2-funcionalidade)
  - [3. Utilidade](#3-utilidade)
    - [3.1 Treinamento](#31-treinamento)
  - [4. Confiabilidade](#4-confiabilidade)
    - [4.1 Disponibilidade](#41-disponibilidade)
    - [4.2 Exatidão](#42-exatidão)
    - [4.3 Taxa de Erros ou Defeitos](#43-taxa-de-erros-ou-defeitos)
  - [5. Desempenho](#5-desempenho)
    - [5.1 Capacidade](#51-capacidade)
  - [6. Suportabilidade](#6-suportabilidade)
    - [6.1 Padrão de Codificação](#61-padrão-de-codificação)
  - [7. Restrições de Design](#7-restrições-de-design)
    - [7.1 Logo e Cores](#71-logo-e-cores)
    - [7.2 Liguagem de Programação](#72-liguagem-de-programação)
  - [8. Documentação do Usuário On-line e Requisitos do Sistema de Ajuda](#8-documentação-do-usuário-on-line-e-requisitos-do-sistema-de-ajuda)
  - [9. Componentes Comprados](#9-componentes-comprados)
  - [10. Interfaces](#10-interfaces)
    - [10.1 Interfaces de Hardware](#101-interfaces-de-hardware)
    - [10.2 Interfaces de Software](#102-interfaces-de-software)
    - [10.3 Interfaces de Comunicações](#103-interfaces-de-comunicações)
  - [11. Requisitos de Licença](#11-requisitos-de-licença)
  - [12. Observações Legais, sobre Direitos Autorais e Outras Observações](#12-observações-legais-sobre-direitos-autorais-e-outras-observações)
  - [13. Padrões Aplicáveis](#13-padrões-aplicáveis)

## 1. Introdução

O documento de Especificação Suplementar é responsável por capturar os requisitos do sistema que não são prontamente capturados nos casos de uso do modelo de caso de uso. Entre os requisitos estão incluídos:

- Requisitos legais e de regulamentação, incluindo padrões de aplicativos.

- Atributos de qualidade do sistema a ser criado, incluindo requisitos de utilidade, confiabilidade, desempenho e suportabilidade.

- Outros requisitos como sistemas e ambientes operacionais, requisitos de
compatibilidade e restrições de design.

### 1.1 Objetivo

Esta especificação suplementar visa complementar o modelo caso de uso, juntos capturam todos os requisitos de software que precisam ser descritos.

### 1.2 Escopo

Esse documento engloba os requisitos de todo o sistema que será feito.

### 1.3 Definições, Acrônimos e Abreviações

Consultar o [glossário](glossario.md).

### 1.4 Referências

OLIVEIRA, M. Conheça os detalhes dos Estilos de Indentação. Disponível em: <https://terminalroot.com.br/2022/02/conheca-os-detalhes-dos-estilos-de-indentacao.html>. Acesso em: 23 mar. 2024.

Convenções de nomenclatura: Camel, Pascal, Kebab e Snake case. Disponível em: <https://www.alura.com.br/artigos/convencoes-nomenclatura-camel-pascal-kebab-snake-case>. Acesso em: 23 mar. 2024.

### 1.5 Visão Geral

As sessões abaixo detalham os requisitos do sistema, informações que não foram possíveis de identificar somente com os diagramas, sendo eles: Funcionalidade; utilidade; confiabilidade; desempenho; suportabilidade; restrições de design; documentação do usuário on-line e requisitos do sistema de ajuda; componentes comprados; interfaces; requisitos de licença; observações legais, sobre direitos autorais e outras observações; padrões aplicaveis.

## 2. Funcionalidade

Os requisitos funcionais do projeto estão disponíveis no [diagrama de caso de uso](diagramas/caso_de_uso.png).

## 3. Utilidade

### 3.1 Treinamento

Existirá um treinamento quando o sistema for implantado e será incluso uma documentação on-line.

## 4. Confiabilidade

### 4.1 Disponibilidade

O sistema deve estar disponivel 24/7.

### 4.2 Exatidão

O sistema deve ter uma exatidão nos cálculos

### 4.3 Taxa de Erros ou Defeitos

Erro crítico: Perda de informações, imprecisão nos cálculos, falta de segurança.

## 5. Desempenho

### 5.1 Capacidade

O sistema deve ter a capacidade de armazenar uma grande quantidade de informações(Laudos) dos usuários e ter a capacidade de permitir inúmeros usuários utilizando o sistema ao mesmo tempo.

## 6. Suportabilidade

### 6.1 Padrão de Codificação

Será utilizado um padrão para definir nomes de variaveis e funções/métodos será usado o camelCase, classes será usado o PascalCase, constantes utilizarão o padrão Screaming snake case, a indentação do código deverá seguir o [estilo K&R](https://terminalroot.com.br/2022/02/conheca-os-detalhes-dos-estilos-de-indentacao.html).

As técnologias utilizadas no Front-end serão: HTML, CSS, JavaScript e [Vue.js](https://vuejs.org/). No Back-end será usado: [NestJS](https://nestjs.com/), [Node.js](https://nodejs.org/en) e o banco de dados MySQL.

## 7. Restrições de Design

### 7.1 Logo e Cores

O sistema deverá conter a logo da UniFil e seguir um padrão de cores descrito pela empresa.

### 7.2 Liguagem de Programação

O sistema será desenvolvido com [Vue.js](https://vuejs.org/) utilizando a UI library [daisyUI](https://daisyui.com/).

## 8. Documentação do Usuário On-line e Requisitos do Sistema de Ajuda

O sistema conterá uma documentação on-line.

## 9. Componentes Comprados

Não se aplica.

## 10. Interfaces

### 10.1 Interfaces de Hardware

Em análise.

### 10.2 Interfaces de Software

Em análise.

### 10.3 Interfaces de Comunicações

Em análise.

## 11. Requisitos de Licença

Não se aplica.

## 12. Observações Legais, sobre Direitos Autorais e Outras Observações

O sistema terá as observações legais de acordo com os padrões da instituição UniFil.

## 13. Padrões Aplicáveis

Não se aplica.

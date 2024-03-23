# Especificação Suplementar </br> Projeto de Análises Clínicas </br> Versão 1.0

## Histórico da Revisão

| Data | Versão | Descrição | Autor |
| ---- | ------ | --------- | ----- |
| 21/03/2024 | 1.0 | Criação do documento | Guilherme Rafael Faraco Vieira |

## Índice

- [1. Introdução](#1introdução)
  
  - [1.1 Objetivo](#11-objetivo)
  
  - [1.2 Escopo](#12-escopo)
  
  - [1.3 Definições, Acrônimos e Abreviações](#13-definições-acrônimos-e-abreviações)
  
  - [1.4 Referências](#14-referências)
  
  - [1.5 Visão Geral](#15-visão-geral)

- [2. Funcionalidade](#2funcionalidade)

- [3. Utilidade](#3utilidade)

  - [3.1 Treinamento](#31-treinamento)

- [4. Confiabilidade](#4confiabilidade)

  - [4.1 Disponibilidade](#41-disponibilidade)
  
  - [4.2 MTTR](#42-mttr-mean-time-to-repair)

  - [4.3 Exatidão](#43-exatidão)
  
  - [4.4 Taxa de Erros ou Defeitos](#44-taxa-de-erros-ou-defeitos)

- [5. Desempenho](#5desempenho)

  - [5.1 Capacidade](#51-capacidade)

- [6. Suportabilidade](#6suportabilidade)

  - [6.1 Padrão de Codificação](#61-padrão-de-codificação)

- [7. Restrições de Design](#7restrições-de-design)

  - [7.1 Logo e Cores](#71-logo-e-cores)

  - [7.1 Linguagem de Programação](#72-liguagem-de-programação)

- [8. Documentação do Usuário On-line e Requisitos do Sistema de Ajuda](#8documentação-do-usuário-on-line-e-requisitos-do-sistema-de-ajuda)

- [9. Componentes Comprados](#9componentes-comprados)

- [10. Interfaces](#10interfaces)

  - [10.1 Interfaces com o Usuário](#101-interfaces-com-o-usuário)

  - [10.2 Interfaces de Hardware](#102-interfaces-de-hardware)

  - [10.3 Interfaces de Software](#103-interfaces-de-software)

  - [10.4 Interfaces de Comunicações](#104-interfaces-de-comunicações)

- [11. Requisitos de Licença](#11requisitos-de-licença)

- [12. Observações Legais, sobre Direitos Autorais e Outras Observações](#12observações-legais-sobre-direitos-autorais-e-outras-observações)

- [13. Padrões Aplicáveis](#13padrões-aplicáveis)

## 1.Introdução

O documento de Especificação Suplementar é responsável por capturar os requisitos do sistema que não são prontamente capturados nos casos de uso do modelo de caso de uso. Entre os requisitos estão incluídos:

- Requisitos legais e de regulamentação, incluindo padrões de aplicativos.

- Atributos de qualidade do sistema a ser criado, incluindo requisitos de utilidade, confiabilidade, desempenho e suportabilidade.

- Outros requisitos como sistemas e ambientes operacionais, requisitos de 
compatibilidade e restrições de design.

### 1.1 Objetivo

Esta especificação suplementar visa complementar o modelo caso de uso, juntos capturam todos os requisitos de software que precisam ser descritos.

### 1.2 Escopo

[Uma breve descrição do escopo desta Especificação Suplementar; a qual(is) Projeto(s) ele está associado e tudo mais que seja afetado ou influenciado por este documento.]

### 1.3 Definições, Acrônimos e Abreviações

Consultar o [glossário](glossario.md).

### 1.4 Referências

ATLASSIAN. MTBF, MTTR, MTTF, MTTA: Understanding incident metrics. Disponível em: <https://www.atlassian.com/incident-management/kpis/common-metrics>. Acesso em: 23 mar. 2024.

OLIVEIRA, M. Conheça os detalhes dos Estilos de Indentação. Disponível em: <https://terminalroot.com.br/2022/02/conheca-os-detalhes-dos-estilos-de-indentacao.html>. Acesso em: 23 mar. 2024.

Convenções de nomenclatura: Camel, Pascal, Kebab e Snake case. Disponível em: <https://www.alura.com.br/artigos/convencoes-nomenclatura-camel-pascal-kebab-snake-case>. Acesso em: 23 mar. 2024.

### 1.5 Visão Geral

[Esta subseção descreve o que o restante da Especificação Suplementar contém e explica como o documento é organizado.]

## 2.Funcionalidade

Os requisitos funcionais do projeto estão disponíveis no [diagrama de caso de uso](caso_de_uso.png).

## 3.Utilidade

### 3.1 Treinamento

O sistema será feito de maneira intuitiva, para que não precise de nenhum treinamento, porém será feita uma documentação caso existam dúvidas.

## 4.Confiabilidade

### 4.1 Disponibilidade

O sistema deve estar disponivel 24/7.

### 4.2 MTTR (Mean Time To Repair)

Caso o sistema falhe ele tem poucas horas para voltar ao ar.

### 4.3 Exatidão

O sistema deve capturar de forma exata o protocolo HL7, também deve realizar os cálculos do teste de paternidade e informa-los ao usuário.

### 4.4 Taxa de Erros ou Defeitos

Erro crítico: Perda de informações, imprecisão nos cálculos, falta de segurança.

## 5.Desempenho

### 5.1 Capacidade

O sistema deve ter a capacidade de armazenar uma grande quantidade de informações(Laudos) dos usuários e ter a capacidade de permitir inúmeros usuários utilizando o sistema ao mesmo tempo.

## 6.Suportabilidade

### 6.1 Padrão de Codificação

Será utilizado um padrão para definir nomes de variaveis e funções/métodos será usado o camelCase, classes será usado o PascalCase, constantes utilizarão o padrão Screaming snake case, a indentação do código deverá seguir o [estilo K&R](https://terminalroot.com.br/2022/02/conheca-os-detalhes-dos-estilos-de-indentacao.html).

As técnologias utilizadas no Front-end serão: HTML, CSS, JavaScript e React. No Back-end será usado: PHP, Laravel e o banco de dados MySQL.

## 7.Restrições de Design

### 7.1 Logo e Cores

O sistema deverá conter a logo da UniFil e seguir um padrão de cores descrito pela empresa.

### 7.2 Liguagem de Programação

O sistema será desenvolvido com React utilizando a UI library PrimeFaces.

## 8.Documentação do Usuário On-line e Requisitos do Sistema de Ajuda

Qualquer dúvida que o usuário tenha será resolvida ligando para a clínica.

## 9.Componentes Comprados

Não se aplica.

## 10.Interfaces

[Esta seção define as interfaces que devem ser suportadas pelo aplicativo. Ela deve conter especificidade adequada, protocolos, portas, endereços lógicos e assim por diante, para que o software possa ser desenvolvido e verificado em comparação com os requisitos da interface.]

### 10.1 Interfaces com o Usuário

[Descreva as interfaces com o usuário que devem ser implementadas pelo software.]

### 10.2 Interfaces de Hardware

[Esta seção define as interfaces de hardware que devem ser suportadas pelo software, incluindo estrutura lógica, endereços físicos, comportamento esperado e assim por diante.]

### 10.3 Interfaces de Software

[Esta seção descreve as interfaces de software para outros componentes do sistema de software. Estas podem ser componentes comprados, componentes reutilizados de outro aplicativo ou componentes que estão sendo desenvolvidos para subsistemas fora do escopo desta SRS, mas com os quais este aplicativo de software deve interagir.]

### 10.4 Interfaces de Comunicações

 [Descreva as interfaces de comunicações para outros sistemas ou dispositivos como redes locais, dispositivos seriais remotos e assim por diante.]

## 11.Requisitos de Licença

Não existe.

## 12.Observações Legais, sobre Direitos Autorais e Outras Observações

O sistema terá as observações legais de acordo com os padrões da instituição UniFil.

## 13.Padrões Aplicáveis

[Esta seção descreve, por referência, os padrões aplicáveis e as seções específicas desses padrões que se aplicam ao sistema que está sendo descrito. Por exemplo, isso pode incluir padrões jurídicos, de qualidade e reguladores, padrões de mercado para utilidade, interoperabilidade, internacionalização, conformidade com o sistema operacional e assim por diante.]

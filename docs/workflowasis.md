``` mermaid

---
title: Workflow AS-IS
---


flowchart TB
    A[Início] --> B{Possui cadastro?}
    B -- Sim --> C1[Coleta o sangue]
    B -- Não ----> C2[Realiza cadastro]
    C1 --> D[Recupera os dados do aparelho]
    C2 --> C1
    D --> E[Passa os dados gerados pelo aparelho]
    E -- Sangue ---->  H1[Para o Word]
    E -- Paternidade ----> H2[Para o Excel]
    H1 --> I1[Gera o laudo]
    H2 --> I2[Realiza os calculos]
    I2 --> I1
    I1 --> J[Envia para o cliente]

```

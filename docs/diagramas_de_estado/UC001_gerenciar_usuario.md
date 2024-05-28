# Diagrama de Estado

```mermaid
stateDiagram-v2

direction LR
[*] --> ativo
ativo --> [*]
ativo --> inativo : Desativar
inativo --> ativo : Ativar
inativo --> [*]


```

---

[Voltar](readme.md)

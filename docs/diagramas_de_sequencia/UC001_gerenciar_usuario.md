# Diagrama de Sequência

## Cadastro de Usuário

```mermaid
sequenceDiagram

actor Funcionario

activate Funcionario
Funcionario ->> Register.vue: acessa
activate Register.vue
Register.vue ->> /register: POST
deactivate Register.vue
activate /register
/register ->> RegisteredUserController: store($request)
deactivate /register
activate RegisteredUserController
RegisteredUserController ->> UserModel: registra o usuário no banco
deactivate RegisteredUserController

alt dados válidos
    activate UserModel
    UserModel --) RegisteredUserController: OK
    activate Dashboard.vue
    deactivate UserModel
    RegisteredUserController ->> Dashboard.vue: redirect()
    deactivate Dashboard.vue
else dados inválidos
    activate UserModel
    UserModel --) RegisteredUserController: Usuário ja cadastrado
    deactivate UserModel
    activate Register.vue
    RegisteredUserController ->> Register.vue: redirect()
    deactivate Register.vue

end

deactivate Funcionario


```

## Buscar Usuário

```mermaid
sequenceDiagram

actor Funcionario

activate Funcionario

Funcionario ->> Search.vue: acessa

activate Search.vue
Search.vue ->> /search: Post 
deactivate Search.vue
activate /search
/search ->> SearchController: search($request)
deactivate /search
activate SearchController
SearchController ->> UserModel: busca o nome no banco
deactivate SearchController

alt achou 
activate UserModel
UserModel --) SearchController: OK
deactivate UserModel
activate Edit.vue
SearchController ->> Edit.vue: redirect()
deactivate Edit.vue
else não achou
activate UserModel
UserModel --) SearchController: Usuário não encontrado
deactivate UserModel
activate Search.vue
SearchController ->> Search.vue: redirect()
deactivate Search.vue
end

deactivate Funcionario
```

## Atualizar Cadastro

```mermaid
sequenceDiagram

actor Funcionario

activate Funcionario
Funcionario ->> Edit.vue: acessa
activate Edit.vue
Edit.vue ->> /edit: POST
deactivate Edit.vue
activate /edit
/edit ->> ProfileController: update($request)
deactivate /edit
activate ProfileController
ProfileController ->> UserModel: Salva a atualização no banco
deactivate ProfileController

alt dados válidos
    activate UserModel
    UserModel --) ProfileController: OK
    activate Dashboard.vue
    deactivate UserModel
    ProfileController ->> Dashboard.vue: redirect()
    deactivate Dashboard.vue
else dados inválidos
    activate UserModel
    UserModel --) ProfileController: Dados inválidos
    deactivate UserModel
    activate Edit.vue
    ProfileController ->> Edit.vue: redirect()
    deactivate Edit.vue

end

deactivate Funcionario

```

---

[Voltar](readme.md)

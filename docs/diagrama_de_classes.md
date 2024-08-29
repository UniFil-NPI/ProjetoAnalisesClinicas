# DIAGRAMA DE CLASSES

```mermaid
---
title: Sistema de Análises Clínicas
---
classDiagram

direction LR

User "1" *-- "0..1" Patient : is

class User {
    #id id
    #string cpf 
    #string name
    #string email
    #string password
    #boolean status
    +index()
    +create()
    +store(request)
    +edit(id)
    +update(request, id)
    +search(request)
}

Patient "1" o-- "0..n" Exam : has

class Patient{
    #id id
    #foreignId user_id
    #string phone_number
    #string post_code
    #string street
    #string building_number
    #string secondary_address
    #string neighborhood
    #string city
    #string state
    #date birth_date
    #string health_insurance
    #string biological_sex
    +index()
    +getCep(cep)
    +create()
    +store(request)
    +edit(id)
    +update(request, id)
    +search(request)
    -formatCpf(cpfRequest)
}

class Exam {
    #id id
    #foreignId patient_id
    #foreignId doctor_id
    #string lab
    #string health_insurance
    #longText description
    #date exam_date
    +index()
    +create()
    +store(request)
    +search(request)
    +edit(id)
    +update(id, request)

}

Doctor "1" o-- "0..n" Exam : has

class Doctor {
    #id id
    #string name
    #string crm
    +index()
    +create()
    +store(request)
    +search(request)
    +edit(id)
    +update(request, id)
}


```

---

[Voltar](readme.md)

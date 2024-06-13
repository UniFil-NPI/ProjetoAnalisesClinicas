# DIAGRAMA DE CLASSES

```mermaid
---
title: Sistema de Análises Clínicas
---
classDiagram

direction LR

User "1" *-- "0..1" Patient : is

class User {
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
    #int user_id
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
}

class Exam {
    #int patient_id
    #string patient_name
    #string doctor_name
    #string lab
    #string health_insurance
    #int patient_age
    #date exam_date
    #date report_issuance_date

}


```

---

[Voltar](readme.md)

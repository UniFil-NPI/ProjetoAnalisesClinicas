# Guia de Instalação

## Clone o repositório

Acesse o terminal e clone o repositório onde você desejar em sua máquina:

  SSH

  ```sh
  git clone git@github.com:UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira.git nome_do_diretorio
  ```

  HTTPS

  ```sh
  git clone https://github.com/UniFil-NPI/projeto_analises_clinicas-GuilhermeRFVieira.git nome_do_diretorio
  ```

## Acesse o diretório do projeto Laravel

Entre no diretório do projeto:

```sh
cd nome_do_diretorio
cd analisesclinicas
```

## Composer

É necessário ter o Composer instalado em seu sistema. Caso não possua acesse [getcomposer](https://getcomposer.org/) e faça a instalação.

Após a instalação do Composer em seu sistema, volte ao terminal e execute:

```sh
composer install
```

## Arquivo .env

Copie o arquivo .env.example para que possa serem configuradas as informações necessárias.

```sh
cp .env.example .env
```

Abra o arquivo e substitua os seguintes valores de acordo com as informações do seu banco:

```sh
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5500
DB_DATABASE=analisesclinicas
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

## Crie uma nova chave para a aplicação

Volte ao terminal dentro da pasta analisesclinicas e execute o seguinte comando:

```sh
php artisan key:generate
```

## Realize as migrations

Execute o seguinte comando para rodar as migrations

```sh
php artisan migrate
```

## Execute os Seeders

Execute o seguinte comando para popular o banco com alguns dados:

```sh
php artisan db:seed
```

## Instalando as dependências do NPM

É necessário ter o Node.js instalado em seu sistema. Caso não tenha, acesse [nodejs](https://nodejs.org) e instale. Após ter o node instalado volte ao terminal dentro do diretório analisesclinicas e rode o comando:

```sh
npm install
```

## Rodando a aplicação

Para rodar a aplicação, basta rodar esse comando no terminal dentro da pasta analisesclinicas:

```sh
npm run dev
```

Criar uma nova instância do terminal e rodar:

```sh
php artisan serve
```

Dessa forma o projeto estará rodando localmente em sua máquina em [Localhost](http://localhost:8000/).

## Contas criadas usando o seeder

### Conta admin

**Login:** 618.837.920-29
**Senha:** 123

### Conta paciente

**Login:** 136.483.140-68
**Senha:** 123

---

[Voltar](../README.md)
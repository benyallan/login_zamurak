# Login Zamurak

Este é o repositório do projeto Login Zamurak. Este projeto utiliza Laravel Sail para facilitar o desenvolvimento em um ambiente Docker.

## Requisitos

- Docker
- Docker Compose

## Clonando o Repositório

Para clonar o repositório, execute o seguinte comando:

```bash
git clone git@github.com:benyallan/login_zamurak.git
```

## Instalando Dependências

Navegue até o diretório do projeto e instale as dependências:

```bash
cd login_zamurak
composer install
```

Agora você pode iniciar o Laravel Sail:

```bash
./vendor/bin/sail up -d
```

Com o Sail ativo, instale as dependências do frontend:

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run build
```

## Configurando o Ambiente

Copie o arquivo `.env.example` para `.env` e gere a chave da aplicação:

```bash
cp .env.example .env
./vendor/bin/sail artisan key:generate
```

## Executando as Migrações

Execute as migrações para configurar o banco de dados:

```bash
./vendor/bin/sail artisan migrate --seed
```

## Iniciando o Servidor

Caso ainda não tenha iniciado, inicie o servidor de desenvolvimento:

```bash
./vendor/bin/sail up -d
```

Agora você pode acessar o aplicativo em [http://localhost](http://localhost).

## Credenciais de Acesso

Para acessar o sistema, utilize as credenciais padrão:

- **Login:** beny
- **Senha:** test

## Links Úteis

- [Repositório no GitHub](https://github.com/benyallan/login_zamurak)
- [Login zamura online](https://zamurak.bdtechsolutions.com.br)

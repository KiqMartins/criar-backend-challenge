# Desafio WEB Backend - Grupo CRIAR

Este repositório contém a solução para o Desafio WEB Backend proposto pelo Grupo CRIAR. A aplicação consiste em uma API RESTful desenvolvida em Laravel para gerenciar estados, cidades, grupos de cidades (clusters), campanhas, descontos e produtos.

## Stack de Tecnologia

* **Linguagem:** PHP 8.2
* **Framework:** Laravel 12
* **Banco de Dados:** MySQL 8.0
* **Servidor Web:** Nginx
* **Ambiente de Desenvolvimento:** Docker & Docker Compose

## Visão Geral da Arquitetura

O projeto foi estruturado seguindo princípios de Clean Architecture e Domain-Driven Design (DDD), visando alta coesão, baixo acoplamento e máxima testabilidade.

* **Separação de Camadas:** A lógica é dividida em Camadas de Domínio, Serviço e Repositório.
* **Repository Pattern:** A camada de acesso a dados é abstraída através de interfaces, permitindo que a lógica de negócio seja independente da implementação do banco de dados (Eloquent).
* **DTOs (Data Transfer Objects):** `Form Requests` são utilizados para validação de entrada e `API Resources` para a transformação e padronização das respostas JSON.
* **Injeção de Dependência:** O Service Container do Laravel é utilizado extensivamente para gerenciar as dependências e "amarrar" as interfaces às suas implementações concretas.
* **Models:** Embora o PHP possua o PSR-4 definindo a posição das models em App\Models, partiu-se de uma alternativa inserindo dentro da própria Domain da entidade.

---

## Requisitos para instalação

* Git
* Docker
* Docker Compose

---

## Instalação e Execução

Siga os passos abaixo para configurar e executar o ambiente de desenvolvimento.

**1. Clonar o Repositório**

```bash
git clone https://github.com/KiqMartins/criar-backend-challenge.git
cd criar-backend-challenge
```

**2. Construir e Iniciar os Containers**

```bash
USER_ID=$(id -u) GROUP_ID=$(id -g) docker-compose up -d --build
```


**3. Instalar as Dependências do Composer**

```bash
docker-compose exec app composer install
```

**4. Configurar o Arquivo de Ambiente**

```bash
docker-compose exec app cp .env.example .env
```

**5. Gerar a Chave da Aplicação**

```bash
docker-compose exec app php artisan key:generate
```

**5. Executar as Migrations**

```bash
docker-compose exec app php artisan migrate
```

## Pronto, sua aplicação agora está rodando e acessível.

## URL da API: http://localhost:8080/api/v1




## Endpoints da API

A API segue os padrões RESTful para manipulação de recursos.

**URL Base:** `http://localhost:8080/api/v1`

### Estados

| Método HTTP | Endpoint           | Descrição da Ação              |
| :---------- | :----------------- | :----------------------------- |
| `GET`       | `/states`          | Listar todos os estados.       |
| `POST`      | `/states`          | Criar um novo estado.          |
| `GET`       | `/states/{state}`  | Obter um estado específico.    |
| `PUT`       | `/states/{state}`  | Atualizar um estado existente. |
| `DELETE`    | `/states/{state}`  | Excluir um estado.             |

### Cidades

| Método HTTP | Endpoint         | Descrição da Ação               |
| :---------- | :--------------- | :------------------------------ |
| `GET`       | `/cities`        | Listar todas as cidades.        |
| `POST`      | `/cities`        | Criar uma nova cidade.          |
| `GET`       | `/cities/{city}` | Obter uma cidade específica.    |
| `PUT`       | `/cities/{city}` | Atualizar uma cidade existente. |
| `DELETE`    | `/cities/{city}` | Excluir uma cidade.             |

### Grupos de Cidades (Clusters)

| Método HTTP | Endpoint             | Descrição da Ação               |
| :---------- | :------------------- | :------------------------------ |
| `GET`       | `/clusters`          | Listar todos os grupos.         |
| `POST`      | `/clusters`          | Criar um novo grupo.            |
| `GET`       | `/clusters/{cluster}`| Obter um grupo específico.      |
| `PUT`       | `/clusters/{cluster}`| Atualizar um grupo existente.   |
| `DELETE`    | `/clusters/{cluster}`| Excluir um grupo.               |

### Campanhas

| Método HTTP | Endpoint               | Descrição da Ação                  |
| :---------- | :--------------------- | :--------------------------------- |
| `GET`       | `/campaigns`           | Listar todas as campanhas.         |
| `POST`      | `/campaigns`           | Criar uma nova campanha.           |
| `GET`       | `/campaigns/{campaign}`| Obter uma campanha específica.     |
| `PUT`       | `/campaigns/{campaign}`| Atualizar uma campanha existente.  |
| `DELETE`    | `/campaigns/{campaign}`| Excluir uma campanha.              |

### Descontos

| Método HTTP | Endpoint               | Descrição da Ação                 |
| :---------- | :--------------------- | :-------------------------------- |
| `GET`       | `/discounts`           | Listar todos os descontos.        |
| `POST`      | `/discounts`           | Criar um novo desconto.           |
| `GET`       | `/discounts/{discount}`| Obter um desconto específico.     |
| `PUT`       | `/discounts/{discount}`| Atualizar um desconto existente.  |
| `DELETE`    | `/discounts/{discount}`| Excluir um desconto.              |

### Produtos

| Método HTTP | Endpoint             | Descrição da Ação               |
| :---------- | :------------------- | :------------------------------ |
| `GET`       | `/products`          | Listar todos os produtos.       |
| `POST`      | `/products`          | Criar um novo produto.          |
| `GET`       | `/products/{product}`| Obter um produto específico.    |
| `PUT`       | `/products/{product}`| Atualizar um produto existente. |
| `DELETE`    | `/products/{product}`| Excluir um produto.             |
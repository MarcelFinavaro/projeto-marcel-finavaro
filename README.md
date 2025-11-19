
# 🧾 Sistema Web de Gestão de Ordens de Serviço para Oficinas Mecânicas

**Projeto Tecnológico em Desenvolvimento de Sistemas**  
**Autor:** Marcel Fernando Finavaro  
**Contato:** marcelfinavaro@rede.ulbra.br  

---

## 📌 Sobre o Projeto
Sistema web desenvolvido para otimizar a gestão de ordens de serviço (OS) em oficinas mecânicas, permitindo:

- Cadastro de clientes e veículos
- Abertura e acompanhamento de ordens de serviço
- Histórico por placa
- Geração de relatórios
- Interface simples e responsiva

---

## 🧩 Estrutura do Banco de Dados (MySQL)

### 🔹 Tabela: `clientes`
| Campo       | Tipo              | Chave | Observações                     |
|-------------|-------------------|-------|----------------------------------|
| id          | bigint unsigned   | PK    | Auto incremento                 |
| nome        | varchar(255)      |       | Nome completo do cliente        |
| telefone    | varchar(255)      |       | Número de contato               |
| email       | varchar(255)      | UNI   | E-mail único                    |
| created_at  | timestamp         |       | Criado em                       |
| updated_at  | timestamp         |       | Atualizado em                   |

---

### 🔹 Tabela: `veiculos`
| Campo        | Tipo              | Chave | Observações                          |
|--------------|-------------------|-------|---------------------------------------|
| placa        | varchar(255)      | PK    | Identificador único do veículo        |
| modelo       | varchar(255)      |       | Modelo do veículo                     |
| marca        | varchar(255)      |       | Marca do veículo                      |
| ano          | year(4)           |       | Ano de fabricação                     |
| cliente_id   | bigint unsigned   | FK    | Relaciona com clientes.id             |
| created_at   | timestamp         |       | Criado em                             |
| updated_at   | timestamp         |       | Atualizado em                         |

---

### 🔹 Tabela: `ordem_servicos`
| Campo         | Tipo              | Chave | Observações                          |
|---------------|-------------------|-------|---------------------------------------|
| id            | bigint unsigned   | PK    | Auto incremento                       |
| cliente_id    | bigint unsigned   | FK    | Relaciona com clientes.id             |
| veiculo_id    | varchar(255)      | FK    | Relaciona com veiculos.placa          |
| descricao     | text              |       | Detalhes do serviço                   |
| data_servico  | date              |       | Data de execução                      |
| created_at    | timestamp         |       | Criado em                             |
| updated_at    | timestamp         |       | Atualizado em                         |

---

## 🔗 Relacionamentos entre Tabelas
| Entidade | Relacionamento | Descrição |
|----------|----------------|-----------|
| Cliente → Veículo | 1:N | Um cliente possui vários veículos |
| Cliente → Ordem de Serviço | 1:N | Um cliente possui várias OS |
| Veículo → Ordem de Serviço | 1:N | Cada OS está vinculada a um veículo |

---

## 📋 Funcionalidades

### 🔐 Autenticação
- Login seguro com hash de senha
- Proteção por sessão

### 👤 Clientes
- CRUD completo
- Validação de e-mail único

### 🚗 Veículos
- Cadastro vinculado ao cliente
- Busca por placa

### 🧾 Ordem de Serviço
- Chamados com status
- Lista, edição e acompanhamento
- Histórico por veículo

### 🔍 Pesquisas e Filtros
- Por placa
- Por cliente
- Por status
- Por período

### 📊 Relatórios
- Exportação PDF
- Visão administrativa

---

## 🛠️ Tecnologias Utilizadas

| Camada | Tecnologias |
|--------|-------------|
| Backend | PHP 8.x / Laravel 10 |
| Banco de dados | MySQL / MariaDB |
| Frontend | Blade, HTML, CSS, JS |
| Servidor local | XAMPP |
| Versionamento | Git / GitHub |
| Segurança | Auth Laravel + Hashing |

---

## 🧪 Requisitos para execução
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js (opcional para frontend)
- Git

---

## 🚀 Como rodar o projeto

```bash
git clone <repositório>
cd projeto
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve


## 📅 Cronograma de Desenvolvimento


| Semana | Entrega            |
| ------ | ------------------ |
| 1      | Requisitos         |
| 2      | Modelagem e banco  |
| 3      | Backend            |
| 4      | Frontend           |
| 5      | Integração         |
| 6      | Testes             |
| 7      | Relatórios         |
| 8      | Documentação final |



 # 🧾 Sistema Web de Gestão de Ordens de Serviço para Oficinas Mecânicas

👍 Este projeto foi desenvolvido para fins acadêmicos e profissionais.










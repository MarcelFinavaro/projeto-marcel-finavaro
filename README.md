


 # 🧾 Sistema Web de Gestão de Ordens de Serviço para Oficinas Mecânicas

**Projeto Tecnológico em Desenvolvimento de Sistemas**  
**Autor:** Marcel Fernando Finavaro  
**Contato:** marcelfinavaro@rede.ulbra.br

---

## 📌 Objetivo do Sistema

Este sistema tem como finalidade otimizar o gerenciamento de ordens de serviço em oficinas mecânicas, permitindo o cadastro de clientes e veículos, abertura e acompanhamento de ordens de serviço, geração de relatórios e controle de histórico por placa.

## 🧩 Estrutura do Banco de Dados (MySQL)

### 🔹 Tabela: `clientes`
>>>>>>> cadastro

| Campo       | Tipo                | Chave | Observações                     |
|-------------|---------------------|-------|----------------------------------|
| `id`        | `bigint unsigned`   | PK    | Chave primária, auto incremento |
| `nome`      | `varchar(255)`      |       | Nome completo do cliente        |
| `telefone`  | `varchar(255)`      |       | Número de contato               |
| `email`     | `varchar(255)`      | UNI   | E-mail único                    |
| `created_at`| `timestamp`         |       | Data de criação                 |
| `updated_at`| `timestamp`         |       | Data de atualização             |

---

### 🔹 Tabela: `veiculos`

| Campo        | Tipo                | Chave | Observações                          |
|--------------|---------------------|-------|---------------------------------------|
| `placa`      | `varchar(255)`      | PK    | Identificador único do veículo        |
| `modelo`     | `varchar(255)`      |       | Modelo do veículo                     |
| `marca`      | `varchar(255)`      |       | Marca do veículo                      |
| `ano`        | `year(4)`           |       | Ano de fabricação                     |
| `cliente_id` | `bigint unsigned`   | FK    | Relaciona com `clientes.id`           |
| `created_at` | `timestamp`         |       | Data de criação                       |
| `updated_at` | `timestamp`         |       | Data de atualização                   |

---

### 🔹 Tabela: `ordem_servicos`

| Campo         | Tipo                | Chave | Observações                          |
|---------------|---------------------|-------|---------------------------------------|
| `id`          | `bigint unsigned`   | PK    | Chave primária, auto incremento       |
| `cliente_id`  | `bigint unsigned`   | FK    | Relaciona com `clientes.id`           |
| `veiculo_id`  | `varchar(255)`      |       | Refere-se à `veiculos.placa`          |
| `descricao`   | `text`              |       | Detalhes sobre o serviço              |
| `data_servico`| `date`              |       | Data de realização do serviço         |
| `created_at`  | `timestamp`         |       | Data de criação                       |
| `updated_at`  | `timestamp`         |       | Data de atualização                   |

---

## 🔗 Relacionamentos entre Tabelas

- **Cliente → Veículo:** Um cliente pode ter vários veículos (`1:N`)
- **Cliente → Ordem de Serviço:** Um cliente pode ter várias OS (`1:N`)
- **Veículo → Ordem de Serviço:** Cada OS está associada a um veículo (`N:1`)

---

## 📋 Funcionalidades do Sistema

### 🔐 Login
- Autenticação de usuários com login e senha
- Sessão segura e criptografia de senhas

### 👤 Cadastro de Clientes
- Registro de nome, telefone e e-mail
- Validação de e-mail único

### 🚗 Cadastro de Veículos
- Associação de veículos a clientes
- Validação de placa e dados do veículo

### 🧾 Abertura de Ordem de Serviço
- Seleção de cliente e veículo
- Registro de descrição e data do serviço
- Status inicial: "Aberta"

### 🔄 Atualização de Status
- Alteração para "Em andamento", "Concluída" ou "Cancelada"
- Registro de data/hora da atualização

### 🔍 Consulta por Placa
- Histórico completo de OS vinculadas à placa
- Filtros por data, status e tipo

### 📊 Relatórios Gerenciais
- Geração de gráficos e tabelas
- Exportação em PDF

---

## 🛠️ Tecnologias Utilizadas

### Backend
- PHP
- Laravel
- XAMPP

### Banco de Dados
- MySQL
- phpMyAdmin

### Frontend
- HTML, CSS, JavaScript
- Design responsivo

### Segurança
- Autenticação e criptografia
- Controle de sessão

### Controle de Versão
- Git
- GitHub

### Compatibilidade
- Navegadores: Chrome, Firefox
- Acesso multiplataforma

---

## 📅 Cronograma de Desenvolvimento

| Semana | Atividade |
|--------|-----------|
| 1ª | Levantamento de requisitos |
| 2ª | Modelagem de dados e diagramas |
| 3ª | Desenvolvimento do backend |
| 4ª | Desenvolvimento do frontend |
| 5ª | Integração entre camadas |
| 6ª | Testes e correções |
| 7ª | Relatórios e exportação PDF |
| 8ª | Documentação e entrega final |

---

> Este README documenta a estrutura e funcionalidades reais do sistema, servindo como referência técnica para desenvolvedores, avaliadores e usuários.

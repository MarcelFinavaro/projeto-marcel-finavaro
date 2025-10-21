
PROJETO TECNOLÓGICO EM DESENVOLVIMENTO DE SISTEMAS 
Etapa - Projeto
Sistema Web de Gestão de Ordens de Serviço para Oficinas Mecânicas
Marcel Fernando Finavaro
marcelfinavaro@rede.ulbra.br
1 - Diagrama de Caso de Uso: 


 
Especificação dos Casos de Uso
1. Login
Descrição: O usuário acessa o sistema informando seu login e senha.
Fluxo principal:
•	 O usuário insere suas credenciais;
•	 O sistema valida os dados;
•	 O sistema redireciona o usuário ao painel principal.
Pré-condições: O usuário deve possuir um cadastro ativo.
Pós-condições: O sistema mantém o usuário autenticado durante a sessão.

2. Cadastrar Cliente
Descrição: Permite o cadastro de novos clientes no sistema.
Fluxo principal:
•	 O usuário informa nome, telefone e e-mail;
•	 O sistema verifica duplicidade;
•	 O sistema grava os dados no banco.
Pós-condições: Cliente é registrado e pode ter veículos vinculados.

3. Cadastrar Veículo
Descrição: Permite associar um veículo a um cliente.
Fluxo principal:
•	 O usuário seleciona um cliente existente;
•	 O sistema solicita placa, modelo e ano;
•	 O sistema valida a placa e registra o veículo.
Pré-condições: O cliente deve estar previamente cadastrado.
Pós-condições: O veículo é adicionado e disponível para abertura de OS.

4. Abrir Ordem de Serviço (OS)
Descrição: Registra uma nova OS com os serviços e peças associados.
Fluxo principal:
•	 O usuário seleciona cliente e veículo;
•	 Informa serviços e peças;
•	 Salva a “OS” com status “Aberta”.
Pós-condições: OS é criada e disponível para acompanhamento.

5. Atualizar Status da OS
Descrição: Permite ao usuário alterar o status de uma OS existente.
Fluxo principal:
•	 O usuário localiza a OS desejada;
•	 Seleciona o novo status (“Em andamento”, “Concluida” ou “Cancelada”);
•	 O sistema registra a data e hora da atualização.
Pós-condições: O status da OS é atualizado com sucesso.

6. Emitir Termo de Garantia
Descrição: Gera automaticamente um termo de garantia em formato PDF após a conclusão da OS.
Fluxo principal:
•	 O sistema identifica OS concluídas;
•	 Gera o termo com informações do cliente, serviços e validade;
•	 Disponibiliza o documento para impressão ou download.
Pós-condições: O termo de garantia é gerado e armazenado junto à OS.

7. Consultar Histórico por Placa
Descrição: Exibe o histórico de ordens de serviço vinculadas a uma placa de veículo.
Fluxo principal:
•	 O usuário informa a placa;
•	 O sistema busca e exibe todas as OS associadas;
•	 O usuário pode filtrar por data, status ou tipo de serviço.
Pós-condições: O histórico completo do veículo é exibido ao usuário.

8. Gerar Relatórios
Descrição: Permite a geração de relatórios gerenciais e estatísticos.

•	 O usuário acessa o módulo de relatórios;
•	 Seleciona filtros e período desejado;
•	 O sistema gera gráficos e tabelas com base nos dados armazenados.
Pós-condições: Relatórios são exibidos na tela e podem ser exportados em PDF.

9. Editar/Excluir Cadastros

•	O usuário acessa o módulo de cadastros;
•	 Seleciona o registro desejado;
•	 Edita ou remove o registro;
•	 O sistema mantém o histórico das alterações.
.

2. DIAGRAMA ER (MODELO ENTIDADE-RELACIONAMENTO)

2.1 Descrição Geral
O Diagrama Entidade-Relacionamento (DER) tem como objetivo representar de forma visual e lógica a estrutura do banco de dados do sistema, demonstrando as entidades, seus atributos e os relacionamentos existentes entre elas. Servindo como referência para a implementação física no banco de dados MySQL.

 
2.2 Entidades e Atributos
2.2.1 Entidade: Cliente
Descrição:
Representa os clientes cadastrados na oficina.
Atributos:
•	- id (PK): Identificador único do cliente.
•	- nome: Nome completo do cliente.
•	- telefone: Número de contato do cliente.
•	- email: Endereço de e-mail do cliente.
2.2.2 Entidade: Veículo
Descrição:
Armazena os veículos pertencentes aos clientes.
Atributos:
•	- placa (PK): Identificador único do veículo.
•	- modelo: Modelo do veículo.
•	- ano: Ano de fabricação do veículo.
•	- cliente_id (FK): Referência ao cliente proprietário do veículo.
      2.2.3 Entidade: OrdemServico
Descrição:
Representa as ordens de serviço geradas no sistema.
Atributos:
•	 id (PK): Identificador único da OS.
•	 cliente_id (FK): Chave estrangeira que identifica o cliente.
•	 placa_veículo (FK): Chave estrangeira que identifica o veículo.
•	 status: Indica o estado atual da OS (aberta, em andamento ou concluída).
•	 data_abertura: Data em que a OS foi criada.
•	 data_conclusão: Data em que o serviço foi finalizado.
      2.2.4 Entidade: ServiçoRealizado
Descrição:
Armazena os serviços executados em uma determinada OS.
Atributos:
•	 id (PK): Identificador único do serviço.
•	 ordem_id (FK): Referência à OS correspondente.
•	 descrição: Detalhamento do serviço realizado.
•	 valor: Valor cobrado pelo serviço.
       2.2.5 Entidade: PeçaSubstituída
Descrição:
Contém informações sobre as peças substituídas durante o atendimento.
Atributos:
•	 id (PK): Identificador único da peça substituída.
•	 ordem_id (FK): Referência à OS associada.
•	 nome_peca: Nome ou descrição da peça.
•	 valor: Valor da peça substituída.
2.2.6 Entidade: HistóricoOperações
Descrição:
Registra todas as operações realizadas no sistema para fins de auditoria e controle.
Atributos:
•	 id (PK): Identificador único do registro.
•	 tipo_operação: Tipo de ação executada (inserção, atualização, exclusão).
•	 usuário_id: Identificação do usuário responsável pela operação.
•	 data_hora: Data e hora em que a operação foi executada.
•	 detalhes: Descrição detalhada da operação realizada.
2.3 Relacionamentos
•	 Cliente – Veículo: Um cliente pode possuir um ou mais veículos. (1:N)
•	 Veículo – Ordem de Serviço: Um veículo pode ter diversas ordens de serviço, mas cada ordem refere-se à um único veículo. (1:N)
•	 Ordem de Serviço – Serviço Realizado: Uma OS pode conter vários serviços realizados. (1:N)
•	 Ordem de Serviço – Peça Substituída: Uma OS pode ter múltiplas peças substituídas. (1:N)
•	 Histórico de Operações: Relaciona-se com diversas entidades, registrando ações de clientes, veículos e ordens. (1:N)
2.4 Considerações Finais
O diagrama ER descrito fornece a base estrutural para a implementação física do banco de dados relacional do sistema. Essa modelagem visa garantir integridade referencial, redundância mínima e consistência dos dados, de acordo com as boas práticas de engenharia de software e modelagem de dados.



3. DIAGRAMA DE ATIVIDADE
 


3.1 DIAGRAMA DE ATIVIDADE (ABERTURA DE ORDEM DE SERVIÇO)

O Diagrama de Atividade do sistema representa o fluxo operacional envolvido na abertura de uma Ordem de Serviço (OS) dentro da oficina mecânica. Este diagrama descreve de forma sequencial e lógica as ações realizadas pelo usuário e as decisões tomadas pelo sistema, desde o acesso inicial até a conclusão do registro.

3.2 Descrição Geral

O processo inicia-se quando o usuário acessa o sistema e é direcionado à interface principal. Em seguida, o usuário seleciona o cliente e o veículo associados à OS. Após esta etapa, o sistema permite o preenchimento dos dados da Ordem de Serviço, incluindo informações sobre o problema relatado, diagnóstico inicial e observações relevantes.

Com a OS criada, o usuário procede à adição dos serviços e peças utilizadas, detalhando cada item e valor correspondente. Antes da finalização, ocorre uma verificação condicional, onde o sistema solicita confirmação do usuário para salvar a OS. Caso o usuário opte por não salvar, o fluxo retorna à etapa de seleção de cliente e veículo. Caso contrário, a OS é registrada com status “Aberta” e o processo é encerrado.

3.3 Etapas do Fluxo de Atividade

•	 Início: Representa o ponto inicial do processo.
•	 Seleciona cliente e veículo: O usuário escolhe os dados necessários para vincular o serviço.
• 	Preenche dados da OS: O sistema permite registrar informações gerais sobre o atendimento.
• 	Adiciona serviços e peças: O usuário descreve os serviços realizados e os componentes utilizados.
• 	Salvar OS? : Decisão condicional em que o usuário confirma ou cancela o registro.
• 	Sim → Fim: Caso a OS seja salva, o sistema encerra o processo com sucesso.
• 	Não → Retorna à seleção: Caso contrário, o fluxo volta à etapa inicial de seleção de cliente e veículo.


4. CRONOGRAMA DE TAREFAS
*S= semana
Etapa	S1	S2	S3	S4	S5	S6	S7	S8
Levantamento de Requisitos	X							
Análise	X	X						
Projeto			X					
Desenvolvimento			X	X	X	X		
Testes			X	X	X	X	X	
Implantação								X


	
	
	
	
	
	
	
	
	

















4.1  CRONOGRAMA DE TAREFAS DETALHADO

Semana	Atividade
1ª	Definição do escopo do sistema e levantamento dos requisitos funcionais e não funcionais.
2ª	Modelagem dos dados e elaboração dos diagramas (casos de uso, ER e atividade).
3ª	Desenvolvimento do backend utilizando o framework Laravel.
4ª	Desenvolvimento do frontend com HTML, CSS e JavaScript, aplicando design responsivo.
5ª	Integração entre as camadas frontend e backend, com testes de comunicação entre módulos.
6ª	Execução de testes funcionais, correção de falhas e refinamento das funcionalidades.
7ª	Implementação dos relatórios e emissão do termo de garantia em formato PDF.
8ª	Elaboração da documentação final e disponibilização do sistema para entrega.



5. FERRAMENTAS E TECNOLOGIAS
A seguir, são apresentadas as ferramentas e tecnologias previstas para o desenvolvimento do sistema, conforme os requisitos não funcionais estabelecidos:
5.1 Backend
•	Linguagem de programação: PHP
•	Framework: Laravel
•	Ambiente de desenvolvimento: XAMPP
5.2 Banco de Dados
•	Sistema gerenciador: MySQL
•	Interface de administração: phpMyAdmin
5.3 Frontend
•	Linguagens: HTML, CSS e JavaScript
•	Design: Responsivo e acessível
5.4 Relatórios e Documentos
•	Emissão de documentos em PDF
5.5 Segurança
•	Autenticação de usuários com login e senha
•	Criptografia de senhas
5.6 Controle de Versão
•	Ferramenta: Git
•	Repositório remoto: GitHub
5.7 Compatibilidade
•	Navegadores suportados: Google Chrome e Mozilla Firefox
•	Acesso multiplataforma: qualquer dispositivo com conexão à internet











<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

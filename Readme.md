# Todo list app

## Instação
### Necessário ter instalado na máquina
 - ### Docker

### Clone o projeto
```git clone https://github.com/Tonybrh/cubo-challenge```
### Em seguida rode o comando abaixo para subir a aplicação
```docker compose up -d --build```

### O docker vai se encarregar de subir o container do nginx rotando o laravel na porta 8081,  subir o container do banco (postgres), rodar os comandos necessários para executar as migrations e instalar as dependencias necessárias para o projeto além de subir o container do react expondo a porta __3000__

### O projeto foi feito aplicando boas práticas de programação   e seguindo conceitos como o YAGNI e DRY além do SOLID, foi aplicado um DDD(Domain Driven Design) para a organização do projeto.

```yaml
app
├── Domain // Camada de abstrações do negócio
│   ├── Dto
│   │   ├── CreatedCommentResponseDto.php
│   │   ├── CreatedTaskResponseDto.php
│   │   ├── UpdatedTaskResponseDto.php
│   │   └── UserLoggedResponseDto.php
│   ├── Exception
│   │   ├── UnauthenticatedHandler.php
│   │   └── UnauthorizedException.php
│   ├── Models
│   │   ├── Comment.php
│   │   ├── Task.php
│   │   ├── TaskStatus.php
│   │   └── User.php
│   ├── Policies
│   │   └── TaskPolicy.php
│   ├── Repository
│   │   ├── CommentRepositoryInterface.php
│   │   └── TaskRepositoryInterface.php
│   └── Service
│       ├── Comment
│       ├── CreateUserServiceInterface.php
│       ├── LoginUserServiceInterface.php
│       └── Task
├── Http // Camada de apresentação
│   ├── Action
│   │   ├── Comment
│   │   ├── Task
│   │   └── User
│   ├── Kernel.php
│   └── Request
│       ├── Comment
│       ├── Task
│       └── User
├── Infrastructure // Conexão com serviços externos e implementação do negócio
│   ├── Repository
│   │   ├── CommentRepository.php
│   │   └── TaskRepository.php
│   └── Service
│       ├── Comment
│       ├── Task
│       └── User
└── Providers
    ├── AppServiceProvider.php
    ├── AuthServiceProvider.php
    ├── CommentServiceProvider.php
    ├── TaskServiceProvider.php
    └── UserServiceProvider.php
```

### Todas as rotas de Criação Edição e busca estão protegidas por autenticação, para isso é necessário criar um usuário e fazer login para obter o token de autenticação.

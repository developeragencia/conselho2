# Conselhos Esotéricos - Portal PHP

Portal completo de consultas esotéricas desenvolvido em PHP puro.

## Tecnologias

- PHP 8.0+
- MySQL/SQLite
- HTML5, CSS3, Tailwind CSS
- JavaScript (Vanilla)

## Instalação

1. Configure o banco de dados no arquivo `config/database.php` ou use SQLite (automático)
2. Certifique-se de que o Apache/Nginx está configurado com mod_rewrite
3. Acesse o projeto no navegador

## Estrutura

```
/
├── index.php              # Entrada principal
├── config/                # Configurações
│   ├── database.php      # Banco de dados automático
│   └── autoload.php      # Autoloader
├── classes/               # Classes PHP
│   └── Router.php        # Sistema de roteamento
├── controllers/           # Controllers
│   ├── PageController.php
│   └── ApiController.php
├── views/                 # Views PHP
│   ├── layout/
│   ├── home.php
│   ├── consultores.php
│   └── ...
└── .htaccess             # Configuração Apache
```

## Funcionalidades

- Sistema de consultores
- API REST completa
- Banco de dados automático
- Sistema de autenticação
- Layout responsivo

## Licença

MIT

# Avaliação de filmes

# Sobre o projeto


É uma aplicação full stack web que consiste em: Login e logout por parte dos usuários cadastrados, cadastro de novos usuários, inserção de filmes a serem exibidos no catálogo, atribuição de críticas sobre os títulos adicionados e edição dos filmes adicionados.

#Requisitos para executar o projeto.

# Tecnologias utilizadas
## Back end
- Php

## Front end
- HTML5 / CSS3
  
# Dependencias
## Instalar o Xampp
- Instalar o PHP e suas extensões no Vscode.
- Iniciar Servidor Apache e MySQL.
- Ativar extensão - Extension:GB no php.ini.

# Projeto de Avaliação e Catálogo de Filmes

Este projeto é um sistema de avaliação e catálogo de filmes, similar ao IMDB, onde os usuários podem se cadastrar, deixar avaliações, ler críticas e visualizar a avaliação geral de cada filme.

## Funcionalidades

- **Registro de Usuário**: Permite que novos usuários se registrem usando um email e uma senha.
- **Login e Autenticação**: Usuários registrados podem fazer login com suas credenciais.
- **Avaliação de Filmes**: Usuários podem avaliar filmes com uma nota de 1 a 10 estrelas.
- **Escrever Críticas**: Usuários podem escrever críticas detalhadas sobre os filmes.
- **Adição e Edição de Filmes**: Usuários podem adicionar novos filmes ao catálogo e editar informações de filmes existentes.
- **Visualização de Avaliações**: Os usuários podem ver as avaliações e críticas de outros usuários.

## Requisitos

- **XAMPP**: Inclui Apache e MySQL.
- **PHP**: Para o backend.
- **Navegador Web**: Para acessar a interface do site.

## Instalação

### Passo 1: Baixar e Instalar o XAMPP

1. **Download**: Baixe o XAMPP do site oficial: [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html).
2. **Instalação**: Siga as instruções de instalação, selecionando os componentes Apache e MySQL.

### Passo 2: Configurar o Servidor Web (Apache)

1. **Localização dos Arquivos**: Coloque os arquivos do projeto na pasta `htdocs` do XAMPP, geralmente localizada em `C:\xampp\htdocs`.
2. **Configuração do Apache**:
- Abra o arquivo `httpd.conf` (geralmente encontrado em `C:\xampp\apache\conf`).
- Certifique-se de que as portas 80 (HTTP) e 443 (HTTPS) estão configuradas corretamente.
- Para habilitar HTTPS, você pode seguir um guia como [este](https://httpd.apache.org/docs/2.4/ssl/ssl_howto.html).

### Passo 3: Configurar o Banco de Dados (MySQL)

1. **Iniciar MySQL**: Abra o painel de controle do XAMPP e inicie o MySQL.
2. **phpMyAdmin**: Acesse o phpMyAdmin (geralmente em `http://localhost/phpmyadmin`).
3. **Criar Banco de Dados**:
- Crie um banco de dados chamado `projetofinal`.
- Importe o arquivo SQL fornecido (`projetofinal.sql`) para criar as tabelas necessárias (`users`, `movies`, `reviews`).

### Passo 4: Configuração do Projeto PHP

1. **Configuração de Conexão ao Banco de Dados**: Edite o arquivo de configuração PHP para conectar ao banco de dados MySQL.

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projetofinal";

// Cria conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

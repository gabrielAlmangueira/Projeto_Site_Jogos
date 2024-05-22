# Avaliação de filmes

# Sobre o projeto


É uma aplicação full stack web que consiste em: Login e logout por parte dos usuários cadastrados, cadastro de novos usuários, inserção de filmes a serem exibidos no catálogo, atribuição de críticas sobre os títulos adicionados e edição dos filmes adicionados.

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

# Iniciando o Projeto com Apache e MySQL

## Passo 2: Iniciar o Apache e MySQL com XAMPP

**Abrir o XAMPP**:
   - Execute o XAMPP Control Panel no seu computador.

**Iniciar o Apache**:
   - No painel de controle do XAMPP, encontre o módulo "Apache".
   - Clique no botão "Start" ao lado do Apache para iniciar o servidor web.

**Iniciar o MySQL**:
   - No painel de controle do XAMPP, encontre o módulo "MySQL".
   - Clique no botão "Start" ao lado do MySQL para iniciar o banco de dados.

Verificar a Execução

**Verificar o Apache**:
   - Abra um navegador web.
   - Digite `http://localhost` na barra de endereços e pressione Enter.
   - Se o Apache estiver funcionando corretamente, você verá a página inicial do XAMPP.

 **Verificar o MySQL**:
   - Abra um navegador web.
   - Digite `http://localhost/phpmyadmin` na barra de endereços e pressione Enter.
   - Se o MySQL estiver funcionando corretamente, você verá a interface do phpMyAdmin.

## Passo 3: Acessar o Projeto

**Navegar até a Pasta do Projeto**:
   - Coloque os arquivos do seu projeto na pasta `htdocs` do XAMPP, geralmente localizada em `C:\xampp\htdocs\meu_projeto`.

**Acessar o Projeto no Navegador**:
   - Abra um navegador web.
   - Digite `http://localhost/meu_projeto` na barra de endereços e pressione Enter.
   - Você deve ver a página inicial do seu projeto.

## Passo 4: Conectar ao Banco de Dados

**Configurar a Conexão ao Banco de Dados**:
   - Certifique-se de que seu arquivo de configuração PHP (`config.php` ou similar) está configurado corretamente para conectar ao banco de dados MySQL.


### Passo 5: Configurar o Servidor Web (Apache)

1. **Localização dos Arquivos**: Coloque os arquivos do projeto na pasta `htdocs` do XAMPP, geralmente localizada em `C:\xampp\htdocs`.
2. **Configuração do Apache**:
- Abra o arquivo `httpd.conf` (geralmente encontrado em `C:\xampp\apache\conf`).
- Certifique-se de que as portas 80 (HTTP) e 443 (HTTPS) estão configuradas corretamente.
- Para habilitar HTTPS, você pode seguir um guia como [este](https://httpd.apache.org/docs/2.4/ssl/ssl_howto.html).

### Passo 6: Configurar o Banco de Dados (MySQL)

1. **Iniciar MySQL**: Abra o painel de controle do XAMPP e inicie o MySQL.
2. **phpMyAdmin**: Acesse o phpMyAdmin (geralmente em `http://localhost/phpmyadmin`).
3. **Criar Banco de Dados**:
- Crie um banco de dados chamado `projetofinal`.
- Importe o arquivo SQL fornecido (`projetofinal.sql`) para criar as tabelas necessárias (`users`, `movies`, `reviews`).


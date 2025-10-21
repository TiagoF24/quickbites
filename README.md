# QuickBites 🍽️

<p align="center">
  <img src="public/template/img/logos/logo2.png" width="300" alt="QuickBites Logo">
</p>

<h1 align="center">QuickBites</h1>
<p align="center">🍽️ Cook. Publish. Share. Comment. Uma plataforma social de receitas construída com Laravel.</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/status-em%20desenvolvimento-orange" alt="Status do Projeto"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-Framework-red" alt="Laravel"></a>
  <a href="LICENSE"><img src="https://img.shields.io/github/license/TiagoF24/quickbites" alt="Licença"></a>
</p>

---

## 🚀 Sobre o Projeto

**QuickBites** é uma plataforma social voltada para apaixonados por culinária. Usuários podem compartilhar suas receitas, explorar pratos de outros membros, comentar, curtir e se conectar em uma comunidade rica em sabores.

Construído com **Laravel**, o projeto foca em performance, experiência do usuário e código limpo.

> Projeto desenvolvido em parceria com o **SENA**.

---

## 🤝 Parcerias Estratégicas

O QuickBites colabora com algumas das maiores marcas da indústria alimentícia para trazer receitas exclusivas, experiências temáticas e conteúdos especiais para nossos usuários.

<p align="center">
  <a href="https://www.mcdonalds.com/" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/36/McDonald%27s_Golden_Arches.svg/250px-McDonald%27s_Golden_Arches.svg.png" alt="McDonald's" width="90">
  </a>
  &nbsp;&nbsp;
  <a href="https://www.subway.com/" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Subway_2016_logo.svg/330px-Subway_2016_logo.svg.png" alt="Subway" width="100">
  </a>
  &nbsp;&nbsp;
  <a href="https://www.nestle.com/" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/pt/thumb/1/1f/Nestl%C3%A9_logo.svg/250px-Nestl%C3%A9_logo.svg.png" alt="Nestlé" width="100">
  </a>
  &nbsp;&nbsp;
  <a href="https://www.outback.com/" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/pt/2/27/Outback_Steakhouse.png" alt="Outback Steakhouse" width="100">
  </a>
  &nbsp;&nbsp;
  <a href="https://www.starbucks.com/" target="_blank">
    <img src="https://upload.wikimedia.org/wikipedia/sco/thumb/d/d3/Starbucks_Corporation_Logo_2011.svg/512px-Starbucks_Corporation_Logo_2011.svg.png" alt="Starbucks" width="80">
  </a>
</p>

### 🍔 Receitas em Destaque

- **McDonald's®** – Crie versões caseiras de clássicos como Big Mac e McChicken  
- **Subway®** – Monte seu sanduíche ideal com os ingredientes mais pedidos  
- **Nestlé®** – Dicas e receitas com produtos da linha Nestlé  
- **Outback Steakhouse®** – Pratos temáticos e receitas inspiradas no menu  
- **Starbucks®** – Bebidas famosas para preparar em casa

> 💼 Quer ser nosso parceiro? Entre em contato via [parcerias@quickbites.com](mailto:parcerias@quickbites.com)

---

## 🛠️ Tecnologias Utilizadas

- ⚙️ **Laravel** — Backend robusto e moderno  
- 💾 **MySQL / PostgreSQL** — Gerenciamento de dados eficiente  
- 🎨 **Blade / Bootstrap / Tailwind CSS** — Interface responsiva e amigável  

---

## 📸 Funcionalidades

- ✅ Cadastro e autenticação de usuários  
- ✅ Publicação de receitas com imagens, ingredientes e modo de preparo  
- ✅ Comentários e interações sociais  
- ✅ Sistema de busca por nome, ingredientes e categorias  
- ✅ Perfil do usuário com gerenciamento de receitas

---

## 📦 Instalação Local

Para rodar o projeto localmente, siga os passos abaixo:

```bash
# Clone o repositório
git clone https://github.com/TiagoF24/quickbites.git
cd quickbites

# Instale as dependências PHP
composer install

# Copie o arquivo de ambiente e gere a key da aplicação
cp .env.example .env
php artisan key:generate

# Configure as credenciais do banco de dados no arquivo .env

# Execute as migrações
php artisan migrate

# Inicie o servidor local
php artisan serve

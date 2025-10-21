# 🍽️ QuickBites — Sua Comunidade Gastronômica

<p align="center">
  <img src="public/template/img/logos/logo2.png" width="280" alt="QuickBites Logo">
</p>

<p align="center">
  <strong>Cook. Publish. Share. Comment.</strong><br>
  Uma plataforma social de receitas construída com Laravel.
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/status-em%20desenvolvimento-orange" alt="Status"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-Framework-red" alt="Laravel"></a>
  <a href="LICENSE"><img src="https://img.shields.io/github/license/TiagoF24/quickbites" alt="Licença"></a>
</p>

---

## 🚀 Visão Geral

O **QuickBites** é mais do que apenas um site de receitas — é uma comunidade viva onde amantes da culinária podem:

- Compartilhar suas criações gastronômicas 🍝  
- Interagir com outros cozinheiros 🍷  
- Descobrir pratos incríveis ao redor do mundo 🌍  

Projetado com **Laravel** no backend e um frontend elegante e responsivo com **Blade**, **Bootstrap** e **Tailwind CSS**.

> 🔗 Projeto desenvolvido em parceria com o **SENA**.

---

## 🤝 Parcerias Oficiais

Estamos orgulhosos de contar com o apoio de grandes marcas da indústria alimentícia:

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

- **McDonald's®** — recrie clássicos como Big Mac e Egg McMuffin  
- **Subway®** — monte seu sanduíche personalizado  
- **Nestlé®** — sobremesas com ingredientes da marca  
- **Outback®** — pratos temáticos e versões caseiras  
- **Starbucks®** — bebidas frias e quentes para fazer em casa  

> 💼 Deseja se tornar parceiro? Entre em contato via [parcerias@quickbites.com](mailto:parcerias@quickbites.com)

---

## 🛠️ Tecnologias Utilizadas

| Tecnologia        | Descrição                         |
|-------------------|----------------------------------|
| Laravel           | Backend moderno e robusto         |
| MySQL/PostgreSQL  | Banco de dados relacional         |
| Blade             | Engine de templates do Laravel    |
| Bootstrap/Tailwind| Estilização e responsividade      |
| PHP               | Lógica do servidor                |
| JavaScript        | Funcionalidades interativas       |

---

## 📸 Funcionalidades

- 👥 Cadastro e login de usuários  
- 📷 Publicação de receitas com imagens e descrições  
- 💬 Comentários e curtidas em receitas  
- 🔍 Busca por nome, ingredientes ou categorias  
- 👤 Perfil do usuário com suas receitas favoritas  
- 🛡️ Painel administrativo para moderação  

---

## 📦 Instalação Local

Para rodar o projeto localmente, siga os passos abaixo:

```bash
# Clone o repositório
git clone https://github.com/TiagoF24/quickbites.git
cd quickbites

# Instale as dependências PHP
composer install

# Copie o arquivo de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Configure seu banco de dados no arquivo .env

# Execute as migrações
php artisan migrate

# Inicie o servidor local
php artisan serve


## 🎮 Como Usar

- Crie uma conta gratuitamente  
- Explore receitas por categoria ou ingredientes  
- Publique suas próprias receitas com imagem, ingredientes e instruções  
- Interaja com outras pessoas através de comentários e curtidas  
- Gerencie seu perfil e salve suas receitas favoritas  

---

## 🖼️ Screenshots

*(Adicione suas imagens reais no diretório `screenshots/` e substitua os exemplos abaixo)*

<p align="center">
  <img src="screenshots/home.png" width="600" alt="Tela Inicial"><br>
  <em>🏠 Página inicial com receitas em destaque</em>
</p>

<p align="center">
  <img src="screenshots/recipe.png" width="600" alt="Página da Receita"><br>
  <em>📖 Detalhes de uma receita com imagem, preparo e comentários</em>
</p>

---

## 🗺️ Roadmap

- Autenticação de usuários  
- Sistema de publicação de receitas  
- Upload de imagem para receitas  
- Comentários e interações  
- Modo escuro 🌙  
- Notificações por e-mail 📬  
- Sistema de seguidores 👥  
- Aplicativo mobile com Flutter 📱  

---

## ❓ FAQ

1. **Preciso me cadastrar para ver receitas?**  
   Não. Qualquer visitante pode navegar, mas para interagir é necessário ter uma conta.

2. **Posso publicar receitas com vídeo?**  
   Em breve! Essa funcionalidade está no nosso roadmap.

3. **O QuickBites é gratuito?**  
   Sim. Todos os recursos atuais são gratuitos.

---

## 🤝 Como Contribuir

Quer colaborar com o projeto? É simples:

```bash
# Faça um fork
git clone https://github.com/seuusuario/quickbites.git

# Crie uma nova branch
git checkout -b minha-feature

# Faça suas alterações
git commit -m "feat: nova funcionalidade"

# Envie para o repositório remoto
git push origin minha-feature

# Abra um Pull Request 🚀

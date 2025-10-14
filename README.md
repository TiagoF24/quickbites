<p align="center">
  <img src="template/img/favicon.png" width="300" alt="Laravel Logo">
</p>

<h1 align="center">QuickBites</h1>
<p align="center">🍽️ Cook. Publish. Share. Comment. A social recipe platform built with Laravel.</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/status-in%20development-orange" alt="Project Status"></a>
  <a href="#"><img src="https://img.shields.io/badge/Laravel-Framework-red" alt="Laravel"></a>
  <a href="LICENSE"><img src="https://img.shields.io/github/license/seuusuario/quickbites" alt="License"></a>
</p>

---

## 🚀 Sobre o Projeto

**QuickBites** é uma plataforma social para entusiastas da culinária. Permite que usuários publiquem receitas, compartilhem ideias, comentem e descubram novos pratos em uma comunidade engajada.

Desenvolvido com **Laravel**, com foco em performance, usabilidade e uma arquitetura limpa.

> Projeto realizado em parceria com o **SENA**.

---

## 🛠️ Tecnologias

- ⚙️ **Laravel** — Backend e lógica de aplicação  
- 💾 **MySQL/PostgreSQL** — Persistência de dados  
- 🎨 **Blade / Tailwind CSS** — Frontend elegante e responsivo  
- 🛡️ **Sanctum / Passport** — Autenticação segura  
- 🔁 **API RESTful** — Integração com frontend ou mobile (opcional)

---

## 📸 Funcionalidades

- Cadastro e login de usuários
- Publicação de receitas com imagem, descrição e ingredientes
- Comentários e interações sociais
- Sistema de busca por categorias e ingredientes
- Área do usuário para gerenciar receitas

---

## 📦 Instalação

Clone o projeto e instale as dependências:

```bash
git clone https://github.com/seuusuario/quickbites.git
cd quickbites

composer install
cp .env.example .env
php artisan key:generate

# Configure o banco de dados no .env, então:
php artisan migrate
php artisan serve

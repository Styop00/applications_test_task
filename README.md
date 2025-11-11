# Applications Test Task

This repository contains two separate projects:

- **Backend:** `applications-test-task-backend` — built with **Laravel 12**
- **Frontend:** `applications-test-task-frontend` — built with **Nuxt 4**

---

## 🛠️ Requirements

Make sure you have the following installed:

- **PHP 8.2+**
- **Composer**
- **Node.js 22+** and **npm** or **yarn**
- **MySQL**
- **Git**

---

## ⚙️ Backend Setup (Laravel 12)

```bash
# Go to backend folder
cd applications-test-task-backend

# Copy environment file
# Set database connections in .env
cp .env.example .env

# Install PHP dependencies
composer install

# Generate application key
php artisan key:generate

# Configure your .env file
# Make sure to set your database credentials and APP_URL properly

# Run migrations (and optionally seed data)
php artisan migrate --seed

# Start local server
php artisan serve


# Go to frontend folder
cd ../applications-test-task-frontend

# Install dependencies
npm install
# or
yarn install

# Copy environment file
cp .env.example .env

npm run dev
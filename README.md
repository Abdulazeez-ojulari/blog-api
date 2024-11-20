<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Blog and Posts API

This is a Laravel-based API for managing blogs and their posts. It includes features for CRUD operations on blogs and posts, as well as the ability to interact with posts via likes and comments. The API is designed to follow RESTful principles, with JSON responses for all operations.

---

## Features

1. **Blogs**:
   - View all blogs.
   - Create a new blog.
   - Fetch details of a specific blog (including its posts).
   - Update an existing blog.
   - Delete a blog.

2. **Posts**:
   - View all posts under a specific blog.
   - Create a new post under a blog.
   - Fetch details of a specific post (including likes and comments).
   - Update an existing post.
   - Delete a post.

3. **Interactions**:
   - Like a post.
   - Comment on a post.

4. **Token-Based Middleware**:
   - All routes are protected by a token middleware. The token value is `vg@123`.

5. **Validation**:
   - Input validations are implemented, with JSON error responses for invalid data or resource not found.

---

## Requirements

- PHP 8.1 or higher
- Composer
- PostgreSQL
- Laravel 11.x
- Postman or an API testing tool

---

## Installation and Setup

### 1. Clone the Repository
```
git clone <repository_url>
cd <repository_folder>
```

### 2. Install Dependencies

```
composer install
```

### 3. Set Up Environment Variables
- Copy the .env.example file to create a .env file:

``` 
cp .env.example .env
```
- Update the .env file with your database and application details:
```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
APP_KEY=base64:your_generated_key
```

### 4. Generate Application Key
```
php artisan key:generate
```
### 5. Run Database Migrations
```
php artisan migrate
```
### 6. Seed the Database
```
php artisan db:seed
```
### 7. Start the Application
```
php artisan serve
```
The application will run on http://localhost:8000.


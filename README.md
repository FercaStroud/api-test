# Library API

This project is a Laravel-based API for managing a library system. It includes authentication using both JWT and Laravel Sanctum.

## Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL
- Node.js and npm (optional, for front-end assets)

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/your-username/library-api.git
   cd library-api
    ```
2. **Install PHP dependencies:**

   ```bash
   composer install
    ```

3. **Create a copy of the .env file:**

   ```dotenv
    APP_NAME=Laravel
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=api_test_db
    DB_USERNAME=root
    DB_PASSWORD=secret
   ```

4. **Install PHP dependencies:**

   ```bash
   php artisan key:generate
    ```

5. **Run the database migrations:**

   ```bash
   php artisan migrate
    ```

6. **Install JWT package and generate secret key:**

   ```bash
    composer require tymon/jwt-auth
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    php artisan jwt:secret
   ```

7. **Install Laravel Sanctum:**

   ```bash
    composer require laravel/sanctum
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    php artisan migrate
   ```
   
## **Running the Project**
```bash
    php artisan serve
```
Using Insomnia for API Testing:

Open Insomnia.
Go to Import/Export in the Insomnia menu.
Select Import Data and then From File.
Choose the insomnia_export.json


## **API Endpoints**
1. Authentication with JWT
    - Register: 
      - POST /api/auth-jwt/register

    - Login: 
      - POST /api/auth-jwt/login

      - Logout: 
        - POST /api/auth-jwt/logout

      - Refresh Token:
        - POST /api/auth-jwt/refresh

      - Get Authenticated User: 
        - POST /api/auth-jwt/me


2. Authentication with Sanctum

   - Login: 
     - POST /api/login
   
   - Logout: 
     - POST /api/logout
   - User Management (Requires Authentication)
     - Create User: 
       - POST /api/users
       - Get Users: GET /api/users
     - Book Management (Requires Authentication)
       - Create Book: POST /api/books
       - Get Books: GET /api/books
     
   - Category Management (Requires Authentication)
     - Create Category: 
       - POST /api/categories
       - Get Categories: GET /api/categories


## Running Tests
```bash
    php artisan test
```


Made by, Fernando Cárdenas. (Ferca)

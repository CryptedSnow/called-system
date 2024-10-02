<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Attention!

Follow the steps to set the application on your local machine.

Step N°1 - Run the following commands below to install the dependencies (Verify the existence of `Composer`, `Node` and `NPM` on your machine).

```
composer install 
cp .env.example .env 
php artisan cache:clear 
composer dump-autoload 
php artisan key:generate
```

Step N°2 - In `.env` file set the following snippet to connect the application to your database (Verify your database, it is necessary create a database to create the migrations).
```
# MySQL
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=name_database
DB_USERNAME=root
DB_PASSWORD=

# PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=name_database
DB_USERNAME=postgres
DB_PASSWORD=
```

Step N°3 - Execute the migrations.

```
php artisan migrate
```

Step N°4 - Use the commands to create some populated tables to some selection fields at forms (and users table).

```
php artisan db:seed
```

Step N°5 - View the migrations been dones e verify status them.
```
php artisan migrate:status
```

Step N°6 - Run the following command to install `Vite`.
```
npm install
```

Step N°7 - You need decide an option to start the `Vite`.
```
# Run Vite to server development
npm run dev
 
# Create and version assets for production... (I usually choose this on my local machine)
npm run build
```

Step N°8 - Run the following command to start Apache to run the application.
```
php artisan serve
```

With help of [Laravel Spatie](https://spatie.be/docs/laravel-permission/v5/introduction), exist two roles user: **Admin** and **User**. Making certains roles user has more privileges than others, it is very important you run the seeds to those users be created.

* Nome: Mario
```
Email: mario@world.com
Password: 12345678
Role: Admin, User
Permission: NULL
```

* Nome: Luigi
```
Email: luigi@world.com
Password: 12345678
Role: User
Permission: NULL
```

Some functionality are exclusives to **Admin**, others types of roles has not the same privileges.

### Packages to study (They are used in this application)

- **[Laravel Spatie](https://spatie.be/docs/laravel-permission/v5/introduction)**
- **[LogViewer](https://github.com/ARCANEDEV/LogViewer)**
- **[laravel-pt-BR-localization](https://github.com/lucascudo/laravel-pt-BR-localization)**
- **[pt-br-validator](https://github.com/LaravelLegends/pt-br-validator)**
- **[sweetalert2](https://sweetalert2.github.io/)**
- **[laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)**
- **[maatwebsite/excel](https://packagist.org/packages/maatwebsite/excel)**
- **[Laravel UI Auth](https://www.laravelia.com/post/laravel-9-auth-laravel-9-authentication-example)**

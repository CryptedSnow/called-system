<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Attention!

Follow the steps to set up the application on your local machine.

1 - Run the following commands below to install the dependencies (Before, check the existence of `Composer` on your machine).

```
composer install 
cp .env.example .env 
php artisan cache:clear 
composer dump-autoload 
php artisan key:generate
```

2 - In `.env` file set the following snippet to connect the application to your database (Check your database, it is necessary create a database to run the migrations).
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

3 - Execute the migrations.

```
php artisan migrate
```

4 - Use the commands to create registers to some tables.

```
php artisan db:seed
```

5 - View the migrations been dones and check status them.
```
php artisan migrate:status
```

6 - Run the following command to install `Vite` (Before, check the existence of `Node` and `NPM` on your machine).
```
npm install
```

7 - You need decide an option to start the `Vite`.
```
# Run Vite to server development
npm run dev
 
# Create and version assets for production... (I usually choose this on my local machine)
npm run build
```

8 - Run the following command to start Apache to run the application.
```
php artisan serve
```

With help of [Laravel Spatie](https://spatie.be/docs/laravel-permission/v5/introduction), exist two roles user: **Admin** and **User**. Making certains roles user has more privileges than others, it is very important you run the seeds to those users be created.

* Name: Mario
```
Email: mario@world.com
Password: password
Role: Admin, User
Permission: Many permissions
Companies: Yoshi's island, Ghost House, Valley of Bowser
```

* Name: Luigi
```
Email: luigi@world.com
Password: password
Role: User
Permission: Many permissions
Companies: Ghost House
```

* Name: Bowser
```
Email: bowser@world.com
Password: password
Role: User
Permission: Many permissions
Companies: Valley of Bowser
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

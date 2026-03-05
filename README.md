<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Attention!

Follow the steps to set up the application on your local machine.

1 - Run the ```composer install``` command to create ```vendor``` folder.

```
composer install 
```

2 - Create ```.env``` file:
```
cp .env.example .env
```

3 - Generate crypted key (Fill ```APP_KEY=``` to ```.env``` file):
```
php artisan key:generate
```

4 - In `.env` file set the following snippet to connect the application to your database (Check your database, it is necessary create a database to run the migrations).
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

5 - Execute the migrations.

```
php artisan migrate
```

6 - Use the commands to create registers to some tables.

```
php artisan db:seed
```

7 - View the migrations been dones and check status them.
```
php artisan migrate:status
```

8 - Run the following command to install Javascript dependencies. (Before, check the existence of `Node` and `NPM` on your machine).
```
npm install
```

9 - Run the following command to compile and optimize JavaScript files.
```
# Run Vite to server development
npm run dev
 
# Create and version assets for production... (I usually choose this on your local machine)
npm run build
```

10 - Run the following command to start Apache to run the application.
```
php artisan serve
```

## Docker environment

Before run containers, you can choose PHP version of your preference (```8.0```,```8.1```,```8.2```,```8.3```,```8.4``` and ```8.5```). In ```docker-compose.yml``` to ```context```  change the version:

```
// Example: Change version to 8.0 
context: ./docker/version
```

1 - Power on the containers:
```
docker-compose up -d
```

2 - Run the ```composer install``` command to create ```vendor``` folder:
```
docker-compose exec app composer install
```

3 - Create ```.env``` file:
```
docker-compose exec app cp .env.example .env  
```

4 - Generate crypted key (Fill ```APP_KEY=``` to ```.env``` file):
```
docker-compose exec app php artisan key:generate
```

You can't maintain two databases working at same time, it's necessary choose.
```
# Avoid conflict to mysql phpmyadmin
docker-compose stop pgsql pgadmin

# Avoid conflict to pgsql pgadmin
docker-compose stop mysql phpmyadmin
```

Remember, before you change of database, run ```docker-compose down```, modify the ```.env``` file snippet to connect the application to database container and run ```docker-compose up -d``` again.

5 - In ```.env``` file set the following snippet to connect the application to database container from **Docker**:
```
# MySQL
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=called-system
DB_USERNAME=user
DB_PASSWORD=password

# PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=called-system
DB_USERNAME=postgres
DB_PASSWORD=secret
```

6 - To performate the migrations, you need use the command:
```
docker-compose exec app php artisan migrate
```

7 - Use the commands to perfomate the seeders:
```
docker-compose exec app php artisan db:seed
```

8 - View the migrations been dones and check status them.
```
docker-compose exec app php artisan migrate:status
```

9 - Run the following command to install Javascript dependencies.
```
docker-compose exec app npm install
```

10 - Run the following command to compile and optimize JavaScript files.
```
# Run Vite to server development
docker-compose exec app npm run dev

# Create and version assets for production... (I usually choose this on your local machine)
docker-compose exec app npm run build
```

11 - To power off the containers before exit from application, use the command:

```
docker-compose down
```

With help of [Laravel Spatie](https://spatie.be/docs/laravel-permission/v6/introduction), exist two roles user: **Admin** and **User**. Making certains roles user has more privileges than others, it is very important you run the seeds to those users be created.

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

### Docker environment addresses
- phpMyAdmin: http://localhost:8081
- pgAdmin: http://localhost:5050
    - User: `admin@admin.com`
    - Password: `admin`

### Packages to study (They are used in this application)

- **[Laravel Spatie](https://spatie.be/docs/laravel-permission/v6/introduction)**
- **[LogViewer](https://github.com/ARCANEDEV/LogViewer)**
- **[laravel-pt-BR-localization](https://github.com/lucascudo/laravel-pt-BR-localization)**
- **[pt-br-validator](https://github.com/LaravelLegends/pt-br-validator)**
- **[sweetalert2](https://sweetalert2.github.io/)**
- **[select2](https://select2.org/)**

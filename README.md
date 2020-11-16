# Laravel Starter
**Laravel Starter** is a Laravel 7.x based simple starter project. It can be used to build all type of applications. Most of the commonly needed features like Authentication, Application Backend, Backup, Logviewer are available here. It is modular, so you can use this project as a base and build your own modules. You can use the same module in any of the Laravel starter based projects. New features and functionalities are being added on a regular basis.

Please let me know your feedback and comments.


# Demo
Check the following demo project. It is just a straight installation of the project without any modification.

```
User: super@admin.com
Pass: 1234

User: user@user.com
Pass: 1234

```


## Custom Commands

### Clear All Cache

`composer clear-all`

this is a shortcut command clear all cache including config, route and more

### Code Style Fix

`composer fix-cs`

apply the code style fix by this command.


## Features

* Admin feature and public views are completely separated as `Backend` and `Frontend` namespace.
* Major feature are developed as `Modules`. Module like Posts, Comments are separated from the core features like User, Role, Permission


## Installation

Follow the steps mentioned below to install and run the project.

1. Clone or download the repository
2. Go to the project directory and run `composer install`
3. Create `.env` file by copying the `.env.example`. You may use the command to to that `cp .env.example .env`
4. Update the database name and credentials
5. Run the command `php artisan migrate -seed`
6. Link storage directory. `php artisan storage:link`
7. You may create a virtualhost entry to access the application or run `php artisan serve` and visit `http://127.0.0.1:8000`

### Set Module Permissions
1. Set Permissions for Posts, Categories, Tags: `php artisan article:create-permissions`
1. Set Permissions for Newsletter:  `php artisan newsletter:create-permissions`

*After creating the new permissions use the following commands to update cashed permissions.*

`php artisan cache:forget spatie.permission.cache`

### Seed Sample Data (Optional & should use only on testing)
1. Add sample data on Posts, Categories, Tags with the following command `php artisan article:create-sample-data`
1. Add sample data on Newsletter with the following command `php artisan newsletter:create-sample-data`

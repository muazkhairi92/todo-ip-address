## To-Do List[IP Address-based]

This is the repository for **To-Do List[IP Address-based]**.

## About this Repo

This project provides a simple yet interactive to-do list application with features to manage the list based on allowed IP address. It leverages Laravel for backend functionality and session management, with JavaScript to handle browser events. The included unit tests ensure that all core functionalities work as intended.


## Technologies

- Laravel 10.x
- PHP ^8
- Composer

## Setup

1. Download repository:

```
git clone https://github.com/muazkhairi92/agmo-todo.git
```

2. Please ensure you have install the correct version of PHP and Composer. If not configured, for PHP, please refer this: https://www.php.net/manual/en/install.php. And for Composer please refer this: https://getcomposer.org/doc/00-intro.md.

3. Installing Dependencies:

```
composer install
```

4. Create `.env` file. Copy `.ev.example` and rename it to `.env`.

5. In the `.env` fill up the `ALLOWED_IPS` with dsired allowed ip address separated with comas.

6. This project uses MySQL for its database. Please setup the database and feed the details in `.env`.

if you have configured your database, please run
```
php artisan migrate
```

7. To start server:

```
php artisan serve
```

use the url to use the to-do list!

8. To test all test:
r
```
php artisan test
```
9. Whitelist IP Address

You need to request from allowed IP Address to add new IP address


## Development

### Branch

To start development, create new branch from **staging** branch.

```
git checkout staging
git checkout -b feat/your-new-feature
```

### Pull Request

- Push your new feature to github
- Create PR and choose merge into **staging** branch

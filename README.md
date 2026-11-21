::: {align="center"}
# Admin Ecommerce

**Laravel-based E-commerce Administration Panel**

A backend-focused e-commerce administration project for managing
products, users, locations, catalog data, and store settings through a
protected admin dashboard.

[![PHP](https://img.shields.io/badge/PHP-8.3%2B-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![MySQL](https://img.shields.io/badge/Database-MySQL%2FMariaDB-4479A1?logo=mysql&logoColor=white)](https://www.mysql.com/)
:::

------------------------------------------------------------------------

## Overview

Admin Ecommerce is an e-commerce administration application built with
**PHP and Laravel 13**. It provides a protected admin area for managing
the main data and catalog resources of an online store.

The project focuses on backend functionality such as authentication,
authorization through an admin guard and middleware, CRUD operations,
request validation, database interactions, file uploads, and server-side
data tables.

> This repository contains the administration side and related
> application code. Storefront, checkout, payment, and order-processing
> capabilities are not documented here unless they are implemented and
> verified in the source code.

## Features

### Admin Authentication & Access Control

-   Dedicated admin login and logout using an admin authentication
    guard.
-   Protected admin routes using admin middleware.
-   Login request throttling.
-   Forgot-password and password-reset flow for administrators.
-   Password hashing before storing admin credentials.

### Dashboard Data Management

The admin area defines management routes for: - Administrators and
users. - Products and departments. - Countries, cities, and states. -
Trademarks and manufacturers. - Malls, shipping methods, colors, sizes,
and weights. - Store settings.

### Product Management

-   Product listing and editing.
-   Product data validation, including required fields, numeric values,
    dates, and product status.
-   Product image upload, update, and deletion.
-   Additional product file uploads and deletion.
-   Product duplication, including copying its main image and associated
    data.
-   Related-product and mall associations.
-   Dynamic size and weight loading based on the selected department.
-   Bulk product deletion.

### Data Tables

-   Yajra Laravel DataTables integration for admin listings.
-   Eloquent query-based table data.
-   Search and table controls.
-   CSV, Excel, and print export buttons where configured.

### Localization

-   Arabic and English language selection through the admin routes.
-   Translation-based interface labels.
-   Language-aware content fields for supported records.

## Tech Stack

  Technology                    Usage
  ----------------------------- -----------------------------------
  PHP 8.3+                      Backend programming language
  Laravel 13                    Web application framework
  MySQL / MariaDB               Relational database
  Blade                         Server-rendered views
  Yajra Laravel DataTables 13   Admin data tables
  Maatwebsite Excel 4           Excel-related functionality
  JavaScript / jQuery           Client-side interactions and AJAX
  Vite 8                        Frontend asset build tooling
  Tailwind CSS 4                Frontend styling dependency

## Project Requirements

Make sure the following tools are installed:

-   PHP **8.3 or newer**
-   Composer
-   Node.js and npm
-   MySQL or MariaDB
-   A web server or PHP's built-in development server

You can check your installed versions with:

``` bash
php -v
composer -V
node -v
npm -v
```

## Installation & Setup

### 1. Clone the repository

``` bash
git clone https://github.com/MohammedNader2006/Admin-Ecommerce-.git
cd Admin-Ecommerce-
```

### 2. Install PHP dependencies

``` bash
composer install
```

### 3. Configure the environment

Create your local environment file:

``` bash
cp .env.example .env
```

On Windows PowerShell, use:

``` powershell
Copy-Item .env.example .env
```

Generate the application key:

``` bash
php artisan key:generate
```

### 4. Configure the database

Create a database, for example `admin_ecommerce`, then update the
database settings in your `.env` file:

``` env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=admin_ecommerce
DB_USERNAME=root
DB_PASSWORD=
```

Use the credentials configured on your own machine. Do not commit your
`.env` file.

### 5. Run database migrations

``` bash
php artisan migrate
```

### 6. Install and build frontend dependencies

``` bash
npm install
npm run build
```

### 7. Start the development server

``` bash
php artisan serve
```

Open the local URL shown in the terminal, usually:

``` text
http://127.0.0.1:8000
```

The admin routes are grouped under the `/admin` prefix.

## Admin Access

There are **no default admin credentials documented in this
repository**.

Use an administrator account created through your own authorized local
setup. Do not publish real usernames, passwords, reset tokens, API keys,
or database credentials in this repository.

The admin login page is available at:

``` text
/admin/login
```

## Screenshots

Screenshots are not included yet. To document the interface, add your
own sanitized screenshots in a folder such as `docs/screenshots/`, then
embed them here.

For example:

``` md
![Admin Dashboard](docs/screenshots/admin-dashboard.png)
![Products Management](docs/screenshots/products-management.png)
![Product Edit](docs/screenshots/product-edit.png)
```

Avoid including personal data, real customer information, or credentials
in screenshots.

## Security Notes

-   Keep `.env` out of version control.
-   Use strong passwords for administrator accounts.
-   Configure production environment values securely.
-   Do not expose password-reset links, tokens, or database credentials.
-   Review authorization and validation rules before deploying the
    application publicly.

## Current Scope

This repository is an ongoing learning project. The README describes
functionality visible in the current source code; it does not claim that
unimplemented storefront, cart, checkout, payment, or order-management
features are available.

## Author

**Mohammed Nader**

-   GitHub: [@MohammedNader2006](https://github.com/MohammedNader2006)
-   Project Repository:
    [Admin-Ecommerce-](https://github.com/MohammedNader2006/Admin-Ecommerce-)

------------------------------------------------------------------------

If you find an issue or have a suggestion, feel free to open an issue in
the repository.

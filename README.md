# Laravel Test Project - Simple Inventory

## Overview

A Laravel-based product management app demonstrating CRUD operations, search functionality, pagination, and responsive design. Built to showcase my Laravel skills and ability to structure a web application.

## Features

-   Product CRUD (Create, Read, Update, Delete)
-   Dynamic search with query handling
-   Pagination
-   Bootstrap integration for responsive design
-   Blade templating with reusbale components

## Installations

1. Clone the repo:
    ```bash
     git clone https://github.com/irfan87/laravel_simple_inventory.git
     cd laravel_simple_inventory
    ```
2. Install dependencies
    ```bash
    composer install
    npm install
    npm run dev
    ```
3. Configure `.env` file and run migrations:
    ```bash
    php artisan migrate seed
    ```
4. Serve the app:
    ```bash
    php artisan serve
    ```

## Usage

-   Homepage: View product list with pagination.
-   Search: Search products by name and details.
-   Add / Edit: Manage products via forms.
-   View individual product: View product details by its ID.
-   Delete: Remove products from the list.

## Challenges

-   Dynamic query handling for search.
-   Integrating pagination with search results.
-   Blade template refactoring under time constraints.

## Lessons Learned

-   Efficient use of Blade templates for reusability.
-   Managing the complex queries and pagination in controllers.
-   Keeping code clean while meeting deadlines.

## Future Improvements

-   Add user authentication and authorization.
-   Implement unit tests (PHPUnit / Pest).
-   Refactor Blade templates for DRYness.
-   Improve UI/UX for better user experience.

## Contact

-   Name: Ahmad Irfan Mohammad Shukri
-   Email: irfanshukri203@gmail.com
-   Github: [irfan87](https://github.com/irfan87)

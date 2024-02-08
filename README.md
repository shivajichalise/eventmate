# Event Mate

_A laravel event management webapp._

This repository contains a Laravel application. Follow these steps to set it up and run it locally.

## Prerequisites

-   PHP (>= ^8.1)
-   Composer
-   MySQL or other compatible database

## Installation

1. Clone the repository:
    ```bash
    git clone git@github.com:shivajichalise/eventmate.git
    ```
2. Navigate to the project directory:

    ```bash
    cd eventmate/
    ```

3. Copy the .env.example file and rename it to .env:

    ```bash
    cp .env.example .env
    ```

4. Open the .env file and update the database credentials according to your local setup:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

5. NPM install
    ```bash
    npm install
    ```
6. Install Vite

    ```bash
    npm i -D vite laravel-vite-plugin
    ```

7. Run composer install
    ```bash
    composer install
    ```
8. Generate application key:
    ```bash
    php artisan key:generate
    ```
9. Run migrations to create the database schema:
    ```bash
    php artisan migrate:fresh --seed
    ```
10. Serve the application
    ```bash
    php artisan serve
    ```

## Usage

##### Access Routes

-   **Users Login:**  
    To access user login page, visit:

    ```
    http://localhost:8000/login
    ```

-   **Organizers Login:**  
    To access organizer login page, visit:
    ```
    http://localhost:8000/organizers/login
    ```

### Default Organizer Credentials

-   **Email:** organizer@eventmate.com
-   **Password:** password

## Contributing

We welcome contributions from the community! If you have an idea for a new feature or improvement, please submit a pull request. We also appreciate bug reports and other feedback.

To get started with contributing, simply fork this repository, make your changes, and submit a pull request.

## License

This project is licensed under [MIT](https://opensource.org/license/mit-0/)

## Self-Promotion

Star the repository on [Github](https://github.com/shivajichalise/eventmate)

Follow on [Github](https://github.com/shivajichalise)

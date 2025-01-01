# Shortify - URL Shortener

Shortify is a simple and efficient web application that allows users to shorten long URLs into more manageable and shareable links. With an intuitive user interface and seamless functionality, Shortify is designed to make the URL shortening process quick and hassle-free.

## Features

- Shorten long URLs into compact, shareable links.
- Automatically validate URLs to ensure they are correct and unique.
- Handle errors gracefully with user-friendly error messages.
- Provide users with a shortened URL that can be easily copied and shared.

## Tech Stack

- **Frontend**: HTML, CSS (TailwindCSS)
- **Backend**: Laravel 11 (PHP)
- **Database**: MySQL (or any database you configure for storing URLs)
- **AJAX**: Fetch API (for handling form submission asynchronously)

## Installation

### Prerequisites

1. PHP >= 8.1
2. Composer (for managing PHP dependencies)
3. Node.js and NPM (for frontend build and TailwindCSS)

### Steps to Set Up

1. Clone the repository to your local machine:

    ```bash
    git clone https://github.com/TazulBinYounus/shortify.git
    cd shortify
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Set up the environment file:

    ```bash
    cp .env.example .env
    ```

4. Generate the application key:

    ```bash
    php artisan key:generate
    ```

5. Set up your database configuration in the `.env` file. Ensure you have a MySQL database running and the correct credentials are set.

6. Run database migrations:

    ```bash
    php artisan migrate
    ```

7. Install Node.js dependencies (for frontend):

    ```bash
    npm install
    ```

8. Build the frontend assets:

    ```bash
    npm run dev
    ```


9. Run Unit Test:

    ```bash
    php artisan text
    ```

10. Start the Laravel development server:

  ```bash
  php artisan serve
  ```

11. Your application should now be accessible at `http://localhost:8000`.

## Usage

1. Open the app in your browser.
2. Enter a URL in the input field.
3. Click on "Generate Short URL".
4. If the URL is valid and not already taken, a shortened URL will be generated and displayed.
5. Copy and share the shortened URL as needed.

## Validation

The app uses Laravel's built-in validation to ensure that:

- The URL is required.
- The URL is valid.
- The URL is unique (to prevent duplicate entries).

If any of these validations fail, an error message will be displayed.

## Error Handling

If any errors occur (such as a database issue or invalid input), a user-friendly error message will be shown.




## Usage

Install composer dependencies
```sh
composer install
```
Create .env file and generate key
```sh
cp .env.example .env
php artisan key:generate
```

Set up database and file driver variables
> Note: Use of 'local' or 'public' disk will required correct ownership and permission for '/storage' folder.

When using 'public' disk generate symbolic link by running
```sh
php artisan storage:link
```

Run database migrations
```sh
php artisan migrate
```

Use seeder to fill data for 'html_snippets' and 'links' table
```sh
php artisan db:seed
```

Start application
```sh
php artisan serve
```

Site will be available at `http://127.0.0.1:8000` or `http://localhost:8000`

Running Tests
```sh
php artisan test
```

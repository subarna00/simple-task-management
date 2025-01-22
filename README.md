## Task Management
------------------------------------------
This project helps to manage project tasks.

# System Requirements
    - PHP 8.3
    - Node v23.5.0
    - composer
    - mysql

# Technologies used
    - Laravel 11
    - Tailwindcss
    - jquery

# Project Setup
1. Clone project
    - git clone https://github.com/subarna00/simple-task-management.git

2. Open code editor and run commands
    - composer install
    - npm install
    - npm run dev

3. Setup ENV
    - copy .env.example file and rename to .env
    - update database credentials
    - php artisan key:generate (this command generates application key)

4. Create migration and seeder file
    - php artisan migrate --seed

5. Run application
    - php artisan serve

Now you can access you application in browser by the endpoint http://localhost:8000

# Simple Payment Documentation

## Overview
This document outlines the setup and structure of simple payment. This apps are using :
- Laravel 11 as main framework
- MySQL for database
- Laravel Passport for authentication
- Laravel Horizon for monitoring
- Redis for caching feature
- Queue for handle payment process
- Throttle limit for every endpoint with 100 request per 1 minute
- Unit Test and Stress Test for testing feature


## System Requirements
- PHP >= 8.2
- MySQL 5.7 or higher
- Redis 5.0 or higher
- Composer for dependency management

## Installation Steps

1. **Clone the Repository**

   Clone the project and move to project directory
   ```bash
   git clone https://github.com/codenameryuu/simple-payment-laravel.git
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment**
   
   Copy the `.env.example` file to `.env` and update the database and other configurations as necessary.
   ```bash
   cp .env.example .env
   ```

4. **Apply Config**
   ```bash
   php artisan config:cache
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Migrations and Seed the Database**
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Run Application**
   ```bash
   php artisan serve
   ```

8. **Run Queue Application**
   ```bash
   php artisan queue:listen
   ```

9. **Generate Personal Access Client**
   ```bash
   php artisan passport:client --personal
   ```

10. **Unit Test**
      ```bash
      php artisan test --testsuite=Unit
      ```

11. **Stess Test**
   
      This test will trigger Throttle limit for 1 minute so be careful with it.
      ```bash
      php artisan test --testsuite=Stress
      ```

## Postman Documentation
```bash
https://documenter.getpostman.com/view/14479523/2sA3XMk4Jy
```

## Contributing
Contributions to the Simple Payment project are welcome. Please ensure that your code adheres to the Laravel best practices and include tests for new features.

## License
This Simple Payment is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

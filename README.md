# Simple API Documentation

## Overview
This document outlines the setup and structure of simple api with laravel 11 and mysql.

## System Requirements
- PHP >= 8.2
- Laravel 11
- MySQL 5.7 or higher
- Composer for dependency management

## Installation Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/codenameryuu/simple-api-laravel-ft-mysql.git
   cd your-project
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

4. **Apply New Config**
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

## Postman Documentation
```bash
https://documenter.getpostman.com/view/14479523/2sA3JQ5fYk
```

## Contributing
Contributions to the Simple API project are welcome. Please ensure that your code adheres to the Laravel best practices and include tests for new features.

## License
This Simple API is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

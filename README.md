# Shopping List API
Shopping List is a simple project to manage shopping lists via API REST.
This is allow shopping list to be created, updated and deleted using request in JSON format and standard HTTP verbs.
Bellow, you can check the docs out and learn how to use.

## How to run?
1. Create a local database
```
CREATE DATABASE shopping_list;
```
2. 1 - Copy the env sample file
```
cp .env.example .env
```
2. 2 - Verify and update **Environment Variables** in your **.env**: 

- `DB_HOST`, `DB_PORT`, `DB_USERNAME` and `DB_PASSWORD`

3. Install all dependencies running
```
composer install
```
4. 1 - Run migration and seed.
```
php artisan migrate --seed
```
4. 2 - After Running it, a user will be created for using the app. Bellow, you will see the user credentials:

- `Email: contato@matheusmarzochi.com.br`
- `Password: password`

5. Run `php artisan serve` to start the server listening
6. Open at http://127.0.0.1:8000/


## Documentation
You can access the documentation on `http://127.0.0.1:8000/api/documentation`

## Technologies
**Language:** PHP

**Database:** MySQL

**Framework:** Laravel

## Testing
Run `php artisan test` to test application
> Important note; Before running tests, you will need to do the step 4.1 (migrate with seeder).

## Do you need a help?
Contact me: contato@matheusmarzochi.com.br
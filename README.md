## Technical Test

Installation instructions

- Clone the repository
- Create a copy of .env.example and rename it as .env
- Set the database constants on the .env file with these values:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```
Run the following commands on the terminal
```bash
composer install
./vendor/bin/sail up
```
In another terminal run the following steps to generate the private key, run the migrations (create the database tables) and seed the classrooms and timetables tables with the initial values.

```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh
./vendor/bin/sail artisan db:seed
```

The endpoints available are:
- GET: localhost/api/classes
- POST: localhost/api/classes/book
- DELETE: localhost/api/classes/{classId}/cancel

Please refer to Clearit.postman_collection.json to test them in Postman.
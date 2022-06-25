## HOW TO USE

THIS IS STEP BY STEP HOW TO USE THIS :

- run command ```composer install```.
- then create `.env` file with command ``` cp .env.example .env ```
- change value `DB_DATABASE` in `.env`
- then run command ``` php artisan migrate:refresh --seed ``` to generate table and also seeder fake data
- for running testing unit you can run command  ``` php artisan test ```
- run command `php artisan serve` to run on your local server
- for documentation API you can use this link 
  <a href="https://documenter.getpostman.com/view/13487797/UzBqqRZR">Postman</a> or <a href="https://app.swaggerhub.com/apis-docs/FadlyKnight/Kledo/1.0.1">Swagger</a>
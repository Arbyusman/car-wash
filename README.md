# simpelsp2d-konut
Perpustakaan TA

## Run Project
### clone the repositories

```
git clone https://github.com/Arbyusman/perpustakaan.git
```

### Setup Local Server, Database and Run Server

Install all the dependencies using composer

     composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Run the database migrations & seeders (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

    if you not using migration, import database on dir db to your local computer

Genrate Key

    php artisan key:generate


Start the local development server

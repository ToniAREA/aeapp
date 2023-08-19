#!/bin/bash

# Clean screen
clear

# Cambia al directorio del repositorio
cd ~/MEGA/MisWebs/AEAPPv5/aeapp

# Copy to *copy files...
echo "SAVING BEFORE SYNC. Copying .env to .env_copy"
cp  ./.env ./.env_copy

echo "Copying README.md to README_copy.md"
cp  ./README.md ./README_copy.md

echo "Copying config/database.php to config/database_copy.php"
cp  ./config/database.php ./config/database_copy.php

echo "Copying config/filesystems.php to config/filesystems_copy.php"
cp  ./config/filesystems.php ./config/filesystems_copy.php

echo "Copying lang/en/crud.php to lang/en/crud_copy.php"
cp  ./resources/lang/en/crud.php ./resources/lang/en/crud_copy.php

echo "Copying database/seeders/UsersTableSeeder.php to database/seeders/UsersTableSeeder_copy.php"
cp  ./database/seeders/UsersTableSeeder.php ./database/seeders/UsersTableSeeder_copy.php

echo "Copying database/seeders/DatabaseSeeder.php to database/seeders/DatabaseSeeder_copy.php"
cp  ./database/seeders/DatabaseSeeder.php ./database/seeders/DatabaseSeeder_copy.php

echo "Copying database/seeders/BoatSeeder.php to database/seeders/BoatSeeder_copy.php"
cp  ./database/seeders/BoatSeeder.php ./database/seeders/BoatSeeder_copy.php


# Recupera los cambios más recientes del repositorio remoto
echo "Fetching changes from remote repository..."
git fetch

# Compara el HEAD local con el HEAD remoto
LOCAL=$(git rev-parse @)
REMOTE=$(git rev-parse @{u})

# Si no son iguales, hay cambios en el repositorio remoto
if [ $LOCAL != $REMOTE ]; then
    echo "Hay cambios en el repositorio remoto, actualizando..."
    git pull
else
    echo "El repositorio local ya está actualizado."
fi

# Copy *copy files to...
echo "Copying .env_copy to .env"
cp  ./.env_copy ./.env

echo "Copying README_copy.md to README.md"
cp  ./README_copy.md ./README.md

echo "Copying config/database_copy.php to config/database.php"
cp  ./config/database_copy.php ./config/database.php

echo "Copying config/filesystems_copy.php to config/filesystems.php"
cp  ./config/filesystems_copy.php ./config/filesystems.php

echo "Copying lang/en/crud_copy.php to lang/en/crud.php"
cp  ./resources/lang/en/crud_copy.php ./resources/lang/en/crud.php

echo "Copying UsersTableSeeder_copy.php to UsersTableSeeder.php"
cp  ./database/seeders/UsersTableSeeder_copy.php ./database/seeders/UsersTableSeeder.php

echo "Copying DatabaseSeeder_copy.php to DatabaseSeeder.php"
cp  ./database/seeders/DatabaseSeeder_copy.php ./database/seeders/DatabaseSeeder.php

echo "Copying BoatSeeder_copy.php to BoatSeeder.php"
cp  ./database/seeders/BoatSeeder_copy.php ./database/seeders/BoatSeeder.php

# Run composer install
echo "Do you want to run: composer install? (y/n)"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, composer install..."
    # Your command goes here
    composer install
else
    echo "Command skipped."
fi

#Run migrations
echo "Do you want to run: php artisan migrate:fresh? (y/n)"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, php artisan migrate..."
    # Your command goes here
    php artisan migrate:fresh
else
    echo "Command skipped."
fi

#Run seeders
echo "Do you want to run: php artisan db:seed? (y/n)"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, php artisan db:seed..."
    # Your command goes here
    php artisan db:seed
else
    echo "Command skipped."
fi

#Run server
echo "Do you want to run: php artisan serve? (y/n)"
read answer

if [ "$answer" == "y" ]; then
    # The next command you want to run
    echo "Running, php artisan serve..."
    # Your command goes here
    php artisan serve
else
    echo "Command skipped."
fi
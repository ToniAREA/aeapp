#!/bin/bash

# Clean screen
clear

# Cambia al directorio del repositorio
cd ~/MEGA/MisWebs/AEAPPv5/aeapp

# Recupera los cambios más recientes del repositorio remoto
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
echo "Copying config/database_copy.php to config/database.php"
cp  ./config/database_copy.php ./config/database.php

echo "Copying UsersTableSeeder_copy.php to UsersTableSeeder.php"
cp  ./database/seeders/UsersTableSeeder_copy.php ./database/seeders/UsersTableSeeder.php

echo "Copying DatabaseSeeder_copy.php to DatabaseSeeder.php"
cp  ./database/seeders/DatabaseSeeder_copy.php ./database/seeders/DatabaseSeeder.php


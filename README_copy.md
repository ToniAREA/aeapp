#AEAPP, Area Electronica

## Steps from QuickAdminPanel MODIFICATION...

1- Modify on QAP, menus or CRUDS

2- Update on GitHub via QAP.

3- Go to GitHub account to merge changes to main branch (if needs)

4- In local machine, `git pull`

5- In local, `composer install`

6- In local, `php artisan migrate:fresh --seed`

7- In local, `php artisan key:generate`, only first time

8- In local, `php artisan storage:link`, only first time

9- 

## From VScode MODIFICATION only...

## To serve the page:
> php artisan serve
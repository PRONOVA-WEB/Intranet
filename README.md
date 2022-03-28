## Cambio de rama de master a main
```
git branch -m master main
git fetch origin
git branch -u origin/main main
git remote set-head origin -a
```

# Instalacion
> Este proyecto está desarrollado en Laravel 8

> Incluye Bootstrap 4, jQuery y Font Awesome

## Prerequisitos
- git
- composer
- php >= 7.3

## Ejecutar en un terminal los siguientes comandos
```
git clone https://github.com/PRONOVA-WEB/intranet
cd intranet
composer install
cp .env.example .env
php artisan key:generate

# editar archivo .env y setear las variables del sistema y de la base de datos.
php artisan migrate:fresh --seed
```

## Usuario por defecto
Usuario: 12345678-9 clave: admin

### Al cambiar logos o favicons editar archivo `.gitignore` y agregar
```
public/favicon*
public/images/logo*
```

### Otras configuraciones php
Editar php.ini para que se puedan subir archivos más grandes.
```
memory_limit = 128M
upload_max_filesize = 64M
post_max_size = 66M
```


## License.

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

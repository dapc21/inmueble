# Pasos a seguir para la instalación del proyecto "Inmueble" NextDots

* Primeramente, clonamos el proyecto:

```
#!python

git clone https://tu_usuario@bitbucket.org/DaniAlejandroPC/inmueble.git
```

* Nos ubicamos en la raíz del proyecto mediante CMD de Windows. Por ejm tecleamos algo parecido a lo siguiente:
  
```
#!cmd

$ cd C:path_to_project\inmueble
```
 (y pulsamos enter/intro).

* Ejecutamos el siguiente comando en el CMD: 
  
```
#!cmd

$ composer update
```
 Con esto instalamos las dependencias.
* Nos vamos a nuestro gestor de BD y creamos la base de datos, por ejm le ponemos "inmueble".
* Ahora vamos a editar nuestro archivo .env para configurar la base de datos y otras variales. Debe tener una configuración parecida a esto:


```
#!txt

APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:vi9fvv2g8sw9ArqYBDRG1RE5HmHa4DpCiNqRH81qb18=
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inmueble
DB_USERNAME=tu_usuario_mysql
DB_PASSWORD=tu_password_mysql

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=un_correo@gmail.com
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```

* Ejecutamos en el CMD el siguiente comando que nos creará las tablas y poblará las mismas con los datos:
  
```
#!cmd

$ php artisan migrate --seed
```

* Ahora ejecutamos el comando que nos levantará el servidor de Laravel en el puerto 8000:
  
```
#!cmd

$ php artisan serve
```

* Finalmente abrimos un navegador web, por ejm Google Chrome o Firefox y colocamos en la barra de direcciones algo como:
  
```
#!txt

http://localhost:8000
```
 Y colocamos nuestro user de prueba con la credenciales Usuario: JOLIVIERI y Clave: 123456, haciendo click en el botón "iniciar".
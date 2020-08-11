# MikrotikPHP apiHotspotUserGenerator
Generador de usuario hotspot con API Mikrotik PHP 

Aplicación de gestión de usuarios hotspot que utiliza la API Mikrotik PHP. Tiene las siguientes capacidades:

1. Puede crear y generar usuarios hotspot a través de la interfaz de la aplicación
2. Puede administrar el ancho de banda del usuario a través de la interfaz de la aplicación
3. Puede configurar el tiempo de acceso a la red de hotspot a través de la interfaz de la aplicación
5. Realizado bajo MVC, POO


# Instalación y uso

1. Se requiere PHP en su version 7 en adelante. Recomendable tener tu entorno de prueba XAMPP en Windows o MAMP en Mac.
2. Poner en htdocs la carpeta del proyecto, (un nombre sin espacios).
3. En la estrucutura de directorios se cuenta con 3 archivos **.htaccess** de estos se tiene que cambiarle algo a uno de estos.
4. En la carpeta **public** se modifica en el **.htaccess** la linea ***/base/public/*** por el nombre que le hayas puesto a tu directorio en htdocs. Como ejemplo, ***base*** es la carpeta que contiene el proyecto, su **.htaccess**:

~~~
<IfModule mod_rewrite.c>
    Options -Multiviews
    RewriteEngine On
    RewriteBase /base/public/
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>
~~~

5. Sí en htdocs le pones de nombre **mikrovouchers** a la carpeta del proyecto, **RewriteBase** queda como  ***RewriteBase /mikrovouchers/public/***

~~~
<IfModule mod_rewrite.c>
    Options -Multiviews
    RewriteEngine On
    RewriteBase /mikrovouchers/public/
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
</IfModule>
~~~

6. Dentro del directorio **app/config** hay un archivo llamado **config.php** con un contenido que tiene unas contantes:

~~~
    <?php 

    // Raíz de la aplicación
    define('APPROOT', dirname(dirname (__FILE__)));
    // Url raíz
    define('URLROOT', 'http://localhost:8888/base');
    //nombre del sitio
    define('SITENAME', 'MikrotikPHP');
    define('ROOTFOLDER','/base/');
~~~

7. De esas constantes modificas su valor la constante **URLROOT**, y **ROOTFOLDER** por el nombre que tu le hayas puesto a la carpeta en **htdocs**. Donde **URLROOT** quedaría como **http://localhost/mikrovouchers** o **http://localhost:3030/mikrovouchers** si tu entorno de prueba de servidor requiere un puerto en especifico. La constante **ROOTFOLDER** solo tendría el nombre de la carpeta del proyecto **/mikrovouchers/**.

~~~
    <?php 

    // Raíz de la aplicación
    define('APPROOT', dirname(dirname (__FILE__)));
    // Url raíz
    define('URLROOT', 'http://localhost/mikrovouchers');
    //nombre del sitio
    define('SITENAME', 'MikrotikPHP');
    define('ROOTFOLDER','/mikrovouchers/');
~~~

8. Por último y no menos importante, se requiere un router mikrotik con el sistema RouterOS, porque se ocupará la API oficla para PHP para hacer cosas interesantes con este. Para este desarrollo se probó con un equipo similar al de la imagen.

~~~
    <img src="https://i.mt.lv/cdn/rb_images/1284_hi_res.png"
     alt="Markdown Monster icon"
     style="float: left; margin-right: 10px;" />
~~~


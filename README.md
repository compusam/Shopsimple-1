CookieShopAdPress v2.0-beta1
=======================

Introducción
------------
Se trata de una aplicación, esqueleto con la capa MVC ZF2. 
Esta aplicación le permite gestionar tiendas en línea.
Bajo el esquema de puntos

Dependencias
------------
* [ZfcBase](https://github.com/CookieShop/ZfcBase.git "ZfcBase")
* [ZfcUser](https://github.com/CookieShop/ZfcUser.git "ZfcUser")
* [Cscore](https://github.com/CookieShop/Cscore.git "Cscore")

Instalación Automatica.
-----------------------
proximamente

Instalación Manual.
-----------------------

1.Paso uno Descargar Repositorio

###### Via shell https:

    git clone https://github.com/CookieShop/Shopsimple.git

###### Via shell ssh:
    git clone git@github.com:CookieShop/Shopsimple.git

###### Via Descarga Directa (zip):
 [v2.0-beta1](https://github.com/CookieShop/Shopsimple/archive/v2.0-beta1.zip "v2.0-beta1")

###### Via Descarga Directa (tar.gz):
 [v2.0-beta1](https://github.com/CookieShop/Shopsimple/archive/v2.0-beta1.tar.gz "v2.0-beta1")

2.instalar el repositorio en carpeta raiz del Servidor Web

3.Descargar las imagenes de categorias y productos

Via Descarga Directa (tar.gz):

 * [public.assets.img.tar.gz](https://github.com/CookieShop/Shopsimple/releases/download/v2.0-beta1/public.assets.img.tar.gz "public.assets.img.tar.gz")
 * [public.img.tar.gz](https://github.com/CookieShop/Shopsimple/releases/download/v2.0-beta1/public.img.tar.gz "public.img.tar.gz")

4.Descomprimir los archivos con las imagenes public.assets.img.tar.gz y public.img.tar.gz en consola de la siguiente forma

    $cd public
    $mkdir img
    $cd img
    $tar czvf public.img.tar.gz *
    
    $cd public/assets
    $mkdir img
    $cd img
    $tar czvf public.assets.img.tar.gz *

5.Crear un link simbolico de vendor que contiene las librerias Cscore, ZfcBase y ZfcUser, desde consola

    $ln -s /path/origen/librerias/vendor /path/del/proyecto/vendor 

6.Login user: admin, password:12345678    

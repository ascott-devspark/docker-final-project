# Docker - Proyecto final del curso
Este es el proyecto final del curso en el cual los participantes deberan clonarlo y completar los archivos ```Dockerfile``` y ```docker-compose.yml``` con lo aprendido en el curso teniendo en cuanta las instrucciones detalladas a continuación.

# Entrega 
Cada integrante deberá crear su propio repositorio en github con el proyecto completo, tomando como referencia este mismo repositorio y enviar el link para ser evaluado.
Debe agregar un archivo llamado ```commands.md``` con los comandos de Docker para inicializar los contenedores del proyecto. Estos comandos son el equivalente a utilizar Docker-compose.

# Cómo instalar la aplicación
Los siguientes son los pasos detallados de configuracion del servidor para lograr que la API funcione correctamente en nuestro servidor. 

**Esta documentación está completamente probada sobre un sistema ```Ubuntu 14.04```**
Lo primero que se debe hacer es asegurarse de que el repositorio de Ubuntu este actualizado, esto se logra con el siguiente comando:
```
$> apt-get update && apt-get -y upgrade
```
Una vez actualizado el repositorio de aplicaciones procedemos a instalar todos los paquetes necesarios con el siguiente comando:
```
$> apt-get -y install apache2 libapache2-mod-php5 php5-mysql php5-gd php-pear php-apc php5-curl curl lynx-cur
```
El siguiente paso, una vez instalada las aplicaciones necesarias, es habilitar los módulos de Apache (servidor web) para poder ejecutar nuestra aplicacion:
```
$> a2enmod php5
$> a2enmod rewrite
``` 
Una vez habilitados los módulos es necesario dar de alta las siguientes variables de entorno:
```
APACHE_RUN_USER www-data
APACHE_RUN_GROUP www-data
APACHE_LOG_DIR /var/log/apache2
APACHE_LOCK_DIR /var/lock/apache2
APACHE_PID_FILE /var/run/apache2.pid

WORLD_API_DOCUMENT_ROOT /opt/www/worldapi/public/
WORLD_API_SERVER_NAME api.world.com.ar
``` 
EL siguiente paso es habilitar el puerto 80. Por default Apache ya "escucha" en este puerto, pero es necesario estar seguros de que el puerto esté disponible. **Si está utilizando alguna tecnología de virtualización, asegúrese de que el puerto este expuesto.**

Es hora de copiar los archivos de configuración que estan incluidos en este proyecto con el fin de mantener la misma sobre todos los entornos. Los archivos a copiar son ```apache2.conf``` y ```worldapi.conf```.
Primero copiaremos el archivo de configuración de Apache con el siguiente comando:
```
$> cp apache2.conf /etc/apache2/apache2.conf
```
Y luego copiaremos el archivo de configuración del virtual host de nuestra aplicación:
```
$> cp worldapi.conf /etc/apache2/sites-available/worldapi.conf
```
Una vez copiada la configuración del virtual host es necesario habilitarla con el siguiente comando:
```
$> a2ensite worldapi.conf
```
La aplicación utiliza un par de comandos para realizar la migración de la base de datos de forma automatizada y además presenta particularidades de permisos sobre ciertas carpetas y archivos. Para realizar esto se desarrolló un script bash que con tan solo ejecutarlo se encanrgará de hacer lo necesario para garantizar la correcta configuración de la aplicación. EL archivo fue llamado ```entrypoint.sh```.
Si esta utilizando alguna tecnología de virtualización considere los siguientes pasos:
 1. Copiar el script en la raíz del servidor: ```$> cp entrypoint.sh /entrypoint.sh```
 2. Asignarle permisos de ejecución: ```$> chmod +x /entrypoint.sh```
 3. Una vez relaizados los pasos 1 y 2 ya puede asignarlo como script de ejecución automático.

Por último es necesario inicializar la aplicación Apache por default. Puede utilizar comandos como ```service apache2 start``` pero si está pensando en virtualizar la aplicación le sugiero que utilice el siguiente comando para inicializar el servidor web:
```
/usr/sbin/apache2ctl -D FOREGROUND
```

# Base de Datos
Como servidor de base de datos, la aplicación utlliza ```MySQL``` en su versión ```5.6```. Para esto se debe utilizar una imagen existente y oficial. 
La aplicación se conecta a la misma utilizando un sistema de configuración simple en archivo de texto plano llamado ```.env``` que lo podran encontrar en la raíz de la aplicación. La sección a configurar será la siguiente:
```
DB_HOST=localhost
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```
Si piensa utilizar un sistema de virtualización como Docker y necesita reemplazar los valores anteriores por variables de entorno, esto es posible, tenga en cuenta el sigueinte ejemplo:
```
DB_HOST={$YOUR_ENV_VAR_FOR_HOST}
DB_DATABASE={$YOUR_ENV_VAR_FOR_DATABSE}
DB_USERNAME={$YOUR_ENV_VAR_FOR_USERNAME}
DB_PASSWORD={$YOUR_ENV_VAR_FOR_PASSWORD}
```

# IMPORTANTE: A tener en cuenta
La aplicación debe ser instalada en el servidor en la siguiente ruta:
```
/opt/www/worldapi
```
La URL utilizada para desarrollo es una simulación de su entorno productivo, por lo tanto debe agregar esta URL en su archivo HOST de su sistema operativo, para ello edite el archivo que se encuentra en ```/etc/hosts``` y agregue la sigueinte linea:
```
127.0.0.1     api.world.com.ar
```
# Probando la instalación
Si todo ha sido instalado correctamente podrá probar la aplicación mediante la siguiente URL: [http://api.world.com.ar/apidoc/](http://api.world.com.ar/apidoc/)


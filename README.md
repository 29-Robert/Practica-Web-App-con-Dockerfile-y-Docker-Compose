# Práctica: Aplicación web Hola Mundo con Docker Compose y MySQL

## Descripción

Esta práctica consiste en una aplicación web sencilla desarrollada en PHP que muestra el mensaje **«¡Hola Mundo!»** y comprueba su conexión con una base de datos MySQL. Los servicios se ejecutan mediante Docker Compose, por lo que no es necesario instalar PHP ni MySQL directamente en el equipo.

## Tecnologías utilizadas

- **PHP 8.4:** lenguaje utilizado para desarrollar la aplicación.
- **Apache:** servidor web que ejecuta la aplicación PHP.
- **MySQL 8.4:** sistema gestor de base de datos.
- **Docker:** permite ejecutar la aplicación y MySQL en contenedores.
- **Docker Compose:** configura y administra los servicios de la aplicación.

## Estructura del proyecto

```text
HolaMundoDocker/
├── src/
│   └── index.php
├── dockerfile
├── docker-compose.yml
└── README.md
```

- `src/index.php`: contiene la página Hola Mundo y el código PHP que se conecta a MySQL mediante PDO. También consulta la versión del servidor para comprobar que la conexión funciona.
- `dockerfile`: define la imagen de la aplicación a partir de PHP con Apache e instala las extensiones necesarias para conectarse a MySQL.
- `docker-compose.yml`: configura los servicios `app` y `db`, sus variables de entorno, el puerto, la dependencia entre servicios y el volumen de datos de MySQL.

## Requisitos previos

Antes de ejecutar el proyecto, se necesita:

1. Tener **Docker Desktop** instalado.
2. Iniciar Docker Desktop y comprobar que esté funcionando.
3. Tener una terminal disponible, como la terminal integrada de Visual Studio Code o PowerShell.

## Cómo ejecutar el proyecto

### 1. Obtener el código

Clonar el repositorio desde GitHub:

```bash
git clone https://github.com/29-Robert/Practica-Web-App-con-Dockerfile-y-Docker-Compose.git
```

Entrar en la carpeta del proyecto:

```bash
cd Practica-Web-App-con-Dockerfile-y-Docker-Compose
```

También se puede descargar el repositorio como archivo ZIP y extraerlo.

### 2. Construir e iniciar los servicios

Desde la carpeta principal del proyecto, ejecutar:

```bash
docker compose up -d --build
```

Este comando construye la imagen de la aplicación y crea e inicia los contenedores de PHP/Apache y MySQL. La primera ejecución puede tardar más porque Docker necesita descargar las imágenes.

### 3. Comprobar el estado de los contenedores

Ejecutar:

```bash
docker compose ps
```

Deben aparecer los servicios `app` y `db` en ejecución. El servicio `db` debe completar su comprobación de salud y mostrarse como `healthy`.

### 4. Abrir la aplicación

Abrir el siguiente enlace en el navegador:

[http://localhost:8081](http://localhost:8081)

La página debe mostrar **«¡Hola Mundo!»**, el resultado de la conexión con MySQL y la versión del servidor. El puerto `8081` del equipo se comunica con el puerto `80` del contenedor Apache.

## Configuración de MySQL

Docker Compose configura la base de datos y el usuario de la aplicación mediante variables de entorno:

| Variable | Valor de práctica |
|---|---|
| Base de datos | `hola_mundo` |
| Usuario de aplicación | `appuser` |
| Contraseña de aplicación | `apppass123` |
| Contraseña de root | `rootpass123` |
| Servidor de base de datos | `db` |

El nombre `db` es el nombre del servicio MySQL dentro de la red de Docker Compose. La aplicación lo utiliza como host para conectarse a la base de datos.

Los datos de MySQL se guardan en el volumen `mysql_data`, de modo que detener y volver a crear los contenedores no elimina automáticamente la información almacenada.

> **Nota:** las credenciales incluidas son únicamente para esta práctica local. No deben utilizarse en una aplicación publicada en Internet ni en un entorno de producción.

## Comandos útiles

Detener y eliminar los contenedores y la red del proyecto, conservando el volumen de datos:

```bash
docker compose down
```

Consultar los registros de la aplicación:

```bash
docker compose logs app
```

Consultar los registros de MySQL:

```bash
docker compose logs db
```

Detener también el volumen de MySQL y borrar sus datos (usar solamente si se desea reiniciar la base de datos desde cero):

```bash
docker compose down -v
```

## Solución de problemas

### El puerto 8081 está ocupado

Si Docker informa que el puerto `8081` ya está en uso, se puede cambiar el primer número de la sección `ports` del servicio `app` en `docker-compose.yml`. Por ejemplo:

```yaml
ports:
  - "8082:80"
```

Después, volver a iniciar los servicios:

```bash
docker compose up -d --build
```

En ese caso, abrir la aplicación en [http://localhost:8082](http://localhost:8082).

### La aplicación no logra conectarse a MySQL

Comprobar el estado de los servicios con `docker compose ps` y revisar los registros con `docker compose logs db` y `docker compose logs app`. La aplicación está configurada para esperar a que MySQL supere su comprobación de salud antes de iniciar.

## Repositorio

Código fuente de la práctica en GitHub:

[Practica-Web-App-con-Dockerfile-y-Docker-Compose](https://github.com/29-Robert/Practica-Web-App-con-Dockerfile-y-Docker-Compose)

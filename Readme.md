#Install Notes
Para ejecutar el proyecto es necesario instalar docker y docker-compose.

Para Mac esta en la URL: https://www.docker.com/products/docker-toolbox

Una vez instalado.

Si tienes el puerto 8080 ocupado, puedes editar el archivo docker-compose.yml y cambiar 8080:80 por TuPuerto:80

```bash
git clone https://github.com/rafaelcalleja/challenge-dokify/ challenge-dokify
cd challenge-dokify
docker-compose up
```

Cuando termine de iniciar se puede acceder a la siguiente url:

http://127.0.0.1:8080/app_dev.php/admin/dashboard

Datos de acceso:
```
usuario: admin
password: admin
```

He dejado un segundo archivo de docker-compose-build.yml, la diferencia entre los 2 es:

**docker-compose.yml** baja la imagen ya construida desde el repositorio de docker

**docker-compose-build.yml** construye una nueva imagen usando el archivo code/Dockerfile

Para construir y ejecutar una nueva imagen o versión del proyecto:
```bash
git clone https://github.com/rafaelcalleja/challenge-dokify/ challenge-dokify
cd challenge-dokify
docker-compose -f docker-compose-build.yml up --build
```

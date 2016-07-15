#Install Notes
Para ejecutar el proyecto es necesario instalarse docker y docker-compose.
Para Mac esta en la URL: https://www.docker.com/products/docker-toolbox

Una vez instalado.

Si tienes el puerto 8080 ocupado , puede editar el archivo docker-compose.yml y cambiar 8080:80 por TuPuerto:80

```bash
git clone https://github.com/rafaelcalleja/challenge-dokify/ challenge-dokify
cd challenge-dokify
docker-compose up
```

Ahora podemos acceder a la siguiente url 

http://127.0.0.1:8080/app_dev.php/admin/dashboard

El usuario y la contraseña son:
admin/admin
